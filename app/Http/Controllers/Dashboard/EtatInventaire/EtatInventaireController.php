<?php

namespace App\Http\Controllers\Dashboard\EtatInventaire;

use App\Models\Product;
use App\Models\Inventaire;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EtatInventaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ->paginate(PAGINATE_COUNT)
        // $proprietaires = Proprietaire::with('ilot')->paginate(PAGINATE_COUNT);

        $articles = Product::has('inventaire')->with('inventaire.ilot.proprietaire')->paginate(PAGINATE_COUNT);

        // $articles = Produc::has('ilot','articles')->with(['ilot.proprietaire','articles'])->paginate(PAGINATE_COUNT);
        // $inventaires = Inventaire::has('')->with('ilot')->paginate(PAGINATE_COUNT);

        // dd($articles);
        return view('dashboard.etatInventaire.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
