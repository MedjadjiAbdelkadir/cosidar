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
                    <div class="form-group col-md-3">
                        <label for="Num_ilot" class="mr-sm-2">Numéro de l'îlot :</label>
                        <input type="text" disabled  name="Num_ilot" class="form-control" value="{{ $local->Num_ilot }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="Num_Bat" class="mr-sm-2">Numéro du Bâtiment :</label>
                        <input type="text" disabled  name="Num_ilot" class="form-control" value="{{ $local->Num_Bat }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Nature_Loc" class="mr-sm-2">Nature du Local :</label>
                        <input type="text" disabled  name="Num_ilot" class="form-control" value="{{ $local->Nature_Loc }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="lot_surface" class="mr-sm-2">Surface du Lot :</label>
                        <input type="text" class="form-control" disabled name="lot_surface" value="{{ $local->lot_surface }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="nb_piece" class="mr-sm-2">Nombre de Pièces :</label>
                        <input type="text" class="form-control" disabled name="nb_piece" value="{{ $local->nb_piece }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="nb_indiv" class="mr-sm-2">Nombre d'Individus :</label>
                        <input type="text" class="form-control" disabled name="nb_indiv" value="{{ $local->nb_indiv }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label for="droit_charge" class="mr-sm-2">Droit de Charge :</label>
                        <input type="text" class="form-control" disabled name="droit_charge" value="{{ $local->droit_charge }}">
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

