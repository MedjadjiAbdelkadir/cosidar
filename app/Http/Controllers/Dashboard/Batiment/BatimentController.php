<?php

namespace App\Http\Controllers\Dashboard\Batiment;

use App\Models\Ilot;
use App\Models\Local;
use App\Models\Batiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\NatureLocaux;

class BatimentController extends Controller
{
    public function index()
    {
        $batiments =  DB::table('dbo_batiment')->select('dbo_batiment.*')->paginate(PAGINATE_COUNT);
        $ilotOptions = Ilot::pluck('Num_ilot', 'Num_ilot');
        return view('dashboard.batiment.index',compact(['batiments','ilotOptions']));
    }

    public function create(Request $request)
    {
        $ilots = Ilot::find($request->ilot_id);
        if (!$ilots) {
            return redirect()->back()->with('error','Désolé, une erreur s\'est produite. Veuillez réessayer');
        } else {
            return view('dashboard.batiment.create', compact('ilots'));
        }

    }

    public function create_ajax()
    {
        $ilotOptions = Ilot::pluck('Num_ilot', 'Num_ilot');
        return view('dashboard.batiment.create_ajax', compact('ilotOptions'));
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

        $maxNumBat = Batiment::max('Num_Bat');
        $maxNumBat = $maxNumBat + 1;

        $validatedData = $request->validate([

            //////////////////////
            // 'Num_Bat' => '',
            'bat_no'=> '',
            'Num_ilot'=> '',
            'Nbr_Niveau'=> '',
            'sup_bati_cons'=> '',
            'sup_SDHO'=> '',
            //'lot_bat'=> '',
            'nom_bat'=> '',
            'bat_desc'=> '',
            //'nbr_loc'=> '',
        ]);
            // Créez un nouveau modèle Ilot avec le nouveau Num_ilot
        $batiment =  Batiment::create([
            ///////////////////
            'Num_Bat' => $maxNumBat,
            'bat_no'=> $validatedData['bat_no'],
            'Num_ilot'=> $validatedData['Num_ilot'],
            'Nbr_Niveau'=> $validatedData['Nbr_Niveau'],
            // 'sup_bati_cons'=> $validatedData['sup_bati_cons'],
            'sup_SDHO'=> $validatedData['sup_SDHO'],
            //'lot_bat'=> $validatedData['lot_bat'],
            'nom_bat'=> $validatedData['nom_bat'],
            'bat_desc'=> $validatedData['bat_desc'],
            //'nbr_loc'=> $validatedData['nbr_loc'],
                ////////////////
        ]);

        $idBatimentAjoute =$batiment->Num_Bat;
        $batimentLoc = Batiment::find($batiment->id);
        $nature_locaux = NatureLocaux::get();
        $ilotOptions = Ilot::get();
        return view('dashboard.locaux.create', compact('batimentLoc','nature_locaux','ilotOptions'));
        // Redirigez vers l'index avec un message de succès
        // return redirect()->route('dashboard.locaux.create')->with('success', "Batiment ajouté avec succès ! (ID : $idBatimentAjoute)");// il faut retourner que json
    }

    public function store_ajax(Request $request)
    {
        $maxNumBat = Batiment::max('Num_Bat');
        $maxNumBat = $maxNumBat + 1;
        $validatedData = $request->validate([
            //////////////////////
            // 'Num_Bat' => '',
            'bat_no'=> '',
            'Num_ilot'=> '',
            'Nbr_Niveau'=> '',
            'sup_bati_cons'=> '',
            'sup_SDHO'=> '',
            //'lot_bat'=> '',
            'nom_bat'=> '',
            'bat_desc'=> '',
            //'nbr_loc'=> '',
        ]);
        // Créez un nouveau modèle Ilot avec le nouveau Num_ilot
        $batiment = Batiment::create([
        ///////////////////
            'Num_Bat' => $maxNumBat,
            'bat_no'=> $validatedData['bat_no'],
            'Num_ilot'=> $validatedData['Num_ilot'],
            'Nbr_Niveau'=> $validatedData['Nbr_Niveau'],
            'sup_bati_cons'=> $validatedData['sup_bati_cons'],
            'sup_SDHO'=> $validatedData['sup_SDHO'],
        //'lot_bat'=> $validatedData['lot_bat'],
            'nom_bat'=> $validatedData['nom_bat'],
            'bat_desc'=> $validatedData['bat_desc'],
        //'nbr_loc'=> $validatedData['nbr_loc'],
            ////////////////
        ]);


        // Redirigez vers l'index avec un message de succès
        return redirect()->route('dashboard.locaux.create')->with('success', 'Batiment ajouté avec succès !'); // il faut retourner que json
    }

