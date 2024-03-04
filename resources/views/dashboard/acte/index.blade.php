@extends('layouts.admin.master')
@section('css')

@section('title')
Réference Actes
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
                <li class="breadcrumb-item active">Réference Actes</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    @include('dashboard.acte.create')

    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if (auth()->user()->role == 'user_direction' || auth()->user()->role == 'user_sous_direction' || auth()->user()->role == 'user_consultation_direction')
                    <button type="button"class="button x-small"  data-toggle="modal" data-target="#createActeModal">
                        Ajouter ORIGINE DES DROITS
                    </button>
                @endif
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>N°ACTE</th>
                                <th>N° BIEN</th>
                                <th>NATURE ACTE</th>
                                <th>CONSTRUCTION ACTE</th>
                                <th>ORIGINE ACTE</th>
                                <th>DATE PUBLICATION</th>
                                <th>VOLUME</th>
                                <th>CASE</th>
                                <th>Ref_JRN</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($actes as $key => $acte)
                            {{-- @foreach ($batimentas;$batiment) --}}
                            <tr>

                                <td>{{$loop->iteration}}</td>
                                <td>{{ $acte->id }}</td>
                                <td>{{ $acte->Num_ilot }}</td>
                                <td>{{ $acte->nature_acte }}</td>
                                <td>{{ $acte->Construction_Acte }}</td>
                                <td>{{ $acte->Origine_Acte }}</td>
                                <td>{{ \Carbon\Carbon::parse($acte->date_pub)->format('Y-m-d') }}</td>
                                <td>{{ $acte->volume1 }}</td>
                                <td>{{ $acte->case11 }}</td>
                                <td>{{ $acte->Ref_JRN }}</td>
                                <td>
                                    @if (auth()->user()->role == 'user_direction' || auth()->user()->role == 'user_sous_direction' || auth()->user()->role == 'user_consultation_direction')
                                    <a class="btn btn-info btn-sm" href="{{ route('dashboard.actes.show' , $acte->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#editActeModal{{$acte->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button"  class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteActeModal{{$acte->id}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                    @else
                                    <a class="btn btn-info btn-sm" href="{{ route('dashboard.actes.show' , $acte->id) }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    @endif

                                </td>
                            </tr>
                            @include('dashboard.acte.edit')
                            {{-- @include('dashboard.acte.show') --}}
                            @include('dashboard.acte.delete')
                            @endforeach

                        </tbody>
                    </table>
                    {{ $actes->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
