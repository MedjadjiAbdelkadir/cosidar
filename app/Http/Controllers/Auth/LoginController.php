<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticate(Request $request)
    {
        $email    = $request->has('email') ? $request->email : '';
        $password = $request->has('password') ? $request->password : '';

        if(Auth::attempt([ 'email' => $email, 'password' => $password, 'is_active' => 1, 'user_status' => 1 ]))
        {
            $user = User::where('id', '=', Auth::user()->getCreatedBy())->first();

            if($user->isOwner())
            {
                $free_plan = Plan::where('price', '=', '0.0')->first();
                if($user->plan_id != $free_plan->id)
                {
                    if(date('Y-m-d') > $user->plan_expire_date)
                    {
                        $user->plan_id          = $free_plan->id;
                        $user->plan_expire_date = null;
                        $user->save();

                        $users     = User::where('parent_id', '=', Auth::user()->getCreatedBy())->get();
                        $customers = Customer::where('created_by', '=', Auth::user()->getCreatedBy())->get();
                        $vendors   = Vendor::where('created_by', '=', Auth::user()->getCreatedBy())->get();

                        $userCount = 0;
                        foreach($users as $user)
                        {
                            $userCount++;
                            $user->is_active = $free_plan->max_users == -1 || $userCount <= $free_plan->max_users ? 1 : 0;
                            $user->save();
                        }

                        $customerCount = 0;
                        foreach($customers as $customer)
                        {
                            $customerCount++;
                            $customer->is_active = $free_plan->max_customers == -1 || $customerCount <= $free_plan->max_customers ? 1 : 0;
                            $customer->save();
                        }

                        $vendorCount = 0;
                        foreach($vendors as $vendor)
                        {
                            $vendorCount++;
                            $vendor->is_active = $free_plan->max_vendors == -1 || $vendorCount <= $free_plan->max_vendors ? 1 : 0;
                            $vendor->save();
                        }

                        return redirect()->route('dashboard')->with('error', 'Your plan expired limit is over, please upgrade your plan.');
                    }
                }
            }

            return redirect()->intended('/');
        }
        else
        {
            return redirect()->back()->with('error', __('Your Account has been Deactivated. Please contact your Administrator.'));
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Customize the redirect route after logout
        return $this->loggedOut($request) ?: redirect('/login');
    }

}
