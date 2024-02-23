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
                <form action="{{ route('dashboard.proprietaires.store') }}" method="POST">
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="Statut" class="mr-sm-2">Pays</label>
                                <select class="custom-select" id="pays" name="paye_name">
                                    @foreach ( $pays as $pay)
                                        <option value="{{ $pay->name }}">
                                                <img src="{{ url($pay->flag_1x1) }}" width="80" /> - {{ $pay->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="mr-sm-2">La Zone :</label>
                                <input type="text" class="form-control" id="zone" name="paye_region" placeholder="la zone">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="mr-sm-2">Code cc :</label>
                                <input type="text" class="form-control" id="code_cc" name="paye_code" placeholder="code cc">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Statut" class="mr-sm-2">Nom en clature</label>
                                <select class="custom-select" id="name_clature" name="NOMENCLATURE">
                                    @foreach ($nomenclatures as $item)
                                        <option id="{{ $item->id }}" value="{{ $item->nomenclature }}">
                                                {{ $item->nomenclature }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Statut" class="mr-sm-2">Postes</label>
                                <select class="custom-select" id="municipal" name="Denomination_fr">
                                    <option value="" >Ajouter un Postes</option>
                                </select>
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label for="Denomination_fr" class="mr-sm-2">Code II :</label>
                                <input type="text" class="form-control" id="code_ii" name="CODE_II" placeholder="Code II">
                            </div> --}}
                            <div class="form-group col-md-6">
                                <label for="Statut" class="mr-sm-2">Statut :</label>
                                <select class="custom-select" name="Statut">
                                    <option disabled >Select Status</option>
                                    @foreach ( $anx_statut as $anx_statut)
                                        <option class="" value="{{ $anx_statut }}">{{ $anx_statut }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Tutelle" class="mr-sm-2">Tutelle :</label>
                                <select class="custom-select" name="Tutelle">
                                    <option disabled >Select Tutelle</option>
                                    @foreach ( $anx_tutelle as $anx_tutelle)
                                        <option value="{{ $anx_tutelle }}">{{ $anx_tutelle }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="txt_creation" class="mr-sm-2">Texte de création :</label>
                                <select class="custom-select" name="txt_creation">
                                    <option disabled >Select Texte de création</option>
                                    @foreach ( $anx_text_creati as $anx_text_creati)
                                        <option value="{{ $anx_text_creati }}">{{ $anx_text_creati }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Decision_affectation" class="mr-sm-2">Décision d'affectation :</label>
                                <select class="custom-select" name="Decision_affectation">
                                    <option disabled >Select Décision d'affectation</option>
                                    @foreach ( $deciaffect as $deciaffect)
                                        <option value="{{ $deciaffect }}">{{ $deciaffect }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="Date_Decision_affectation" class="mr-sm-2">Date de décision d'affectation :</label>
                                <input type="date" class="form-control" name="Date_Decision_affectation">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="Date_txt_creation" class="mr-sm-2">Date de création :</label>
                                <input type="date" class="form-control" name="Date_txt_creation">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Denomination_fr" class="mr-sm-2">Ref_JRN :</label>
                                <input type="text" class="form-control" name="Ref_JRN" placeholder="Ref_JRN">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary text-white" >Return Dashboard</a>
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
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
        $('#pays').change(function() {
            var paysName = $(this).val();
                console.log(pays);
                $.ajax({
                    url: '{{ route('dashboard.proprietaires.pays.search') }}',
                    method: 'POST',
                    dataType: 'json',
                    data: {paysName: paysName},
                    success: function(response) {
                        document.getElementById('zone').value = response.continent
                        document.getElementById('code_cc').value = response.code
                        console.log(response);

                    }
                });

        });
        $('#name_clature').change(function() {
            var id = $(this).find(':selected')[0].id;
            console.log(id);
                $.ajax({
                    url: '{{ route('dashboard.proprietaires.postes.search') }}',
                    method: 'POST',
                    dataType: 'json',
                    data: {id: id},
                    success: function(response) {
                        $('#municipal').empty();
                            $.each(response, function(key, value) {
                                $('#municipal').append('<option value="' + value.postes + '">' + value.postes + '</option>');
                            });
                            // document.getElementById('zone').value = response.continent
                            // document.getElementById('code_cc').value = response.code
                            // console.log(response);

                    }
                });

        });
    });
</script>
@endsection
