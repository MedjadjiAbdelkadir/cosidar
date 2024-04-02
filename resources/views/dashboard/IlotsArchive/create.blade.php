@extends('layouts.admin.master')
@section('css')

@section('title')
    LISTE DES ILOTS
@stop
@endsection

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Ajoute un ilot</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">Dashboard</a></li>
                <li class="breadcrumb-item active">Ilots</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    @include('dashboard.IlotsArchive.accept')

    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form id="addArchiveIlot" action="{{ route('dashboard.ilots-archive.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-5">
                            <label for="proprietaire_id" class="mr-sm-2">Choose un Proprietaire</label>
                            <select class="custom-select" name="proprietaire_id" id="proprietaire">
                                <option disabled value="">Select Proprietaire</option>
                                @foreach ($Proprietaires as $item)
                                    <option value="{{ $item->id }}">{{ $item->Denomination_fr }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="ilot" class="mr-sm-2">Ilot</label>
                            <select class="custom-select" id="ilot" name="ilot_id">
                                <option value="">Select Ilot</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="nature_opération" class="mr-sm-2">Nature Opération</label>
                            <select class="custom-select" id="nature_opération" name="nature_opération">
                                <option value="">Select Nature Opération</option>
                                <option value="Aquisition">Aquisition</option>
                                <option value="Echange">Echange</option>
                                <option value="Donation">Donation</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <hr class="m-0">
                    <br>
                    <h4>Ajoute Client :</h4>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="nature_juridique" class="mr-sm-2">Choose Nature Juridique</label>
                            <select class="custom-select" name="type_juridique" id="type_juridique">
                                <option disabled value="">Select Nature Juridique</option>
                                <option value="personne_moral">personne moral</option>
                                <option value="personne_physique">personne physique</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nationalité" class="mr-sm-2">Nationalité :</label>
                            <input type="text" class="form-control" name="nationalité">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nom" class="mr-sm-2">Nom :</label>
                            <input type="text" class="form-control" name="nom">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pernom" class="mr-sm-2">Pernom :</label>
                            <input type="text" class="form-control" name="pernom">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date_naissance" class="mr-sm-2">Date de naissance :</label>
                            <input type="date" class="form-control" name="date_naissance">
                        </div>
                        {{-- date de naissance --}}
                        <div class="form-group col-md-6">
                            <label for="adresse" class="mr-sm-2">Adresse :</label>
                            <input type="text" class="form-control" name="adresse">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email" class="mr-sm-2">Email :</label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone" class="mr-sm-2">Phone :</label>
                            <input type="text" class="form-control" name="phone">
                        </div>


                        {{-- nationalité --}}
                    </div>
                    <br>
                    <hr class="m-0">
                    <br>
                    <h4>Ajoute acte d'ilot :</h4>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="date_pub" class="mr-sm-2">Date de publication :</label>
                            <input type="date" class="form-control" name="date_pub">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nature_acte" class="mr-sm-2">Nature d'acte :</label>
                            <select class="custom-select" name="nature_acte">
                                <option disabled value="">Select Nature d'acte</option>
                                <option value="Loi">Loi</option>
                                <option value="Décret">Décret</option>
                                <option value="Arrêté">Arrêté</option>
                                <option value="Acte">Acte</option>
                                <option value="Convention bilatérale">Convention bilatérale</option>
                                <option value="Non renseigné">Non renseigné</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="volume1" class="mr-sm-2">Volume :</label>
                            <input type="text" class="form-control" name="volume" placeholder="enter Volume">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Construction_Acte" class="mr-sm-2">Construction d'acte :</label>
                            <select class="custom-select" name="Construction_Acte">
                                <option disabled>Select Construction d'acte</option>
                                <option
                                    value="lorsque les constructions ont été réalisées après acquisition du terrain d\'assiette">
                                    lorsque les constructions ont été réalisées après acquisition du terrain d\'assiette
                                </option>
                                <option value="lorsque les constructions ont été affectées avec le terrain">lorsque les
                                    constructions ont été affectées avec le terrain</option>
                                <option value="Non renseigné">Non renseigné</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Origine_Acte" class="mr-sm-2">Origine_Acte :</label>
                            <select class="custom-select" name="Origine_Acte">
                                <option disabled>Select Origine Acte</option>
                                <option value="Non renseigner">Non renseigner</option>
                                <option value="Don">Don</option>
                                <option value="Cession à l-Etat à titre gratuit">Cession à l-Etat à titre gratuit
                                </option>
                                <option value="Acquisition">Acquisition</option>
                                <option value="Réalisation">Réalisation</option>
                                <option value="Échange">Échange</option>
                                <option value="Bail ou convention">Bail ou convention</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="case11" class="mr-sm-2">Case :</label>
                            <input type="text" class="form-control" name="case" placeholder="enter Case11">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#AcceptArchive">
                            Ajoter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
<script>
    $(document).ready(function() {
        // addArchiveIlot
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#proprietaire').on('change', function() {
            var id = $('#proprietaire').val();

            $.ajax({

                url: '{{ route('dashboard.ilots-archive.search') }}',
                method: 'POST',
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(response) {
                    // console.log(response);
                    $('#ilot').empty();
                    $.each(response, function(key, value) {
                        // console.log("value" ,value.id);
                        $('#ilot').append('<option value="' + value.id + '">' +
                            value.Denom_Ilot + '</option>');
                    });
                }
            })
        })
        $('#accept').on('click', function() {
            $('#addArchiveIlot').submit();
        });
    });
</script>
@endsection
