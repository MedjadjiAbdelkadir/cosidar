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
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if (auth()->user()->role == 'user_direction' || auth()->user()->role == 'user_sous_direction' || auth()->user()->role == 'user_consultation_direction')
                    <a class="btn btn-info btn-sm" href="{{ route('dashboard.proprietaires.create') }}">
                        <i class="fa fa-plus"></i>
                        AJOUTER SERVICE AFFECTATAIRE
                    </a>
                @endif
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
                                <td>{{ $proprietaire-> pe_num }}</td>
                                <td>{{ $proprietaire->Denomination_fr }}</td>
                                <td>{{ $proprietaire->statut?->Intitule }}</td>
                                <td>{{ $proprietaire->tutelle?->Intitule }}</td>
                                {{-- <td>{{ $proprietaire->txt_creation }}</td> --}}
                                <td>{{ $proprietaire->anx_text_creati?->Intitule }}</td>
                                <td>{{ \Carbon\Carbon::parse($proprietaire->Date_txt_creation)->format('Y-m-d') }}</td>
                                <td>{{ $proprietaire->anx_text_creati?->Intitule }}</td>
                                <td>{{ $proprietaire->deciaffect?->Intitule_fr }}</td>
                                <td>
                                    @if (auth()->user()->role == 'user_direction' || auth()->user()->role == 'user_sous_direction' || auth()->user()->role == 'user_consultation_direction')
                                        <a class="btn btn-info btn-sm" href="{{ route('dashboard.proprietaires.show' , $proprietaire->pe_num) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editProprietaireModal{{$proprietaire->pe_num}}">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteProprietaireModal{{$proprietaire->pe_num}}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    @else
                                        <a class="btn btn-info btn-sm" href="{{ route('dashboard.proprietaires.show' , $proprietaire->pe_num) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    @endif

                                </td>
                            </tr>
                            @include('dashboard.proprietaire.edit')

                            @include('dashboard.proprietaire.delete')
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
