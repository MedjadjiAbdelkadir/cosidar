@extends('layouts.admin.master')
@section('css')

@section('title')
Evaluation des Biens
@stop
@endsection

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Evaluation des Biens</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Dashboard</a></li>
                <li class="breadcrumb-item active">Evaluation des Biens</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics">
                <div class="card-body">
                    <form action="" id="FilterPaysForm" method="GET">
                        @csrf
                        <div class="row" >
                            <div class="form-group col-md-6">
                                <label class="mr-sm-2">Sélectionnez un pays</label>
                                <select name="paysName" id="paysName"  class="custom-select" required>
                                    @if (Request::get('paysName'))
                                        <option  selected>{{ Request::get('received') == '' ? Request::get('paysName') : '' }}</option>
                                    @else
                                        <option value="" selected>Select Pays</option>
                                    @endif
                                    @foreach ($pays as $pay)
                                        <option value="{{ $pay->name }}"><img src='{{ asset($pay->flag_1x1) }}' class="flag-icon"> -  {{ $pay->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
        <hr>
        <div class="card card-statistics ">
            <div class="card-body">
                <div class="table-responsive">
                    <form action="{{ route('dashboard.evaluations.biens.consider') }}" method="GET">
                        @csrf
                        <input type="text"hidden name="paye" value="{{ Request::get('paysName') }}">
                        @if (!is_null(Request::get('paysName')))
                            <div class="form-group col-md-6 mt-1">
                                <button type="submit" class="btn btn-primary text-white mt-4">Imprimer</button>
                            </div>
                        @endif
                    </form>
                    <table id="datatable-basic" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>Dénomination des biens</th>
                                <th>Superficie de Bien</th>
                                <th>Evaluation vénal </th>
                                <th>Evaluation locative</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ilots as $ilot )
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $ilot->Denomination_fr }}</td>
                                <td>{{ $ilot->il_surf_cadastree }}</td>
                                <td>{{ $ilot->mantVV }}</td>
                                <td>{{ $ilot->mantVL }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="{{ route('dashboard.evaluations.show', $ilot->id) }}" >
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $ilots->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        // ajax setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#paysName').change(function(){
            $("#paysName").focus();
            timer = setTimeout(function() {
                submitForm();
            }, 100);
            function submitForm() {
                $("#FilterPaysForm").submit();
            }
        });
    });


</script>
@endsection
