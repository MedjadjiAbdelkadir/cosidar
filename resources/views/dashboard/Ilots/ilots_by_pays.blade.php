@extends('layouts.admin.master')
@section('css')

@section('title')
SERVICE AFFECTATAIRE

@stop
@endsection

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">SERVICE AFFECTATAIRE</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">Dashboard</a></li>
                <li class="breadcrumb-item active">SERVICE AFFECTATAIRE
                </li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    {{-- @include('dashboard.user.create') --}}
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th>SERVICE AFFECTATAIRE</th>
                                <th>Nombre de Bien</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proprietaires as $key => $proprietaire)
                            <tr id="{{$proprietaire->id}}" class="li_proprietaires">
                                <td>{{$loop->iteration}}</td>
                                <td>{{$proprietaire->Denomination_fr}}</td>
                                <td>{{$proprietaire->ilot->count()}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $proprietaires->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $(document).on('click', '.li_proprietaires', function() {
            var proprietaireId = $(this).attr('id');
            // /proprietaire/{proprietaire_id}
            var redirectUrl = '{{ asset('dashboard/proprietaire/') }}' +"/" + proprietaireId;
            window.location.href = redirectUrl
        });
    });
</script>

@endsection
