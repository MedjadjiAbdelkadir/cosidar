@extends('layouts.admin.master')
@section('css')

@section('title')
ORIGINE DES DROITS
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
                <li class="breadcrumb-item">ORIGINE DES DROITS</li>
                <li class="breadcrumb-item active">ORIGINE DES DROITS</li>
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
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="name" class="mr-sm-2">Numéro interne du Bâtiment (bat_no) :</label>
                        <input id="name" type="text" name="name" disabled value="{{ $batiment->bat_no }}" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Num_ilot" class="mr-sm-2">Sélectionnez un Numéro d\'îlot' :</label>
                        <input id="Num_ilot" type="text" name="Num_ilot" disabled value="{{ $batiment->Num_ilot }}" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Nbr_Niveau" class="mr-sm-2">Nombre de Niveaux' :</label>
                        <input id="Num_ilot" type="text" name="Num_ilot" disabled value="{{ $batiment->Nbr_Niveau }}" class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sup_SDHO" class="mr-sm-2">Surface SDHO :</label>
                        <input type="text" class="form-control" disabled name="sup_SDHO" value="{{ $batiment->sup_SDHO }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="nom_bat" class="mr-sm-2">Nom du Bâtiment :</label>
                        <input type="text" class="form-control" disabled name="nom_bat" value="{{ $batiment->nom_bat }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="bat_desc" class="mr-sm-2">Description du Bâtiment :</label>
                        <input type="text" class="form-control" disabled name="bat_desc" value="{{ $batiment->bat_desc }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
