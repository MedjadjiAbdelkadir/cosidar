<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Home.index');
    }

    public function template()
    {
        $jsonPath = public_path('country.json');
        $jsonData = File::get($jsonPath);
        $pays = json_decode($jsonData, true);

        // Tableau associatif pour stocker les noms des pays avec la clé et la valeur égales au nom du pays
        $paysAssoc = [];
        $paysAssoc[''] = 'Tous';

        // Parcourir le tableau
        foreach ($pays as $paysData) {
            $nom = $paysData['name'];
            $paysAssoc[$nom] = $nom;
        }

        $pays = $paysAssoc;

        // effectuer une jointure entre la table dbo_ilot et deux autres tables (dbo_anx_evaluation_locative et dbo_anx_evaluation_venale),  la jointure avec l'une de ces tables soit facultative.
        $ilots = DB::table('dbo_ilot')
            ->join('dbo_anx_nature_imm', 'dbo_ilot.Nature', '=', 'dbo_anx_nature_imm.Num_Nat_imm')
            ->leftJoin('dbo_anx_evaluation_locative', 'dbo_ilot.Int_VL', '=', 'dbo_anx_evaluation_locative.num_Lv')
            ->leftJoin('dbo_anx_evaluation_venale', 'dbo_ilot.Int_VV', '=', 'dbo_anx_evaluation_venale.num_VV')
            ->select('dbo_ilot.*', 'dbo_anx_nature_imm.intitule as nature_nom', 'dbo_anx_evaluation_locative.intitule as intitule_vl', 'dbo_anx_evaluation_venale.intitule as intitule_vv')
            ->get();

        echo json_encode($ilots);
    }
}
