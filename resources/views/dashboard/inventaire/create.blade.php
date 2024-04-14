@extends('layouts.admin.master')
@section('css')

@section('title')
    Ajouter Inventaire
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
                <li class="breadcrumb-item active">Ajouter Inventaire</li>
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
            <form autocomplete="off" action="{{ route('dashboard.inventaires.store') }}" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                    @csrf
                    <div class="row">

                        <div class="form-group col-md-2">
                            <label for="Statut" class="mr-sm-2">Pays</label>
                            <select class="custom-select" id="paye_name" name="paye_name">
                                @foreach ($pays as $pay)
                                    <option value="{{ $pay->name }}">
                                        <img src="{{ url($pay->flag_1x1) }}" width="80" /> - {{ $pay->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="proprietaire_id" class="mr-sm-2">Choose un Proprietaire</label>
                            <select class="custom-select" name="Denomination_fr" id="proprietaire">
                                <option value="">Select Proprietaire</option>
                            </select>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="ilot" class="mr-sm-2">Ilot</label>
                            <select class="custom-select" id="Denom_Ilot" name="Denom_Ilot">
                                <option value="">Select Denom Ilot</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="N_ilot" class="mr-sm-2">Numéro d\'îlot' :</label>
                            <input type="text" class="form-control" disabled name="N_ilot" id="N_ilot">

                        </div>
                        <div class="form-group col-md-2">
                            <label for="number" class="mr-sm-2">Number :</label>
                            <input type="text" class="form-control" name="number" id="number">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date_inv" class="mr-sm-2">Date Inv</label>
                            <input type="date" class="form-control" name="date_inv" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="designation" class="mr-sm-2">Designation :</label>
                            <input id="designation" type="text" name="designation" class="form-control"
                                placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="observation" class="mr-sm-2">Observation :</label>
                            <input type="text" class="form-control" name="observation">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="photos" class="mr-sm-2">photos :</label>
                            <input type="file" class="form-control" name="photos">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="vedio" class="mr-sm-2">Vedio :</label>
                            <input type="file" class="form-control" name="vedio">
                        </div>

                        {{-- 
                        
                    'statut_inventaire', 
                    'TypeInventaire'     
                    --}}

                        {{-- 
                        
                    ,,,   
                    --}}
                        <div class="form-group col-md-6">
                            <label for="responsable_inventaire" class="mr-sm-2">Responsable :</label>
                            <input type="text" class="form-control" name="responsable_inventaire">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="statut_inventaire" class="mr-sm-2">Sélectionnez Statut Inventaire :</label>
                            <select class="custom-select" name="statut_inventaire">
                                <option disabled>Select Statut Inventaire</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="TypeInventaire" class="mr-sm-2">Sélectionnez Type Inventaire :</label>
                            <select class="custom-select" name="TypeInventaire">
                                <option disabled>Select Type Inventaire</option>
                                <option value="Annuele">inventaire annuele</option>
                                <option value="Périodique">inventaire périodique</option>
                                <option value="Tourant">inventaire tourant</option>
                                <option value="Permanant">inventaire permanant</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary text-white">Return Dashboard</a>
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>
    // dashboard.proprietaires.getProprietaireByPays
</script>



<script>
    $(document).ready(function() {
        // addArchiveIlot
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#paye_name').on('change', function() {
            var paye_name = $('#paye_name').val();
            $.ajax({

                url: '{{ route('dashboard.getProprietaireByPays') }}',
                method: 'POST',
                dataType: 'json',
                data: {
                    paye_name: paye_name
                },
                success: function(response) {
                    $('#proprietaire').empty();
                    $.each(response, function(key, value) {
                        $('#proprietaire').append('<option value="' + value
                            .Denomination_fr + '">' +
                            value.Denomination_fr + '</option>');
                    });
                }
            })
        })

        $('#proprietaire').on('change', function() {
            var Denomination_fr = $('#proprietaire').val();

            $.ajax({

                url: '{{ route('dashboard.ilots.getIlotByProprietaire') }}',
                method: 'get',
                dataType: 'json',
                data: {
                    Denomination_fr: Denomination_fr
                },
                success: function(response) {
                    // console.log(`response`,response );
                    $('#N_ilot').val(response[1]['Num_ilot']);
                    $('#Denom_Ilot').empty();
                    $.each(response, function(key, value) {
                        $('#Denom_Ilot').append('<option value="' + value
                            .Denom_Ilot + '">' +
                            value.Denom_Ilot + '</option>');
                    });
                }
            })
        })

        $('#Denom_Ilot').on('change', function() {
            var Denom_Ilot = $('#Denom_Ilot').val();

            $.ajax({

                url: '{{ route('dashboard.ilots.getNuméroIlotByDenom_Ilot') }}',
                method: 'get',
                dataType: 'json',
                data: {
                    Denom_Ilot: Denom_Ilot
                },
                success: function(response) {
                    console.log(response);
                    $('#N_ilot').val('');
                    $('#N_ilot').val(response.ilot.Num_ilot);

                }
            })
            // 
        })
    });
</script>
@endsection
