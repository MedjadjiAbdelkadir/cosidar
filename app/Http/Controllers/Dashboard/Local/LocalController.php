<?php

namespace App\Http\Controllers\Dashboard\Local;

use App\Models\Ilot;
use App\Models\Local;

use App\Models\Batiment;
use App\Models\NatureLocaux;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // dd('hhhh');

        $ilotOptions = Ilot::get();

        // dd($ilotOptions);
        $locaux =  DB::table('dbo_locaux')->orderBy('id','DESC')->join('dbo_anx_nature_locaux', 'dbo_locaux.Nature_Loc', '=', 'dbo_anx_nature_locaux.NNatLoc')->select('dbo_locaux.*', 'dbo_anx_nature_locaux.intitule as nature_loc')
                    ->paginate(PAGINATE_COUNT);

        $local = Local::join('dbo_batiment', 'dbo_batiment.Num_Bat', '=', 'dbo_locaux.Num_Bat')
        // ->where('dbo_locaux.lot_no', $Num_local)
        ->select('dbo_locaux.*', 'dbo_batiment.bat_no')
        ->first();
        $batimentOptions = [];
        if (!empty($local->Num_ilot)) {
            $batimentOptions = Batiment::where('Num_ilot', $local->Num_ilot)->get();
        }

        // Obtenez les options pour le champ Nature_Loc
        $nature_locaux = NatureLocaux::get();

        return view('dashboard.locaux.index',compact(['locaux','ilotOptions','batimentOptions', 'nature_locaux']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ilotOptions = Ilot::get();
        $nature_locaux = NatureLocaux::get();
        $batiment = Batiment::get();
        $batiment_id = $request->batiment_id;
        $batimentLoc = Batiment::find($batiment_id);

        $listBatiments = Batiment::where('Num_ilot',$batimentLoc->Num_ilot)->get();
        // dd($batiment);
        // Num_Bat
        // bat_no
        // dd($batiment_id);
        return view('dashboard.locaux.create', compact('listBatiments','nature_locaux','batiment','batimentLoc'));

        // $nature_locaux = NatureLocaux::pluck('intitule','NNatLoc');

        // return view('dashboard.locaux.create', compact('batimentLoc','nature_locaux'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $maxNumLoc = local::max('lot_no');
        $maxNumLoc = $maxNumLoc + 1;
        $request->validate([
            //'lot_no' => '',
            'Num_ilot' => '',
            'Num_Bat' => '',
            'lot_surface' => '',
            //'bat_no' => '',
            //'lot_bat' => '',
            'nb_indiv' => '',
            'Nature_Loc' => '',
            'mode_approp' => '',
            'droit_charge' => '',
            'type_enquete' => '',
            'nb_piece' => '',
            'NNatLoc' => '',
        ]);

        $Local = Local::create([
            'lot_no' => $maxNumLoc,
            'Num_ilot' => $request->input('Num_ilot'),
            'Num_Bat' => $request->input('Num_Bat'),
            'lot_surface' => $request->input('lot_surface'),
            //'bat_no' => $request->input('bat_no'),
            //'lot_bat' => $request->input('lot_bat'),
            'nb_indiv' => $request->input('nb_indiv'),
            'Nature_Loc' => $request->input('Nature_Loc'),
            //'mode_approp' => $request->input('mode_approp'),
            'droit_charge' => $request->input('droit_charge'),
            //'type_enquete' => $request->input('type_enquete'),
            'nb_piece' => $request->input('nb_piece'),
           // 'NNatLoc' => $request->input('NNatLoc'),
            // Ajoutez ici les autres champs
        ]);
        // $ilot = Ilot::find($batimentLoc->Num_ilot);

        $idBatimentAjoute =$Local->Num_Bat;
        // $batimentLoc = Batiment::find($batiment->id);
        $nature_locaux = NatureLocaux::get();
        $ilotOptions = Ilot::get();
        $batiment = Batiment::get();

        $ilot = Ilot::find($Local->Num_ilot);
        $batimentLoc = Batiment::find($Local ->Num_Bat);

        return view('dashboard.batiment.select', compact('ilot','batimentLoc','nature_locaux','ilotOptions','batiment'));

        // return redirect()->route('dashboard.locaux.index')->with('success', 'Le Local a été créé avec succès.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Num_local)
    {
        $local =  DB::table('dbo_locaux')->join('dbo_anx_nature_locaux', 'dbo_locaux.Nature_Loc', '=', 'dbo_anx_nature_locaux.NNatLoc')->select('dbo_locaux.*', 'dbo_anx_nature_locaux.intitule as nature_loc')->where('dbo_locaux.lot_no', $Num_local)->first();
        return view('dashboard.locaux.show', compact('local'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Num_local)
    {
       $local = Local::join('dbo_batiment', 'dbo_batiment.Num_Bat', '=', 'dbo_locaux.Num_Bat')
            ->where('dbo_locaux.lot_no', $Num_local)
            ->select('dbo_locaux.*', 'dbo_batiment.bat_no')
            ->first();


        // Obtenez les options pour le champ Num_ilot
        $ilotOptions = Ilot::pluck('Num_ilot', 'Num_ilot');

        // Obtenez les options pour le champ Num_Bat basées sur le Num_ilot actuel
        $batimentOptions = [];
        if (!empty($local->Num_ilot)) {
            $batimentOptions = Batiment::where('Num_ilot', $local->Num_ilot)->pluck('bat_no', 'Num_Bat');
        }

        // Obtenez les options pour le champ Nature_Loc
        $nature_locaux = NatureLocaux::pluck('intitule', 'NNatLoc');

        return view('dashboard.locaux.edit', compact('local', 'ilotOptions', 'batimentOptions', 'nature_locaux'))
        ->with('success', 'Le Local a été créé avec succès.');
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
        $request->validate([
            //'lot_no' => '',
            'Num_ilot' => '',
            'Num_Bat' => '',
            'lot_surface' => '',
            //'bat_no' => '',
            //'lot_bat' => '',
            'nb_indiv' => '',
            'Nature_Loc' => '',
            // 'mode_approp' => '',
            'droit_charge' => '',
            //'type_enquete' => '',
            'nb_piece' => '',
            //'NNatLoc' => '',
        ]);
        $local = Local::where('lot_no', $request->id)->first();
        $local->Num_Bat = $request->input('Num_Bat');
        $local->lot_surface = $request->input('lot_surface');
        $local->bat_no = $request->input('bat_no');
        $local->lot_bat = $request->input('lot_bat');
        $local->nb_indiv = $request->input('nb_indiv');
        $local->Nature_Loc = $request->input('Nature_Loc');
        $local->mode_approp = $request->input('mode_approp');
        $local->droit_charge = $request->input('droit_charge');
        $local->type_enquete = $request->input('type_enquete');
        $local->nb_piece = $request->input('nb_piece');
        $local->NNatLoc = $request->input('NNatLoc');
        $local->save();

        return redirect()->route('dashboard.locaux.index')->with('success', 'Local mis à jour avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Request $request)
    {
        // Supprimez l'ilot en fonction de son Num_ilot
        Local::where('lot_no', $request->id)->delete();
        // Redirigez vers la page d'index avec un message de succès
        return redirect()->route('dashboard.locaux.index')->with('success', 'Local supprimé avec succès.');
    }
}
