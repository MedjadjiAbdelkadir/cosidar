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
            <form action="{{ route('dashboard.articles.store') }}" method="POST" enctype="multipart/form-data">
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
                                <option disabled value="">Select Inventaire</option>
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
                        <input id="total" type="text" disabled name="total" class="form-control" placeholder="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="image" class="mr-sm-2">Files du Produit :</label>
                        <input id="image" type="file" name="image" class="form-control" placeholder="">
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
    $(document).ready(function () {
        $('#quantity, #price').on('input', function() {
            var quantity = parseFloat($('#quantity').val());
            var price = parseFloat($('#price').val());
            $('#total').val(0);

            if(quantity && price){
                $('#total').val(quantity * price);
            }else{
                $('#total').val(0);
            }
        });
    });
</script>
@endsection



