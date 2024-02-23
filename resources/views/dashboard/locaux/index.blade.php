@extends('layouts.admin.master')
@section('css')

@section('title')
Locaux
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
                <li class="breadcrumb-item active">Locaux</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    {{-- @include('dashboard.locaux.create') --}}

    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <button type="button"class="button x-small"  data-toggle="modal" data-target="#createLocauxModal">
                    Ajouter Local
                </button>
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>N°LOCAUX</th>
                                <th>N°BIEN</th>
                                <th>N°BATIMENT</th>
                                <th>SURFACE LOCAUX</th>
                                <th>NBR LOCAUX</th>
                                <th>NATURE LOCAUX</th>
                                <th>NBR PIECE</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($locaux as $key => $local)
                            {{-- @foreach ($batimentas;$batiment) --}}
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $local->lot_no }}</td>
                                <td>{{ ucfirst($local->Num_ilot) }}</td>
                                <td>{{ $local->Num_Bat }}</td>
                                <td>{{ $local->lot_surface }}</td>
                                <td>{{ $local->nb_indiv }}</td>
                                <td>{{ $local->nature_loc }}</td>
                                <td>{{ $local->nb_piece }}</td>

                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('dashboard.locaux.show' , $local->lot_no) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editLocauxModal{{$local->lot_no}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteLocauxModal{{$local->lot_no}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @include('dashboard.locaux.edit')
                            @include('dashboard.locaux.delete')
                            @endforeach

                        </tbody>
                    </table>
                    {{ $locaux->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
