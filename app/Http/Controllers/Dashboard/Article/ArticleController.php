<?php

namespace App\Http\Controllers\Dashboard\Article;

use App\Models\Product;
use App\Models\Inventaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fournisseur;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Product::with('inventaire')->paginate(PAGINATE_COUNT);
        return view('dashboard.article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd("create artisv");
        $inventaires = Inventaire::get();
        $fournisseurs = Fournisseur::get();
        return view('dashboard.article.create',compact('inventaires','fournisseurs'));   
        // return view('dashboard.articles.create', compact('fournisseur'));   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create([
            'inventaire_id' => $request->inventaire_id,
            'name' => $request->name, 
            'price' => $request->price,
            'quantity' => $request->quantity,

            'descrption'=> $request->descrption,
            'garantie'=> $request->garantie,
            'garanDateJusq'=> $request->garanDateJusq,
            'dateAchat'=> $request->dateAchat,
            'marque'=> $request->marque,
            'style'=> $request->style,
            'serieNum'=> $request->serieNum,
            'EtaAticle'=> $request->EtaAticle,
            'remarque'=> $request->remarque,
            'typeProduit'=> $request->typeProduit,
            'founisseur_id'=> $request->founisseur_id,
        ]);

        return redirect()->route('dashboard.articles.index')->with('success', 'Article ajouté avec succès.');

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
