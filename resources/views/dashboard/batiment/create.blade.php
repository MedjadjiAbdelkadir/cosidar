@extends('layouts.admin.master')
@section('css')

@section('title')
Batiments
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Dashboard</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Dashboard</a></li>
                <li class="breadcrumb-item active">Batiments</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <form autocomplete="off" action="{{ route('dashboard.batiments.store') }}" method="POST">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name" class="mr-sm-2">Numéro interne du Bâtiment (bat_no) :</label>
                        <input id="name" type="text" name="bat_no" class="form-control">
                    </div>
                    @if (isset($ilot))
                    <div class="form-group col-md-3">
                        <label for="name" class="mr-sm-2"> Denom Ilot :</label>
                        <input type="text" value="{{ $ilot->Denom_Ilot }}" class="form-control" disabled>
                        <input id="name" type="hidden" name="Num_ilot" value="{{ $ilot->id }}" class="form-control">
                    </div>
                    @else
                    <div class="form-group col-md-3">
                        <label for="Num_ilot" class="mr-sm-2">Sélectionnez un Numéro d\'îlot' :</label>
                        <select class="custom-select" name="Num_ilot">
                            <option disabled>Select Numéro dîlot</option>
                            @foreach ( $ilotOptions as $ilot)
                                <option value="{{ $ilot->Num_ilot }}">{{ $ilot->N_ilot }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div class="form-group col-md-3">
                        <label for="Nbr_Niveau" class="mr-sm-2">Nombre de Niveaux :</label>
                        <select class="custom-select" name="Nbr_Niveau">
                            <option disabled >Select Nombre de Niveaux</option>
                            @for ($i = 0; $i < 400; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="sup_SDHO" class="mr-sm-2">Surface SDHO :</label>
                        <input type="text" class="form-control" name="sup_SDHO">
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="sup_bati_cons" class="mr-sm-2">Sup Bati Cons :</label>
                        <input type="text" class="form-control" name="sup_bati_cons">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="nom_bat" class="mr-sm-2">Nom du Bâtiment :</label>
                        <input type="text" class="form-control" name="nom_bat">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="bat_desc" class="mr-sm-2">Description du Bâtiment :</label>
                        <input type="text" class="form-control" name="bat_desc">
                    </div>

                </div>

            </div>
            <div class="card-footer">
                <a href="{{ route('dashboard') }}" class="btn btn-secondary text-white" >Return Dashboard</a>
                <a href="{{ route('dashboard.ilots.index') }}" class="btn btn-secondary text-white" >Return ILot</a>
                <button type="submit" class="btn btn-success">Create</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
