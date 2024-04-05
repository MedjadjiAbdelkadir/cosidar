<?php

namespace App\Http\Controllers\Dashboard\Proprietaire;

use App\Models\Ilot;
use App\Models\AnxStatut;
use App\Models\AnxTutelle;
use App\Models\Deciaffect;
use App\Models\Proprietaire;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\AnxTextCreati;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\NomenclaturePdc;
use App\Models\Pays;
use App\Models\Postes;

class ProprietaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proprietaires = Proprietaire::with('tutelle','statut','deciaffect', 'anx_text_creati')->paginate(PAGINATE_COUNT);


        // dd($proprietaires);

        // $proprietaires =  DB::table('dbo_personne')
        // ->join('dbo_anx_statut', 'dbo_personne.Statut', '=', 'dbo_anx_statut.bi_natjur')
        // ->join('dbo_anx_tutelle', 'dbo_personne.Tutelle', '=', 'dbo_anx_tutelle.bi_natjur')
        // ->join('dbo_deciaffect', 'dbo_personne.Decision_affectation', '=', 'dbo_deciaffect.Deci_Af')
        // ->join('dbo_anx_text_creati', 'dbo_personne.txt_creation', '=', 'dbo_anx_text_creati.bi_natjur')

        // ->select('dbo_personne.*', 'dbo_anx_statut.intitule as anx_statut_intitule','dbo_anx_statut.bi_natjur as anx_statut_id', 'dbo_deciaffect.intitule_fr as deciaffect_intitule' , 'dbo_anx_tutelle.intitule as tutelle_intitule' ,'dbo_anx_tutelle.intitule as tutelle_intitule_id' , 'dbo_anx_text_creati.intitule as text_creati_intitule', 'dbo_anx_text_creati.intitule as text_creati_intitule_id')
        // ->paginate(PAGINATE_COUNT);



        // dd( $proprietaire);
        // $ilotOptions = Ilot::pluck('Num_ilot', 'Num_ilot');
        // $deciaffect = Deciaffect::pluck('Intitule_fr','Deci_Af' );
        // $anx_statut = AnxStatut::pluck('Intitule','bi_natjur' );
        // $anx_tutelle = AnxTutelle::pluck('Intitule','bi_natjur' );
        // $anx_text_creati = AnxTextCreati::pluck('Intitule','bi_natjur' );

        $deciaffect = Deciaffect::get();
        $anx_statut = AnxStatut::get();
        $anx_tutelle = AnxTutelle::get();
        $anx_text_creati = AnxTextCreati::get();



        // dd( $anx_statut);

        return view('dashboard.proprietaire.index', compact('proprietaires','deciaffect','anx_statut','anx_tutelle','anx_text_creati'));

        // return view('dashboard.proprietaire.index')->with('proprietaires', $proprietaires);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $ilotOptions = Ilot::pluck('Num_ilot', 'Num_ilot');
        $deciaffect = Deciaffect::get();
        $anx_statut = AnxStatut::get();
        $anx_tutelle = AnxTutelle::get();
        $anx_text_creati = AnxTextCreati::get();

        $pays = Pays::all();
        $nomenclatures = NomenclaturePdc::all();

        return view('dashboard.proprietaire.create',
        compact('deciaffect','anx_statut','anx_tutelle','anx_text_creati','pays','nomenclatures'));
    }

    public function create_ajax()
    {

        // $ilotOptions = Ilot::pluck('Num_ilot', 'Num_ilot');
        $deciaffect = Deciaffect::pluck('Intitule_fr','Deci_Af' );
        $anx_statut = AnxStatut::pluck('Intitule','bi_natjur' );
        $anx_tutelle = AnxTutelle::pluck('Intitule','bi_natjur' );
        $anx_text_creati = AnxTextCreati::pluck('Intitule','bi_natjur' );

        return view('dashboard.proprietaire.create_ajax', compact('deciaffect','anx_statut','anx_tutelle','anx_text_creati'));

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $maxNumPropretaire = Proprietaire::max('pe_num');
        $maxNumPropretaire = $maxNumPropretaire + 1;
        $request->validate([
                //'pe_num' => '',
            'Denomination_fr'=> '',
            'Statut'=> '',
            'Tutelle'=> '',
            'txt_creation'=> '',
            'Decision_affectation'=> '',
            'Date_Decision_affectation'=> '',
            'Date_txt_creation' =>'',

            // 'CODE_II'=> '',
            'NOMENCLATURE'=> '',
            'paye_name'=> '',
            'paye_region'=> '',
            'paye_code'=> '',
            'Ref_JRN'=> '',
        ]);

        // dd($request->all());
        $proprietaire = Proprietaire::create([

            'id' => $maxNumPropretaire,
            'pe_num' => $maxNumPropretaire,
            // 'Num_ilot' => $request->input('Num_ilot'),
            'Denomination_fr'=> $request->input('Denomination_fr'),
            'Statut'=> $request->input('Statut'),
            'Tutelle'=> $request->input('Tutelle'),
            'txt_creation'=> $request->input('txt_creation'),
            'Decision_affectation'=> $request->input('Decision_affectation'),
            'Date_Decision_affectation'=> $request->input('Date_Decision_affectation'),
            //'Date_txt_creation' => now(),
            'Date_txt_creation'=> $request->input('Date_txt_creation'),

            // 'CODE_II'=> $request->input('CODE_II'),
            'NOMENCLATURE'=> $request->input('NOMENCLATURE'),
            'paye_name'=> $request->input('paye_name'),
            'paye_region'=> $request->input('paye_region'),
            'paye_code'=> $request->input('paye_code'),
            'Ref_JRN'=> $request->input('Ref_JRN'),
        ]);
        // dd($proprietaires->id);
        // Redirigez l'utilisateur avec un message de succès

        $pays = Pays::all();
        // $Proprietaires = Proprietaire::orderBy('id', 'DESC')->get();

        $jsonPath = public_path('algeria_cities.json');
        $jsonData = File::get($jsonPath);
        $cities = json_decode($jsonData, true);

        $wilayaNames = array_unique(array_column($cities, 'wilaya_name_ascii'));
        $dayraNames = array_unique(array_column($cities, 'daira_name_ascii'));
        // Créez un tableau associatif avec les mêmes valeurs que clés
        $wilayaNames = array_combine($wilayaNames, $wilayaNames);
        $dayraNames = array_combine($dayraNames, $dayraNames);

        return view('dashboard.Ilots.create', compact('pays','proprietaire',))
        ->with('success', 'Le Proprietaire a été créé avec succès.');

        // return redirect()->route('dashboard.ilots.create', compact('proprietaire'))
        // ->with('success', 'Le Proprietaire a été créé avec succès.');
    }

    public function store_ajax(Request $request){
        $maxNumPropretaire = Proprietaire::max('pe_num');
        $maxNumPropretaire = $maxNumPropretaire + 1;
        $request->validate([
                //'pe_num' => '',
            // 'Num_ilot'=> '',
            'Denomination_fr'=> '',
            'Statut'=> '',
            'Tutelle'=> '',
            'txt_creation'=> '',
            'Decision_affectation'=> '',
            'Date_Decision_affectation'=> '',
            'Date_txt_creation' =>'',
        ]);

        Proprietaire::create([
            'pe_num' => $maxNumPropretaire,
            // 'Num_ilot' => $request->input('Num_ilot'),
            'Denomination_fr'=> $request->input('Denomination_fr'),
            'Statut'=> $request->input('Statut'),
            'Tutelle'=> $request->input('Tutelle'),
            'txt_creation'=> $request->input('txt_creation'),
            'Decision_affectation'=> $request->input('Decision_affectation'),
            'Date_Decision_affectation'=> $request->input('Date_Decision_affectation'),
            //'Date_txt_creation' => now(),
            'Date_txt_creation'=> $request->input('Date_txt_creation'),

            'CODE_II'=> $request->input('CODE_II'),
            'NOMENCLATURE'=> $request->input('NOMENCLATURE'),
            'paye_name'=> $request->input('paye_name'),
            'paye_region'=> $request->input('paye_region'),
            'paye_code'=> $request->input('paye_code'),
            'Ref_JRN'=> $request->input('Ref_JRN'),
        ]);

        return redirect()->route('dashboard.proprietaires.index')->with('success', 'Le Proprietaire a été créé avec succès.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Num_proprietaire)
    {

        $proprietaire =  DB::table('dbo_personne')
        ->join('dbo_anx_statut', 'dbo_personne.Statut', '=', 'dbo_anx_statut.bi_natjur')
        ->join('dbo_anx_tutelle', 'dbo_personne.Tutelle', '=', 'dbo_anx_tutelle.bi_natjur')
        ->join('dbo_deciaffect', 'dbo_personne.Decision_affectation', '=', 'dbo_deciaffect.Deci_Af')

        ->join('dbo_anx_text_creati', 'dbo_personne.txt_creation', '=', 'dbo_anx_text_creati.bi_natjur')

        ->select('dbo_personne.*', 'dbo_anx_statut.intitule as anx_statut_intitule', 'dbo_deciaffect.intitule_fr as deciaffect_intitule' , 'dbo_anx_tutelle.intitule as tutelle_intitule' , 'dbo_anx_text_creati.intitule as text_creati_intitule')

        ->where('dbo_personne.pe_num', $Num_proprietaire)
        ->first();
        $proprietaire = Proprietaire::wherePeNum($Num_proprietaire)->first();
        return view('dashboard.proprietaire.show', compact('proprietaire'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit($Num_proprietaire)
    {
         $proprietaire =  DB::table('dbo_personne')
            ->join('dbo_anx_statut', 'dbo_personne.Statut', '=', 'dbo_anx_statut.bi_natjur')
            ->join('dbo_anx_tutelle', 'dbo_personne.Tutelle', '=', 'dbo_anx_tutelle.bi_natjur')
            ->join('dbo_deciaffect', 'dbo_personne.Decision_affectation', '=', 'dbo_deciaffect.Deci_Af')
            ->join('dbo_anx_text_creati', 'dbo_personne.txt_creation', '=', 'dbo_anx_text_creati.bi_natjur')
            ->select('dbo_personne.*', 'dbo_anx_statut.intitule as anx_statut_intitule', 'dbo_deciaffect.intitule_fr as deciaffect_intitule' , 'dbo_anx_tutelle.intitule as tutelle_intitule' , 'dbo_anx_text_creati.intitule as text_creati_intitule')
             ->where('dbo_personne.pe_num', $Num_proprietaire)
            ->first();

            // $deciaffect = Deciaffect::pluck('Intitule_fr','Deci_Af' );
            // $anx_statut = AnxStatut::pluck('Intitule','bi_natjur' );
            // $anx_tutelle = AnxTutelle::pluck('Intitule','bi_natjur' );
            // $anx_text_creati = AnxTextCreati::pluck('Intitule','bi_natjur' );

            $deciaffect = Deciaffect::get();
            $anx_statut = AnxStatut::get();
            $anx_tutelle = AnxTutelle::get();
            $anx_text_creati = AnxTextCreati::get();

        return view('dashboard.proprietaire.edit', compact('proprietaire', 'ilotOptions','deciaffect','anx_statut','anx_tutelle','anx_text_creati'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'Num_Bat' => '',
            'lot_surface' => '',
            'nb_indiv' => '',
            'Nature_Loc' => '',
            'mode_approp' => '',
            'droit_charge' => '',
            'type_enquete' => '',
            'nb_piece' => '',
            'NNatLoc' => '',

            'CODE_II'=> '',
            'NOMENCLATURE'=> '',
            'paye_name'=> '',
            'paye_region'=>'',
            'paye_code'=> '',
            'Ref_JRN'=> '',
        ]);

        $proprietaire = Proprietaire::where('pe_num', $request->id)->first();


        // $proprietaire->Num_ilot = $request->input('Num_ilot');
        $proprietaire->Denomination_fr = $request->input('Denomination_fr');
        $proprietaire->Statut = $request->input('Statut');
        $proprietaire->Tutelle = $request->input('Tutelle');
        $proprietaire->txt_creation = $request->input('txt_creation');
        $proprietaire->Decision_affectation = $request->input('Decision_affectation');
        $proprietaire->Date_Decision_affectation = $request->input('Date_Decision_affectation');
        $proprietaire->Date_txt_creation = $request->input('Date_txt_creation');

        $proprietaire->save();

        return redirect()->route('dashboard.proprietaires.index')->with('success', 'Proprietaire mis à jour avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Proprietaire::where('pe_num', $request->id)->delete();
        return redirect()->route('dashboard.proprietaires.index')->with('success', 'Proprietaire supprimé avec succès.');
    }

    public function payaSreach(Request $request){
        $name = $request->paysName;
        $pays = Pays::where('name', $name)->first();
        return response()->json($pays);
    }
    public function postes(Request $request){
        $id = $request->id;
        $postes = Postes::where('id_nomenclature', $id)->get();
        return response()->json($postes);
    }


    public function getProprietaireByPays(Request $request){

        // return response()->json($request);
        $proprietaires = Proprietaire::has('ilot')->where('paye_name', $request->paye_name)->get();          
        return response()->json($proprietaires);
    }
}
