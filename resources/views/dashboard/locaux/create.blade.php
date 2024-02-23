@extends('layouts.admin.master')
@section('css')

@section('title')
Ajoute Locaux
@stop
@endsection
@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Dashboard</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Dashboard</a></li>
                <li class="breadcrumb-item active">Locaux</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <form action="{{ route('dashboard.locaux.store') }}" method="POST">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="Num_ilot" class="mr-sm-2">Numéro de l'îlot :</label>
                            <input type="text" hidden name="Num_ilot" value="{{ $batimentLoc->Num_ilot }}">
                            <input type="text" class="form-control"   value="{{ $batimentLoc->Num_ilot }}" disabled >
                        </div>

                        <div class="form-group col-md-3">
                            <label for="Num_Bat" class="mr-sm-2">Numéro du Bâtiment :</label>
                            <input type="text" hidden name="Num_Bat"  value="{{ $batimentLoc->id }}" >
                            <input type="text" class="form-control"   value="{{ $batimentLoc->id }}"  disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Nature_Loc" class="mr-sm-2">Nature du Local :</label>
                            <select class="custom-select" name="Nature_Loc">
                                <option disabled>Select Nature du Local</option>
                                @foreach ( $nature_locaux as $Nature_Loc)
                                    <option value="{{ $Nature_Loc }}">{{ $Nature_Loc }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="lot_surface" class="mr-sm-2">Surface du Lot :</label>
                            <input type="text" class="form-control" name="lot_surface" >
                        </div>

                        <div class="form-group col-md-3">
                            <label for="nb_piece" class="mr-sm-2">Nombre de Pièces :</label>
                            <input type="text" class="form-control" name="nb_piece" >
                        </div>

                        <div class="form-group col-md-3">
                            <label for="nb_indiv" class="mr-sm-2">Nombre d'Individus :</label>
                            <input type="text" class="form-control" name="nb_indiv">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="droit_charge" class="mr-sm-2">Droit de Charge :</label>
                            <input type="text" class="form-control" name="droit_charge">
                        </div>
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


