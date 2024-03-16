<?php

namespace App\Http\Controllers\Dashboard\IlotsArchive;

use App\Models\Ilot;
use App\Models\Customer;
use App\Models\IlotArchive;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use App\Models\ReferenceActe;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ReferenceActeArchive;

class IlotsArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ilotarchive


        $ilots = DB::table('ilotarchive')
        ->join('dbo_anx_nature_imm', 'ilotarchive.Nature', '=', 'dbo_anx_nature_imm.Num_Nat_imm')
        ->select('ilotarchive.*', 'dbo_anx_nature_imm.intitule as nature_nom')
        ->orderBy('id', 'desc')
        ->paginate(PAGINATE_COUNT);

        // $ilots = IlotArchive::with('proprietaire')->paginate(PAGINATE_COUNT);;
        return view('dashboard.IlotsArchive.index',compact('ilots'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $Proprietaires = Proprietaire::where('customer_id' , null)->orderBy('id', 'DESC')->get();

        $Proprietaires = Proprietaire::has('ilot')->orderBy('id', 'DESC')->get();

        return view('dashboard.IlotsArchive.create', compact('Proprietaires'));

    }

    public function getIlotByProprietaireId(Request $request){
        $ilots = Ilot::where('proprietaire_id', $request->id)->get();
        return response()->json($ilots);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $customer = Customer::create([
            'nom'    => $request->nom,
            'pernom' => $request->pernom,
            'email'  => $request->email,
            'phone'  => $request->phone,
            'date_naissance' => $request->date_naissance,
            'adresse'=> $request->adresse,
            'nationalité'=> $request->nationalité,
            'type_juridique'=> $request->type_juridique,
        ]);

        $ilot = Ilot::find($request->ilot_id);

        $ilotArchive = IlotArchive::create([
            'proprietaire_id' => $ilot->proprietaire_id ,
            'nature_opération'=> $request->nature_opération,
            'Num_ilot' => $ilot->Num_ilot ,
            'N_ilot' => $ilot->N_ilot ,
            'Denom_Ilot' => $ilot->Denom_Ilot ,
            'Denom_Ilot_ar' => $ilot->Denom_Ilot_ar ,
            'Nature' => $ilot->Nature ,
            'Nature_ar' => $ilot->Nature_ar ,
            'Utlisation' => $ilot->Utlisation ,
            'Utlisation_ar' => $ilot->Utlisation_ar ,
            'Rue_fr' => $ilot->Rue_fr ,
            'Rue_ar' => $ilot->Rue_ar ,
            'Localite' => $ilot->Localite ,
            'Localite_ar' => $ilot->Localite_ar ,
            'Ville' => $ilot->Ville ,
            'ville_ar' => $ilot->ville_ar ,
            'Pays_ar' => $ilot->Pays_ar ,
            'Pays' => $ilot->Pays ,
            'il_surf_cadastree' => $ilot->il_surf_cadastree ,
            'tot_sup_bati' => $ilot->tot_sup_bati ,
            'tot_sup_SDHO' => $ilot->tot_sup_SDHO ,
            'Num_Rue' => $ilot->Num_Rue ,
            'nb_batiment' => $ilot->nb_batiment ,
            'nb_lot' => $ilot->nb_lot ,
            'Tot_sub_locaux' => $ilot->Tot_sub_locaux ,
            'Int_VV' => $ilot->Int_VV ,
            'Int_VV_ar' => $ilot->Int_VV_ar ,
            'NumVV' => $ilot->NumVV ,
            'mantant_VV' => $ilot->mantant_VV ,
            'Int_VL' => $ilot->Int_VL ,
            'N_ilot' => $ilot->N_ilot ,
            'Int_VLAr' => $ilot->Int_VLAr ,
            'mantant_VL' => $ilot->mantant_VL ,
            'NumVL' => $ilot->NumVL ,
            'Age' => $ilot->Age ,
            'Num_Entretien' => $ilot->Num_Entretien ,
            'intit_Entretien' => $ilot->intit_Entretien ,
            'intit_Entretien_ar' => $ilot->intit_Entretien_ar ,
            'nb_batis' => $ilot->nb_batis ,
            'Origine_Acte' => $ilot->Origine_Acte ,
            'Origine_Acte_ar' => $ilot->Origine_Acte_ar ,
            'type_enquete' => $ilot->type_enquete ,
            'type_enquete_ar' => $ilot->type_enquete_ar ,
            'Observation_enqueteur' => $ilot->Observation_enqueteur ,
            'date_sais' => $ilot->date_sais ,
            'date_Enquete' => $ilot->date_Enquete ,
            'Num_enqui' => $ilot->Num_enqui ,
            'cord_X' => $ilot->cord_X ,
            'cord_y' => $ilot->cord_y ,
            'image' => $ilot->image ,
            'mantVV' => $ilot->mantVV ,
            'mantVL' => $ilot->mantVL ,
            'validation' => $ilot->validation ,
            'created_by' => $ilot->created_by ,
            'datearchive' => now()

        ]);

        $ilot->customer_id = $customer->id;
        $ilot->proprietaire_id = null;
        $ilot->save();

        $referenceActe  = ReferenceActe::where('Num_ilot',$ilot->id)->first();

        ReferenceActeArchive::create([
            'Num_ilot'   => $referenceActe->Num_ilot ,
            'Intitule'   => $referenceActe->Intitule ,
            'lot_no'   => $referenceActe->lot_no ,
            'bat_no'   => $referenceActe->bat_no ,
            'Num_Nat_Acte'   => $referenceActe->Num_Nat_Acte ,
            'NumConstruction_Acte'   => $referenceActe->NumConstruction_Acte ,
            'Num_Origine_Acte'   => $referenceActe->Num_Origine_Acte ,
            'date_pub'   => $referenceActe->date_pub ,
            'volume1'   => $referenceActe->volume1 ,
            'case11'   => $referenceActe->case11 ,
            'Ref_JRN'   => $referenceActe->Ref_JRN ,
            'nom_redact_acte'   => $referenceActe->nom_redact_acte ,
            'nature_acte'   => $referenceActe->nature_acte ,
            'Construction_Acte'   => $referenceActe->Construction_Acte ,
            'Origine_Acte'   => $referenceActe->Origine_Acte ,  

            'datearchive' => now()
        ]);

        if($request->input('nature_acte') == 'Loi'){
            $Num_Nat_Acte=1;
        }
        if($request->input('nature_acte') == 'Décret'){
            $Num_Nat_Acte=2;
        }
        if($request->input('nature_acte') == 'Arrêté'){
            $Num_Nat_Acte=3;
        }
        if($request->input('nature_acte') == 'Acte'){
            $Num_Nat_Acte=4;
        }
        if($request->input('nature_acte') == 'Convention bilatérale'){
            $Num_Nat_Acte=5;
        }
        if($request->input('nature_acte') == 'Non renseigner'){
            $Num_Nat_Acte=6;
        }


        ReferenceActe::create([
            'Num_ilot' => $ilot->Num_ilot,
            'date_pub'=> $request->input('date_pub'),
            'volume1'=> $request->input('Volume'),
            'case11'=> $request->input('case'),
            'nature_acte'=> $request->input('nature_acte'),
            'Num_Nat_Acte'   => $Num_Nat_Acte,
            'Construction_Acte'=> $request->input('Construction_Acte'),
            'Origine_Acte' => $request->input('Origine_Acte'),
        ]);
        
        return redirect()->route('dashboard.ilots-archive.index')->with('success', 'Votre bien va etre Archivé');
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
