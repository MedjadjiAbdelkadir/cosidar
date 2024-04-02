<?php

namespace App\Http\Controllers\Dashboard\Inventaire;

use App\Models\Ilot;
use App\Models\Pays;
use App\Models\Inventaire;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Gd\Commands\InvertCommand;

class InventaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $Ilots = Ilot::paginate(PAGINATE_COUNT);
// with('proprietaire','')->
        // $proprietaires = Proprietaire::has('ilot')->with('ilot')->paginate(PAGINATE_COUNT);
        // dd($proprietaires);

        // $proprietaires = Proprietaire::where('id',17)->with('ilot')->get();

        $ilotOptions = Ilot::get();
        

        $jsonPath = public_path('country.json');

        if (File::exists($jsonPath)) {
            $jsonData = json_decode(file_get_contents($jsonPath), true);
        } else {
            $jsonData = [];
        }
        $Ilots = Ilot::with('proprietaire','anx_nature_imm','anx_entretien','acteReference', 'batiments.locaux')
        ->join('dbo_anx_nature_imm', 'dbo_ilot.Nature', '=', 'dbo_anx_nature_imm.Num_Nat_imm')
        ->join('dbo_anx_entretien', 'dbo_anx_entretien.num_Lv', '=', 'dbo_ilot.intit_Entretien')
        ->select('dbo_ilot.*', 'dbo_anx_nature_imm.intitule as nature_nom', 'dbo_anx_entretien.intitule as entretien_intitule')
        ->paginate(PAGINATE_COUNT);

        return view('dashboard.inventaire.index', compact('ilotOptions' ,'Ilots', 'jsonData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ilotOptions = Ilot::get();

        $pays = Pays::all();
        return view('dashboard.inventaire.create', compact('pays','ilotOptions'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->N_ilot);
        $inventaire = Inventaire::create([
            'num_ilot' => $request->N_ilot,
            'date_inv' => $request->date_inv,
            'designation'=> $request->designation,
            'photos'     => 'img.png',
            'vedio'      => 'video.mp4',
            // 'photos'     => $request->photos,
            // 'vedio'      => $request->vedio,
            'observation'=> $request->observation,

            'Denom_Ilot' => $request->Denom_Ilot, 
            'Denomination_fr' => $request->Denomination_fr, 
            'paye_name' => $request->paye_name, 
            'responsable_inventaire' => $request->responsable_inventaire, 
            'statut_inventaire' => $request->statut_inventaire, 
            'TypeInventaire'=> $request->TypeInventaire,
        ]);
        

        return redirect()->route('dashboard.fournisseurs.create', compact('inventaire'))->with('success', 'Le Inventaires a été créé avec succès.');
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
