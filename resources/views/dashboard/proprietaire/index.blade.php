@extends('layouts.admin.master')
@section('css')

@section('title')
SERVICE AFFECTATAIRE
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
                <li class="breadcrumb-item active">SERVICE AFFECTATAIRE</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    @include('dashboard.proprietaire.create')

    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <button type="button"class="button x-small"  data-toggle="modal" data-target="#createProprietaireModal">
                    AJOUTER SERVICE AFFECTATAIRE
                </button>
                
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
                                <th>N°SER.AFFECT </th>
                                <th>N° BIEN</th> 
                                <th>DENOMINATION</th>
                                <th>STATUT</th>
                                <th>TUTELLE</th>
                                <th>DATE CREATION</th>
                                <th>TEXTE DE CREATION</th>
                                <th>DECISION D-AFFECTATION</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proprietaires as $key => $proprietaire)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <th>{{ $proprietaire->  pe_num }}</th>
                                <th>{{ $proprietaire->Num_ilot }}</th>
                                <th>{{ $proprietaire->Denomination_fr }}</th>
                                <th>{{ $proprietaire->anx_statut_intitule }}</th>
                                <th>{{ $proprietaire->tutelle_intitule }}</th>
                                <th>{{ \Carbon\Carbon::parse($proprietaire->Date_txt_creation)->format('Y-m-d') }}</th>
                                <th>{{ $proprietaire->text_creati_intitule }}</th>
                                <th>{{ $proprietaire->deciaffect_intitule }}</th> 
                                <td>
                                    {{-- deleteProprietaireModal --}}
                                    <a class="btn btn-info btn-sm" href="{{ route('dashboard.proprietaires.show' , $proprietaire->pe_num) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editProprietaireModal{{$proprietaire->pe_num}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteProprietaireModal{{$proprietaire->pe_num}}">
                                        <i class="fa fa-trash"></i>
                                    </button> 
                                </td>
                            </tr>
                            @include('dashboard.proprietaire.edit')

                            {{-- @include('dashboard.proprietaire.delete') --}}
                            @endforeach

                        </tbody>
                    </table>
                    {{ $proprietaires->links() }}                                            
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
