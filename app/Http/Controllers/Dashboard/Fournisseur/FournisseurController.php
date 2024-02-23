<?php

namespace App\Http\Controllers\Dashboard\Fournisseur;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fournisseurs = Fournisseur::with('inventaire')->paginate(PAGINATE_COUNT);;
        return view('dashboard.fournisseur.index', compact('fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $inventaire_id =  $request->query('inventaire') ? $request->query('inventaire') : ''; 
        return view('dashboard.fournisseur.create',compact('inventaire_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->inventaire_id);

        // $data = $request->validate([
        //     'inventaire_id' =>'max',
        //     'nom' => 'required|string',
        //     'prenom' => 'required|string',
        //     'address' => 'required|string',
        //     'numero_telephone' => 'required|numeric',
        //     'email' => 'required|email',
        // ]);

        // dd($data);

        // Store the fournisseur information in the database
        $fournisseur = Fournisseur::create([
            'inventaire_id' =>$request->inventaire_id,
            'nom' =>$request->nom ,
            'prenom' =>$request->prenom ,
            'address' =>$request->address,
            'numero_telephone' =>$request->numero_telephone ,
            'email' =>$request->email,
        ]);

        // Redirect back with a success message
        return redirect()->route('dashboard.articles.create', compact('fournisseur'))->with('success', 'Fournisseur ajouté avec succès.');

        // return redirect()->back()->with('success', 'Fournisseur ajouté avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
