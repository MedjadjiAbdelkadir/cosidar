<?php

namespace App\Http\Controllers\Dashboard\Evaluation;

use App\Http\Controllers\Controller;
use App\Models\Ilot;
use App\Models\Pays;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EvaluationController extends Controller
{
    public function index(Request $request)
    {
        $pays= Pays::all();
        if ($request->has('paysName')) {
            $ilots = DB::table('dbo_personne')
                ->join('dbo_ilot', 'dbo_personne.id', '=', 'dbo_ilot.proprietaire_id')
                ->select('dbo_personne.*', 'dbo_ilot.*')
                ->where('dbo_personne.paye_name',$request->input('paysName'))
                ->orderBy('dbo_personne.id', 'desc')
                ->paginate(PAGINATE_COUNT);

                return view('dashboard.Evaluation.index',compact('ilots','pays'));
        }
        else {
            $ilots = DB::table('dbo_personne')
                ->join('dbo_ilot', 'dbo_personne.id', '=', 'dbo_ilot.proprietaire_id')
                ->select('dbo_personne.*', 'dbo_ilot.*')
                // ->where('dbo_personne.paye_name','Algeria')
                ->orderBy('dbo_personne.id', 'desc')
                ->paginate(PAGINATE_COUNT);
            // dd($ilots);
            return view('dashboard.Evaluation.index',compact('ilots','pays'));
        }


        // dd($ilots);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
