@extends('layouts.admin.master')
@section('css')

@section('title')
    Ajouter Produit
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Ajouter Produit</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Dashboard</a></li>
                <li class="breadcrumb-item active">Ajouter Produit</li>
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
            <form autocomplete="off" action="{{ route('dashboard.articles.store') }}"method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="row">
                        @if (!empty($inventaire))
                            <div class="form-group col-md-6">
                                <label for="inventaire_id" class="mr-sm-2">Choose un Inventaire</label>
                                <input type="text" name="inventaire_id" value="{{ $inventaire->id }}">
                            </div>
                        @else
                            <div class="form-group col-md-6">
                                <label for="inventaire_id" class="mr-sm-2">Choose un Inventaire</label>
                                <select class="custom-select" name="inventaire_id">
                                    <option selected value="">Select Inventaire</option>
                                    @foreach ($inventaires as $item)
                                        <option value="{{ $item->id }}">{{ $item->designation }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group col-md-6">
                            <label for="name" class="mr-sm-2">Nom du Produit:</label>
                            <input id="name" type="text" name="name" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="price" class="mr-sm-2">Prix du Produit :</label>
                            <input id="price" type="number" name="price" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="quantity" class="mr-sm-2">Quantité du Produit :</label>
                            <input id="quantity" type="number" name="quantity" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="total" class="mr-sm-2">Total Prix :</label>
                            <input id="total" type="text" disabled name="total" class="form-control"
                                placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="descrption" class="mr-sm-2">Descrption du Produit:</label>
                            <input id="descrption" type="text" name="descrption" class="form-control" placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="garantie" class="mr-sm-2">Garantie du Produit:</label>
                            <input id="garantie" type="text" name="garantie" class="form-control" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="garanDateJusq" class="mr-sm-2">GaranDateJusq du Produit:</label>
                            <input id="garanDateJusq" type="date" name="garanDateJusq" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dateAchat" class="mr-sm-2">Date Achat du Produit:</label>
                            <input id="dateAchat" type="date" name="dateAchat" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="marque" class="mr-sm-2">Marque du Produit:</label>
                            <input id="marque" type="text" name="marque" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="style" class="mr-sm-2">Style du Produit:</label>
                            <input id="style" type="text" name="style" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="serieNum" class="mr-sm-2">SerieNum du Produit:</label>
                            <input id="serieNum" type="text" name="serieNum" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="EtaAticle" class="mr-sm-2">EtaAticle du Produit:</label>
                            <select class="custom-select" name="EtaAticle">
                                <option selected value="">Select EtaAticle</option>
                                <option value="nouveau">Nouveau</option>
                                <option value="busté">Busté</option>
                                <option value="moyen">Moyen</option>
                                <option value="inconsomable">Inconsomable</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="remarque" class="mr-sm-2">Remarque du Produit:</label>
                            <input id="remarque" type="text" name="remarque" class="form-control"
                                placeholder="">
                        </div>
                        <div class="form-group col-md-2">
                            <label for="typeProduit" class="mr-sm-2">Type du Produit:</label>
                            <select class="custom-select" name="typeProduit">
                                <option selected value="">Select Type</option>
                                <option value="consomable">Consomable</option>
                                <option value="durable">Durable</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="founisseur" class="mr-sm-2">Nom du founisseur:</label>
                            <select class="custom-select" name="founisseur_id">
                                <option selected value="">Select founisseur</option>
                                @foreach ($fournisseurs as $item => $fournisseur)
                                    <option value="{{ $fournisseur->id }}">{{ $fournisseur->nom }} {{ $fournisseur->prenom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="image" class="mr-sm-2">Files du Produit :</label>
                            <input id="image" type="file" name="image" class="form-control" placeholder="">
                        </div>

                        {{-- 'descrption',
                    'garantie',
                    'garanDateJusq',
                    'dateAchat',
                    'marque',
                    'style',
                    'serieNum',
                    'EtaAticle',
                    'remarque',
                    'typeProduit',
                    'founisseur', --}}
                    </div>

                    <div class="modal-footer">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary text-white">Return Dashboard</a>
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
    $(document).ready(function() {
        $('#quantity, #price').on('input', function() {
            var quantity = parseFloat($('#quantity').val());
            var price = parseFloat($('#price').val());
            $('#total').val(0);

            if (quantity && price) {
                $('#total').val(quantity * price);
            } else {
                $('#total').val(0);
            }
        });
    });
</script>
@endsection
