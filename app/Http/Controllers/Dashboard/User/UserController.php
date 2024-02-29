<?php

namespace App\Http\Controllers\Dashboard\User;

use App\Models\User;
use App\Models\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select('users.*')->paginate(PAGINATE_COUNT);
        return view('dashboard.user.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function create(Request $request)
    // {
    //     return view('dashboard.users.create');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $validatorArray = [
            'name' => 'required|max:120',
            'email' => 'required|email|max:100|unique:users,email',
            // 'email' => 'required|email|max:100|unique:users,email,NULL,id,parent_id,' . Auth::user()->getCreatedBy(),
            'password' => 'required|min:4|confirmed',
            'role'     => 'required',
        ];
        $validator = Validator::make(
            $request->all(), $validatorArray
        );

        if($validator->fails())
        {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        $settings = Utility::settings();
        $default_language = $settings['default_user_language'];
        // this role update tomoro
        // $selectedRole = $request->input('role');
        // $selectedRole = 'utilisateur';

        $user = User::create([
            'password' => $request->input('password'),
            'name'    => $request->input('name'),
            'email'   =>$request->input('email'),
            'address' => $request->input('address'),
            'lang' =>  $default_language,
            'is_active' => 1,
            'user_status' => 1,
            'role' => $request->input('role'),
        ]);    
        return redirect()->route('dashboard.users.index')->with('success', 'User Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return redirect()->back()->with('error', __('Permission denied.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit(User $user)
    // {
    //     return view('dashboard.users.edit', compact('user'));
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find($request->id);
        $validatorArray = [
            'name' => 'required|max:120',
            'email' => 'required|email|max:100|unique:users,email,' . $user->id . ',id,parent_id,' . Auth::user()->getCreatedBy(),
            'password' => 'required|min:4|confirmed',
        ];

        $validator = Validator::make(
            $request->all(), $validatorArray
        );

        if($validator->fails())
        {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        $selectedRole = $request->input('role');

        $user->name     = $request->name;
        $user->email    = $request->email;
        $user->address  = $request->address;
        $user->password = $request->password;
       
       $user->role = $selectedRole;
       $user->save();

       
       if($user->parent_id != 0)
       {
           $roles = $request['roles'];

           if(isset($roles))
           {
               $user->roles()->sync($roles);
           }
           else
           {
               $user->roles()->detach();
           }
       }
       return redirect()->route('dashboard.users.index')->with('success', __('User successfully updated.'));

    }

    public function changeUserStatus($id)
    {

        $user   = User::find($id);
        $status = '';
        if($user)
        {
            User::where('id', $id)->update(['user_status' => (int)!$user->user_status]);
            User::where('parent_id', $id)->update(['user_status' => (int)!$user->user_status]);
            $status = $user->user_status == '0' ? __('activated') : __('deactivated');
        }

        return redirect()->route('users.index')->with('success', __('User') . ' ' . $status . ' ' . __('successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::destroy($request->id);
        return redirect()->route('dashboard.users.index')->with('success', __('User successfully deleted.'));

        // if(Auth::user()->can('Delete User'))
        // {
        //     $user->delete();

        //     return redirect()->route('users.index')->with('success', __('User successfully deleted.'));
        // }
        // else
        // {
        //     return redirect()->back()->with('error', __('Permission denied.'));
        // }
    }

    public function displayProfile(Request $request)
    {
        $user = Auth::user();
        return view('users.profile', compact('user'));
    }

    public function uploadProfile(Request $request){
        $user      = Auth::user();
        $validator = Validator::make($request->all(), [
            'name' => [
                    'bail','required','string','min:2','max:255',
                    'unique:users,name,' . $user->getCreatedBy() . ',id',
                ],
                'email' => 'required|email|unique:users,email,' . $user->getCreatedBy(),
                'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
            ]
        );

        if($validator->fails())
        {
            return redirect()->back()->with('error', $validator->errors()->first());
        }

        if($request->hasFile('avatar'))
        {
            $validator = Validator::make(
                $request->all(), [
                                   'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:20480',
                               ]
            );

            if($validator->fails())
            {
                return redirect()->back()->with('error', $validator->errors()->first());
            }

            if(asset(Storage::exists($user->avatar)))
            {
                asset(Storage::delete($user->avatar));
            }

            $filenameWithExt = $request->file('avatar')->getClientOriginalName();
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $request->file('avatar')->getClientOriginalExtension();
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            $path            = $request->file('avatar')->storeAs('avatar', $fileNameToStore);
            $user['avatar']  = $path;
        }
        $user['name'] = $request['name'];
        $user['email'] = $request['email'];
        $user->save();

        return redirect()->route('profile.display')->with('success', __('Profile updated successfully.'));
    }

    public function deleteProfile(Request $request)
    {
        $user = Auth::user();
        if(asset(Storage::exists($user->avatar)))
        {
            asset(Storage::delete($user->avatar));
        }
        $user->avatar = '';
        $user->save();

        return redirect()->route('profile.display')->with('success', __('Profile deleted successfully.'));
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|same:password',
            'confirm_password' => 'required|same:password',
        ]);
        $objUser          = Auth::user();
        $request_data     = $request->all();
        $current_password = $objUser->password;

        if(Hash::check($request_data['current_password'], $current_password))
        {
            $objUser->password = $request_data['password'];
            $objUser->save();

            return redirect()->route('profile.display')->with('success', __('Password updated successfully.'));
        }
        else
        {
            return redirect()->back()->with('error', __('Please Enter Correct Current Password!'));
        }
    }

    public function checkUserType()
    {
        $user = User::select('id')->where('id', '=', Auth::user()->getCreatedBy())->where('user_status', '=', 1)->get();

        if(!empty($user) && count($user) > 0)
        {
            $user[0]['isSuperAdmin'] = Auth::user()->isSuperAdmin();
            $user[0]['isOwner']      = Auth::user()->isOwner();
            $user[0]['isUser']       = Auth::user()->isUser();
            if(Auth::user()->isUser())
            {
                $user[0]['branch_id']        = Auth::user()->branch->id;
                $user[0]['branchname']       = Auth::user()->branch->name;
                $user[0]['cash_register_id'] = Auth::user()->cashregister->id;
                $user[0]['cashregistername'] = Auth::user()->cashregister->name;
            }
        }

        return json_encode($user);
    }

}
