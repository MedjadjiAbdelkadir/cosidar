<?php

namespace App\Http\Controllers\Dashboard\Acte;

use App\Models\Ilot;
use Illuminate\Http\Request;
use App\Models\ReferenceActe;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ActeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actes =  DB::table('dbo_reference_acte')
        ->paginate(PAGINATE_COUNT);

        return view('dashboard.acte.index')->with('actes', $actes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ilotOptions = Ilot::whereNotIn('Num_ilot', function ($query) {
            $query->select('Num_ilot')
                  ->from('dbo_reference_acte');
        })->pluck('Num_ilot', 'Num_ilot');

        return view('dashboard.acte.create', compact('ilotOptions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Num_ilot'=> '',
            'date_pub'=> '',
            'volume1'=> '',
            'case11'=> '',
            'Ref_JRN'=> '',
            'nature_acte'=> '',
            'Num_Nat_Acte'=> '',
            'Construction_Acte'=> '',
            'Origine_Acte'=> '',
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

        Reference_acte::create([
            'Num_ilot' => $request->input('Num_ilot'),
            'date_pub'=> $request->input('date_pub'),
            'volume1'=> $request->input('volume1'),
            'case11'=> $request->input('case11'),
            'Ref_JRN'=> $request->input('Ref_JRN'),    
            'nature_acte'=> $request->input('nature_acte'),
            'Num_Nat_Acte'   => $Num_Nat_Acte,
            'Construction_Acte'=> $request->input('Construction_Acte'), 
            'Origine_Acte' => $request->input('Origine_Acte'), 
        ]);

        return redirect()->route('dashboard.actes.index')->with('success', 'Acte a été créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acte = DB::table('dbo_reference_acte')->where('id', $id)->first();
        return view('dashboard.acte.show', compact('acte'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acte = DB::table('dbo_reference_acte')->where('id', $id)->first();

         $ilotOptions = Ilot::whereNotIn('Num_ilot', function ($query) {
            $query->select('Num_ilot')
                  ->from('dbo_reference_acte');
        })->pluck('Num_ilot', 'Num_ilot');
        
        return view('dashboard.acte.edit', compact('acte', 'ilotOptions'));
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
        $request->validate([
            'date_pub' => '',
            'volume1' => '',
            'case11' => '',
            'Ref_JRN' => '',
            'nature_acte' => '',
            'Num_Nat_Acte' => '',
            'Construction_Acte' => '',
            'Origine_Acte' => '',
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

        $acte = ReferenceActe::where('id', $id)->first();

    // Vérifie si le champ 'Num_ilot' est vide, sinon utilise la valeur actuelle
        $acte->Num_ilot = $request->input('Num_ilot') ? $request->input('Num_ilot') :$acte->Num_ilot;

        $acte->date_pub = $request->input('date_pub');
        $acte->volume1 = $request->input('volume1');
        $acte->case11 = $request->input('case11');
        $acte->Ref_JRN = $request->input('Ref_JRN');
        $acte->nature_acte = $request->input('nature_acte');
        $acte->Num_Nat_Acte = $Num_Nat_Acte;
        $acte->Origine_Acte = $request->input('Origine_Acte');

        $acte->save();
        return redirect()->route('dashboard.actes.index')
        ->with('success', 'Acte mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        ReferenceActe::where('id', $id)->delete();
        return redirect()->route('dashboard.actes.index')->with('success', 'acte supprimé avec succès.');
    }
     
}