    public function show($Num_batiment)
    {
        $batiment = DB::table('dbo_batiment')

            ->where('dbo_batiment.Num_Bat', $Num_batiment)

            ->first();

        $nombreLocaux = Local::where('Num_Bat', $Num_batiment)->count();


        return view('dashboard.batiment.show', compact('batiment','nombreLocaux'));
    }

    public function edit($Num_batiment)
    {
        $batiment = Batiment::where('Num_Bat', $Num_batiment)->first();

        $ilotOptions = Ilot::pluck('Num_ilot', 'Num_ilot'); // Remplacez 'Ilot' par le nom de votre modèle d'îlot si nécessaire

        return view('dashboard.batiment.edit', compact('batiment', 'ilotOptions'));
    }

    public function update(Request $request, $Num_batiment)
    {
        // dd($request->all());
        $request->validate([
            'bat_no' => '',
            'Num_ilot' => '',
            'Nbr_Niveau' => '',
            'sup_bati_cons' => '',
            'sup_SDHO' => '',
            'lot_bat' => '',
            'nom_bat' => '',
            'bat_desc' => '',
            'nbr_loc' => '',
        ]);
        $batiment_id = $request->batiment_id;

        $batiment = Batiment::find($batiment_id);
        // $batiment->Num_Bat    = $batiment;
        $batiment->bat_no     = $request->input('bat_no');
        $batiment->Num_ilot   = $request->input('Num_ilot');
        $batiment->Nbr_Niveau = $request->input('Nbr_Niveau');
        $batiment->sup_bati_cons = $request->input('sup_bati_cons');
        $batiment->sup_SDHO = $request->input('sup_SDHO');
        $batiment->lot_bat  = $request->input('lot_bat');
        $batiment->nom_bat  = $request->input('nom_bat');
        $batiment->bat_desc = $request->input('bat_desc');
        $batiment->nbr_loc  = $request->input('nbr_loc');
        $batiment->save();

        $batimentLoc = $batiment;
        $nature_locaux = NatureLocaux::pluck('intitule','NNatLoc');
        // dd($nature_locaux);
        return view('dashboard.locaux.create', compact('batimentLoc','nature_locaux'));
        // return redirect()->route('dashboard.locaux.create')->with('success', 'Le bâtiment a été mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($Num_batiment)
    {
        $batiment = Batiment::where('Num_Bat', $Num_batiment)->first();

        if (!$batiment) {
            return redirect()->back()->with('error', 'Batiment introuvable.');
        }
        // Affichez la vue de confirmation de suppression
        return view('dashboard.batiment.confirm-delete', compact('batiment'));
    }

    public function destroy($Num_batiment)
    {
        // Supprimez l'ilot en fonction de son Num_ilot
        Batiment::where('Num_Bat', $Num_batiment)->delete();

        // Redirigez vers la page d'index avec un message de succès
        return redirect()->route('batiments.index')->with('success', 'Batiment supprimé avec succès.');
    }

    public function getBatimentsByIlot(Request $request)
    {
        $num_ilot = $request->input('num_ilot');

        $batiments = Batiment::where('Num_ilot', $num_ilot)->pluck('bat_no', 'Num_Bat');
       // dd($batiments);

        return response()->json($batiments);
    }


}
