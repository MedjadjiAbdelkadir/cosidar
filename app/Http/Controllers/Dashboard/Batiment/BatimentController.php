<?php

namespace App\Http\Controllers\Dashboard\Batiment;

use App\Models\Ilot;
use App\Models\Batiment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class BatimentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batiments =  DB::table('dbo_batiment')->select('dbo_batiment.*')->paginate(PAGINATE_COUNT);
            
        return view('dashboard.batiment.index')->with('batiments', $batiments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ilotOptions = Ilot::pluck('Num_ilot', 'Num_ilot');


        return view('batiments.create', compact('ilotOptions'));
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
            'sup_bati_cons'=> $validatedData['sup_bati_cons'], 
            'sup_SDHO'=> $validatedData['sup_SDHO'],
            //'lot_bat'=> $validatedData['lot_bat'], 
            'nom_bat'=> $validatedData['nom_bat'], 
            'bat_desc'=> $validatedData['bat_desc'], 
            //'nbr_loc'=> $validatedData['nbr_loc'],
                ////////////////
        ]);

        $idBatimentAjoute =$batiment->Num_Bat;
        // Redirigez vers l'index avec un message de succès
        return redirect()->route('batiments.index')->with('success', "Batiment ajouté avec succès ! (ID : $idBatimentAjoute)");// il faut retourner que json
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
        return redirect()->route('dashboard.batiment.index')->with('success', 'Batiment ajouté avec succès !'); // il faut retourner que json
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Num_batiment)
    {
        $batiment = DB::table('dbo_batiment')
           
            ->where('dbo_batiment.Num_Bat', $Num_batiment)
           
            ->first();
    
        $nombreLocaux = Local::where('Num_Bat', $Num_batiment)->count();
    
    
        return view('dashboard.batiment.show', compact('batiment','nombreLocaux'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Num_batiment)
    {
        $batiment = Batiment::where('Num_Bat', $Num_batiment)->first();
    
        $ilotOptions = Ilot::pluck('Num_ilot', 'Num_ilot'); // Remplacez 'Ilot' par le nom de votre modèle d'îlot si nécessaire
    
        return view('dashboard.batiment.edit', compact('batiment', 'ilotOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Num_batiment)
    {
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

        $batiment = Batiment::where('Num_Bat', $Num_batiment)->first();
        $batiment->update([
            'bat_no' => $request->input('bat_no'),
            'Num_ilot' => $request->input('Num_ilot'),
            'Nbr_Niveau' => $request->input('Nbr_Niveau'),
            'sup_bati_cons' => $request->input('sup_bati_cons'),
            'sup_SDHO' => $request->input('sup_SDHO'),
            'lot_bat' => $request->input('lot_bat'),
            'nom_bat' => $request->input('nom_bat'),
            'bat_desc' => $request->input('bat_desc'),
            'nbr_loc' => $request->input('nbr_loc'),
        ]);
        return redirect()->route('batiments.index')->with('success', 'Le bâtiment a été mis à jour avec succès.');
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
