@extends('layouts.admin.master')
@section('css')

@section('title')
List Produit
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Produits</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Dashboard</a></li>
                <li class="breadcrumb-item active">List Produits</li>
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
                <a class="btn btn-info btn-sm" href="{{ route('dashboard.articles.create') }}">
                    <i class="fa fa-plus"></i>
                    AJOUTER Produit
                </a>
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom</th>
                                <th>Prix</th>
                                <th>Quantité</th>
                                <th>Total</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $key => $article)
                            {{-- @foreach ($batimentas;$batiment) --}}
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$article->name }}</td>
                                <td>{{$article->price }}</td>
                                <td>{{$article->quantity }}</td>
                                <td>{{$article->quantity * $article->price }}</td>
                                <td>image 1</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#showArticleModal{{$article->id}}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $articles->links() }}                                            
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = $('#datatable-basic').DataTable();
        
            $('#pays_placeholder').on('change', function () {
                var selectedValue_pays = $(this).val();
                console.log(selectedValue_pays);
                table.column(5).search(selectedValue_pays).draw();
            });
        });
    </script>
   <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = $('#datatable-basic').DataTable();
            $('#nature_filter').on('change', function () {
                var selectedOption = $('#nature_filter').find(':selected');
                var selectedValue_nature = selectedOption.data('nom');
                selectedValue_nature = selectedValue_nature ? selectedValue_nature.toLowerCase() : '';
                console.log('Selected Nature Filter Value:', selectedValue_nature);
                table.column(3).search(selectedValue_nature).draw();
            });
       });
    </script>
@endsection
