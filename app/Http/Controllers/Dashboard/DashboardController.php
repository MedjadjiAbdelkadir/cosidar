<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Ilot;
use App\Models\User;
use App\Models\Local;
use App\Models\Batiment;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    public function __invoke()
    {

        $nombreUtilisateurs = User::count();
        $nombreIlots = Ilot::count();
        $nombreBatiments = Batiment::count();
        $nombreLocaux = Local::count();


        $totalSupIlots = Ilot::where('validation', 1)->sum('il_surf_cadastree');
        $totalSupBatiments = Batiment::sum('sup_bati_cons');
        $totalSupBatimentsSDHO = Batiment::sum('sup_SDHO');
        $totalSupLocaux = Local::sum('lot_surface');
        
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
            ->paginate(PAGINATE_COUNT);;
        
        return view('dashboard.index', compact('ilots', 'nombreUtilisateurs', 'nombreIlots', 'nombreBatiments', 'nombreLocaux','pays','totalSupIlots','totalSupBatiments','totalSupBatimentsSDHO','totalSupLocaux'));        
    }
}
