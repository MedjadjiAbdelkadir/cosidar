@extends('layouts.admin.master')
@section('css')

@section('title')
Batiments
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
                <li class="breadcrumb-item active">Batiments</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    {{-- @include('dashboard.user.create') --}}

    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <button type="button"class="button x-small"  data-toggle="modal" data-target="#createUserModal">
                    Create
                </button>
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>N°BATIMENT</th>
                                <th>N° BIEN</th>
                                <th>NBR NIVEAU</th>
                                <th>SUPERFICIE CONSTRUITE</th>
                                <th>NOM BATIMENT</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($batiments as $key => $batiment)
                            {{-- @foreach ($batimentas;$batiment) --}}
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $batiment->Num_Bat }}</td>
                                <td>{{ ucfirst($batiment->bat_no) }}</td>
                                <td>{{ $batiment->Nbr_Niveau }}</td>
                                <td>{{ $batiment->sup_bati_cons }}</td>
                                <td>{{ $batiment->nom_bat }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-neutral Num_batiment" data-toggle="modal" data-target="#batimentModal" data-id="{{$batiment->Num_Bat}}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger delete_batiment" data-toggle="modal" data-target="#batimentModal" data-id="{{$batiment->Num_Bat}}">
                                        <i class="fa fa-trash"></i>
                                    </button> 

                                    <button type="button" class="btn btn-success btn-sm Num_batiment" data-toggle="modal"
                                        data-target="#editBatimentModal"  data-id="{{$batiment->Num_Bat}}" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </button>



                                    {{-- <button type="button" class="btn btn-sm btn-success edit_batiment" data-toggle="modal" data-target="#batimentModal" data-id="{{$batiment->Num_Bat}}">
                                        <i class="fa fa-pencil-alt"></i>
                                    </button>  --}}
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $batiments->links() }}                                            
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
