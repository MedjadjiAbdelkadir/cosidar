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
                        <label for="Num_ilot" class="mr-sm-2">Changer le numéro de l'îlot :</label>
                        <input type="text" class="form-control" name="Num_ilot" disabled value="{{ $acte->Num_ilot }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date_pub" class="mr-sm-2">Date de publication :</label>
                        <input type="date" class="form-control" name="date_pub" disabled value="{{ $acte->date_pub }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nature_acte" class="mr-sm-2">Nature d'acte :</label>
                        <input type="text" class="form-control" name="nature_acte" disabled value="{{ $acte->nature_acte }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="volume1" class="mr-sm-2">Volume1 :</label>
                        <input type="text" class="form-control" name="volume1" value="{{ $acte->volume1 }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Construction_Acte" class="mr-sm-2">Construction d'acte :</label>
                        <input type="text" class="form-control" name="Construction_Acte" disabled value="{{ $acte->Construction_Acte }}">
                    </div>


                    <div class="form-group col-md-6">
                        <label for="Origine_Acte" class="mr-sm-2">Origine_Acte :</label>
                        <input type="text" class="form-control" name="Ref_JRN" disabled value="{{ $acte->Origine_Acte }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="Ref_JRN" class="mr-sm-2">Ref_JRN :</label>
                        <input type="text" class="form-control" name="Ref_JRN" disabled value="{{ $acte->Ref_JRN }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="case11" class="mr-sm-2">Case11 :</label>
                        <input type="text" class="form-control" name="case11" disabled value="{{ $acte->case11 }}">
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




