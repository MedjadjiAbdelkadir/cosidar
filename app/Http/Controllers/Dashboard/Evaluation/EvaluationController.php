<?php

namespace App\Http\Controllers\Dashboard\Evaluation;

use App\Http\Controllers\Controller;
use App\Models\Ilot;
use App\Models\Pays;
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    public function index(Request $request)
    {
        $pays= Pays::all();
        if (!is_null($request->paysName)) {
            $ilots = DB::table('dbo_personne')
                ->join('dbo_ilot', 'dbo_personne.id', '=', 'dbo_ilot.proprietaire_id')
                ->select('dbo_personne.*', 'dbo_ilot.*')
                ->where('dbo_personne.paye_name',$request->paysName)
                ->orderBy('dbo_personne.id', 'desc')
                ->paginate(PAGINATE_COUNT);
        } else {
            $ilots = DB::table('dbo_personne')
                ->join('dbo_ilot', 'dbo_personne.id', '=', 'dbo_ilot.proprietaire_id')
                ->select('dbo_personne.*', 'dbo_ilot.*')
                ->Where('dbo_personne.paye_name','Algeria')
                ->orderBy('dbo_personne.id', 'desc')
                ->paginate(PAGINATE_COUNT);
        }

        return view('dashboard.Evaluation.index',compact('ilots','pays'));

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $ilot = Ilot::find($id);
        return view('dashboard.Evaluation.etat-immeuble', compact('ilot'));
    }

    public function biensConsider(Request $request)
    {
        // dd($request->input('paye'));
        $proprietaires = Proprietaire::where('paye_name', $request->input('paye'))->first();
        $proprietaires->paye = $proprietaires->paye_name;
        $proprietaires->region = $proprietaires->paye_region;
        $proprietaireIds = Proprietaire::where('paye_name', $request->input('paye'))->pluck('id')->toArray();
        $ilots = Ilot::whereIn('proprietaire_id',$proprietaireIds)->get();
        // dd($proprietaires);
        return view('dashboard.Evaluation.etat-sortie', compact('ilots','proprietaires'));
    }
    public function immeuble($id)
    {
        $ilot = Ilot::find($id);
        return view('dashboard.Evaluation.etat-immeuble', compact('ilot'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
