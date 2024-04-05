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
                    {{-- <div class="form-group col-md-6">
                        <label for="Num_ilot" class="mr-sm-2">Numéro de l'îlot :</label>
                        <input type="text" class="form-control" disabled name="Num_ilot"  value="{{ $proprietaire->Num_ilot }}">
                    </div> --}}
                    <div class="form-group col-md-6">
                        <label for="Denomination_fr" class="mr-sm-2">Dénomination (fr) :</label>
                        <input type="text" class="form-control" disabled name="Denomination_fr"  value="{{ $proprietaire->Denomination_fr }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Statut" class="mr-sm-2">Statut :</label>
                        <input type="text" class="form-control" disabled name="Statut" value="{{ $proprietaire->Statut }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Tutelle" class="mr-sm-2">Tutelle :</label>
                        <input type="text" class="form-control" disabled name="Tutelle" value="{{ $proprietaire->Tutelle }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="txt_creation" class="mr-sm-2">Texte de création :</label>
                        <input type="text" class="form-control" disabled name="txt_creation" value="{{ $proprietaire->txt_creation }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Decision_affectation" class="mr-sm-2">Décision d'affectation :</label>
                        <input type="text" class="form-control" disabled name="Decision_affectation" value="{{ $proprietaire->Decision_affectation }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="Date_Decision_affectation" class="mr-sm-2">Date de décision d'affectation :</label>
                        <input type="text" class="form-control" disabled name="Date_Decision_affectation" value="{{ $proprietaire->Date_Decision_affectation }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="Date_txt_creation" class="mr-sm-2">Date de création :</label>
                        <input type="date" class="form-control" disabled name="Date_txt_creation" value="{{ \Carbon\Carbon::parse($proprietaire->Date_txt_creation)->format('Y-m-d') }}">
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <form action="" method="get">
                    <input hidden type="text" name="" value="{{ $proprietaire->id }}">
                    <button type="submit" class="btn btn-outline-success">Ajoute Ilot</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection



