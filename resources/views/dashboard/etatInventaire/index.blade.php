@extends('layouts.admin.master')
@section('css')

@section('title')
Etat Inventaire
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Etat Inventaire</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Dashboard</a></li>
                <li class="breadcrumb-item active">Etat Inventaire</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    {{-- @include('dashboard.proprietaire.create') --}}

    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                {{-- <button type="button"class="btn btn-sm"  data-toggle="modal" data-target="#createProprietaireModal">
                    <i class="fa fa-plus"></i>
                    AJOUTER SERVICE AFFECTATAIRE
                </button> --}}
                {{-- <a class="btn btn-info btn-sm" href="{{ route('dashboard.proprietaires.create') }}">
                    <i class="fa fa-plus"></i>
                    AJOUTER SERVICE AFFECTATAIRE
                </a> --}}
                {{-- <a class="btn btn-info btn-sm" href="{{ route('dashboard.proprietaires.create') }}">
                    <i class="fa fa-plus"></i>
                    AJOUTER SERVICE AFFECTATAIRE
                </a> --}}
                
                {{-- <h3 class="mb-0">
                    @if(Auth::user()->parent_id == 0) 
                        SERVICE AFFECTATAIRE
                    @else 
                        SERVICE AFFECTATAIRE
                    @endif
                </h3> --}}
                
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center"  role="grid">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Designation</th>
                                <th>Date</th>
                                <th>Observation</th>
                                <td>Nom Prod</td>
                                <td>Price Prod</td>
                                <td>Quantity Prod</td>
                                <td>Total </td>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $key => $article)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $article->inventaire->designation }}</td>
                                <td>{{ $article->inventaire->date_inv }}</td>
                                <td>{{ $article->inventaire->observation }}</td>
                                <td>{{ $article->name }}</td>
                                <td>{{ $article->price }}</td>
                                <td>{{ $article->quantity }}</td>
                                <td>{{ $article->price * $article->quantity }}</td>
                                <td>##</td>
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

@endsection
