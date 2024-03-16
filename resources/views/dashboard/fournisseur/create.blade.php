@extends('layouts.admin.master')
@section('css')

@section('title')
Ajouter Fournisseur
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Ajouter Fournisseur</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Dashboard</a></li>
                <li class="breadcrumb-item active">Ajouter Fournisseur</li>
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
            <form action="{{ route('dashboard.fournisseurs.store') }}" method="POST" enctype="multipart/form-data">
            <div class="card-body">
                @csrf
                <div class="row">            
                    <div class="form-group col-md-4">
                        <label for="inventaire_id" class="mr-sm-2">Choose un Inventaire</label>
                        <select class="custom-select" name="inventaire_id">
                            <option disabled value="">Select Inventaire</option>
                            @foreach ($inventaires as $inventaire)
                                <option value="{{ $inventaire->id }}">{{ $inventaire->designation }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="nom" class="mr-sm-2">Nom :</label>
                        <input id="nom" type="text" name="nom" class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="prenom" class="mr-sm-2">Prenom :</label>
                        <input id="prenom" type="text" name="prenom" class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="address" class="mr-sm-2">Address :</label>
                        <input id="address" type="text" name="address" class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="numero_telephone" class="mr-sm-2">Numero Telephone :</label>
                        <input id="numero_telephone" type="text" name="numero_telephone" class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="email" class="mr-sm-2">Email :</label>
                        <input id="email" type="text" name="email" class="form-control" placeholder="">
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



