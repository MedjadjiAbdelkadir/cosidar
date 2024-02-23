@extends('layouts.admin.master')
@section('css')

@section('title')
Ajouter Inventaire
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
                <li class="breadcrumb-item active">Ajouter Inventaire</li>
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
            <form action="{{ route('dashboard.inventaires.store') }}" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="N_ilot" class="mr-sm-2">Sélectionnez un Numéro d\'îlot' :</label>
                        <select class="custom-select" name="N_ilot">
                            <option disabled>Select Numéro dîlot</option>
                            @foreach ( $ilotOptions as $ilot)
                                <option value="{{ $ilot->Num_ilot }}">{{ $ilot->N_ilot }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="date_inv" class="mr-sm-2">Date Inv</label>
                        <input type="date" class="form-control" name="date_inv" placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="designation" class="mr-sm-2">Designation :</label>
                        <input id="designation" type="text" name="designation" class="form-control" placeholder="">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="observation" class="mr-sm-2">Observation :</label>
                        <input type="text" class="form-control" name="observation">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="photos" class="mr-sm-2">photos :</label>
                        <input type="file" class="form-control" name="photos">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="vedio" class="mr-sm-2">Vedio :</label>
                        <input type="file" class="form-control" name="vedio">
                    </div>
                </div>

                    <div class="modal-footer">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary text-white" >Return Dashboard</a>
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>

</script>
@endsection



