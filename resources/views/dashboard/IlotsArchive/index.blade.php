@extends('layouts.admin.master')
@section('css')

@section('title')
    Mutation Globale
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
                <li class="breadcrumb-item active">Mutation Globale</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    {{-- @include('dashboard.acte.create') --}}

    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-header">
                <a href="{{ route('dashboard.ilots-archive.create') }}" class="button x-small" >
                    Créer Ilots Archive
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th>N° BIEN</th>
                                <th>DEnOMINATION</th>
                                <th>NATURL</th>
                                <th>UTILISATION</th>
                                <th>LOCALITE</th>
                                @if (Auth::user()->role == 'admin_direction')
                                    <th>VALIDATION</th>
                                @endif
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ilots as $key => $ilot)
                            {{-- @foreach ($batimentas;$batiment) --}}
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $ilot->Num_ilot }}</td>
                                <td>{{ $ilot->Denom_Ilot }}</td>
                                <td>{{ $ilot->nature_nom }}</td>
                                <td>{{ $ilot->Utlisation }}</td>
                                <td>{{ $ilot->Localite }}</td>
                                @if(auth()->user()->role == 'admin_direction' || auth()->user()->role == 'admin_sous_direction')
                                    <th>
                                        <select class="custom-select validation-dropdown" data-id="{{ $ilot->Num_ilot }}">
                                            <option  value="0" @if ($ilot->validation == 0) selected @endif>En attente</option>
                                            <option value="1" @if ($ilot->validation == 1) selected @endif>Validé</option>
                                        </select>
                                    </th>
                                @endif
                                <td>
                                    @if (auth()->user()->role == 'admin_direction' || auth()->user()->role == 'admin_sous_direction')
                                        <a class="btn btn-info btn-sm" href="{{ route('dashboard.ilots.show' , $ilot->Num_ilot) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-secondary addNote" data-toggle="modal" data-target="#noteBienModal{{ $ilot->id }}" data-id="{{$ilot->id}}">
                                            <i class="fa fa-sticky-note"></i>
                                        </button>
                                    @else
                                        <a class="btn btn-info btn-sm" href="{{ route('dashboard.ilots.show' , $ilot->Num_ilot) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger delete_batiment" data-toggle="modal" data-target="#deleteBienModal{{ $ilot->Num_ilot }}" data-id="{{$ilot->Num_ilot}}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <a href="{{ route('dashboard.ilots.edit', $ilot->id) }}" class="btn btn-success btn-sm Num_batiment"
                                            title="Edit"> <i class="fa fa-edit"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            {{-- @include('dashboard.Ilots.deleted')
                            @include('dashboard.Ilots.notes') --}}
                            {{-- @include('dashboard.Ilots.show') --}}
                            @endforeach

                        </tbody>
                    </table>
                    {{ $ilots->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
