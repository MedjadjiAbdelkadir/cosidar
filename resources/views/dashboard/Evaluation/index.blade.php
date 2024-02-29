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
                    <form action="{{ route('dashboard.evaluations.index') }}" method="GET">
                        @csrf
                        <div class="row" >
                            <div class="form-group col-md-6">
                                <label class="mr-sm-2">Sélectionnez un pays</label>
                                <select name="paysName" id="pays"  class="custom-select" required>
                                    @foreach ($pays as $pay)
                                        <option value="{{ $pay->name }}"><img src="{{ asset($pay->flag_1x1) }}" class="flag-icon" alt="{{ $pay->flag_1x1 }}"> -  {{ $pay->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6 mt-1">
                                <button type="submit" class="btn btn-primary text-white mt-4">Filter</button>
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
                    <table id="datatable-basic" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>Dénomination des biens</th>
                                <th>Superficie de Bien</th>
                                <th>Evaluation vénal </th>
                                <th>Evaluation locative</th>
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
        // $('#pays').change(function() {
        //     var paysName = $(this).val();
        //         console.log(paysName);
        //         $.ajax({
        //             url: '{{ route('dashboard.evaluations.index') }}',
        //             method: 'GET',
        //             dataType: 'json',
        //             data: {paysName: paysName},
        //             success: function(response) {
        //                 console.log(response);
        //             }
        //         });
        // });
    });


</script>
@endsection
