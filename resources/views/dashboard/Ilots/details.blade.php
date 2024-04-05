@extends('layouts.admin.master')
@section('css')

@section('title')
IDENTIFICATION DETAILLEE

@stop
@endsection

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">IDENTIFICATION DETAILLEEs</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">Dashboard</a></li>
                <li class="breadcrumb-item active">IDENTIFICATION DETAILLEE
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
                                <th>Flags</th>
                                <th>Country</th>
                                <th>Nombre Ilots</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ilotsGroupedByPays as $pays => $nombreIlots)
                            {{-- @foreach ($batimentas;$batiment) --}}
                            @php
                            $flagUrl ="";
                            foreach($pays_flags as $pays_flag){
                                if($pays_flag['name'] == $pays){
                                    //echo($pays_flag['name']);
                                    $flagUrl =$pays_flag['flag_1x1'];
                    
                                }
                            }                               
                            @endphp
                            <tr id="{{$pays}}" class="li_pays">
                                <td>{{$loop->iteration}}</td>
                                <td>
                                    <img src="{{ asset($flagUrl) }}" alt="{{$pays}} Flag" style="width: 20px; height: 20px; margin-right: 10px;">
                                </td>
                                <td>{{$pays}}</td>
                                <td>{{$nombreIlots}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{-- {{ $ilotsGroupedByPays->links() }} --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $(document).on('click', '.li_pays', function() {
            // Alert('Hiiiii');
           
            var paysId = $(this).attr('id');
            var redirectUrl = '{{ asset('dashboard/proprietaire/pays/') }}' +"/" + paysId;
            window.location.href = redirectUrl


        });
    });
</script>

@endsection
