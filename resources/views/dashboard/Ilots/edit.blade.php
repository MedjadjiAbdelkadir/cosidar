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
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <form action="{{ route('dashboard.ilots.update', $ilot->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    {{-- Start create Ilot --}}
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="proprietaire_id" class="mr-sm-2">choose un Proprietaire</label>
                            <input type="text" hidden name="proprietaire_id" value="{{ $ilot->proprietaire->id }}">
                            <input type="text" class="form-control" disabled value="{{ $ilot->proprietaire->Denomination_fr }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Numéro d'ilot</label>
                            <input type="text"  name="N_ilot" class="form-control" value="{{ $ilot->N_ilot }}" required placeholder="Enter Numéro d'ilot">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Âge</label>
                            <input type="text" class="form-control" value="{{ $ilot->Age }}" name="Age" placeholder="Enter Âge">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Denomination de l'ilot</label>
                            <input type="text" class="form-control" value="{{ $ilot->Denom_Ilot }}" name="Denom_Ilot" required placeholder="Enter Denomination de l'ilot">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Intitulé d'entretien</label>
                            <select  name="intit_Entretien"  required class="custom-select ">
                                <option value="{{ $ilot->intit_Entretien }}" selected>{{ $ilot->intit_Entretien }}-</option>
                                <option value="1">1-BON ETAT</option>
                                <option value="2">2-ASSEZ BON ETAT</option>
                                <option value="3">3-VETUSTE</option>
                                <option value="4">4-NON RENSEIGNIE</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Nature</label>
                            <select class="custom-select" value="{{ $ilot->Nature }}" name="Nature" id="" required>
                                <option value="{{ $ilot->Nature }}" selected>{{ $ilot->Nature }}-</option>
                                <option value="0">0-NON RENSEIGNIE</option>
                                <option value="1">1-IMMEUBLE ADMINISTRATIFS</option>
                                <option value="2">2-IMMEUBLE D-HABITATION</option>
                                <option value="3">3-IMMEUBLE A USAGE SOCIAL OU CULTURELS</option>
                                <option value="12">12-LOCAUX COMMERCIAUX</option>
                                <option value="14">14-LOCAUX DE SENTE</option>
                                <option value="16">16-LOCAUX INDISTRIELS</option>
                                <option value="17">17-LOCAUX MIXTES (ADMINISTRATIFS COMMERCIAUX ETS  )</option>
                                <option value="18">18-LOCAUX PROFESSIONNELS</option>
                                <option value="22">22-AUTRE</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Type d'enquête</label>
                            <input type="text" name="type_enquete" class="form-control" value="{{ $ilot->type_enquete }}" placeholder="Enter Type d'enquête ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Utilisation</label>
                            <input type="text" name="Utlisation" class="form-control" value="{{ $ilot->Utlisation }}" placeholder="Enter Utilisation ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Observation de l'enquêteur</label>
                            <input type="text" name="Observation_enqueteur" class="form-control" value="{{ $ilot->Observation_enqueteur }}" placeholder="Enter Observation de l'enquêteur">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Rue_fr</label>
                            <select name="Rue_fr"  class="custom-select" required>
                                <option value="{{ $ilot->Rue_fr }}" selected>{{ $ilot->Rue_fr }}</option>
                                <option value="LIEU-DIT">LIEU-DIT</option>
                                <option value="ZONE">ZONE</option>
                                <option value="ROUTE">ROUTE</option>
                                <option value="CHEMIN">CHEMIN</option>
                                <option value="QUARTIER">QUARTIER</option>
                                <option value="CITE">CITE</option>
                                <option value="PLACE">PLACE</option>
                                <option value="AVENUE">AVENUE</option>
                                <option value="BOULEVARD">BOULEVARD</option>
                                <option value="RUE">RUE</option>
                                <option value="IMPASSE">IMPASSE</option>
                                <option value="ALLEE">ALLEE</option>
                                <option value="NON RENSEIGNIE">NON RENSEIGNIE</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Date de l'enquête</label>
                            <input type="date" name="date_Enquete" class="form-control" value="{{ $ilot->date_Enquete }}" placeholder="Enter  ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Localite</label>
                            <input type="text" name="Localite" id="localite-input" autocomplete="off" class="form-control" value="{{ $ilot->Localite }}" placeholder="Enter Localite">
                            <ul id="suggestions-list"></ul>
                            <input hidden type="text" value="{{ $ilot->cord_X }}" name="cord_X">
                            <input hidden type="text" value="{{ $ilot->cord_y }}" name="cord_y">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Numéro téléphone de l'enquêteur</label>
                            <input type="text" name="Num_enqui" class="form-control" value="{{ $ilot->Num_enqui }}" placeholder="Enter Numéro téléphone de l'enquêteur ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Ville</label>
                            <input type="text" name="Ville" class="form-control" value="{{ $ilot->Ville }}" placeholder="Enter Ville ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Evaluation vénale</label>
                            <select name="Int_VV" class="custom-select" required>
                                <option value="{{ $ilot->Int_VV }}" selected>{{ $ilot->Int_VV }}-</option>
                                <option value="1">1-CELLE INDIQUEE DANS L’ACTE D’AFFECTATION</option>
                                <option value="2">2-CELLE QUI RESULTE DU COUT DE REALISATION</option>
                                <option value="3">3-CELLE INDIQUEE DANS L-ACTE TRANSLATIF DE PROPRIETE LORSQU-IL S’AGIT D-UN IMMEUBLE ACQUIS</option>
                                <option value="4">4-LE CAS ECHEANT LA VALEUR EST DETERMINEE PAR L-ADMINISTRATION DES DOMAINES</option>
                                <option value="5">5-NON RENSEIGNIE</option>
                            </select>
                        </div>
                        {{-- <div class="form-group col-md-6">
                            <label class="mr-sm-2">Sélectionnez un pays</label>
                            <select name="Pays" id="pays"  class="custom-select" required>
                                @foreach ($pays as $pay)
                                    <option value="{{ $pay->name }}"><img src="{{ asset($pay->flag_1x1) }}" class="flag-icon" alt="{{ $pay->flag_1x1 }}"> -  {{ $pay->name }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Evaluation locative</label>
                            <select name="Int_VL" value="{{ $ilot->Int_VL }}" class="custom-select" required>
                                <option value="{{ $ilot->Int_VL }}" selected>{{ $ilot->Int_VL }}-</option>
                                <option value="1">1-LA VALEUR RESULTE DE L-ACTE D-AFFECTATION</option>
                                <option value="2">2-LA VALEUR RESULTE DE L’ACTE TRANSLATIF DE PROPRIETE EN CAS D-ACQUISITION OU D-ECHANGE</option>
                                <option value="3">3-LA VALEUR EST DETERMINEE PAR LE SERVICE DES DOMAINES</option>
                                <option value="4">4-NON RENSEIGNER</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Surface cadastrée</label>
                            <input type="text" name="il_surf_cadastree" class="form-control" value="{{ $ilot->il_surf_cadastree }}" placeholder="Enter Surface cadastrée ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Montant Valeur Venale </label>
                            <input type="text" name="mantVV" class="form-control" value="{{ $ilot->mantVV }}" placeholder="Enter Montant Valeur Venale ">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Numéro de rue</label>
                            <input type="text" name="Num_Rue" class="form-control" value="{{ $ilot->Num_Rue }}" placeholder="Enter Numéro de rue ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Montant Valeur Locative</label>
                            <input type="text" class="form-control" value="{{ $ilot->mantVL }}" name="mantVL" placeholder="Montant Valeur Locative">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Images</label>
                            <input type="file" name="images[]" multiple class="form-control"  >
                        </div>
                        @if ($ilot->image)
                            <div class="form-group col-md-6">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ $ilot->image }}" width="150px" alt="Image">
                                </div>
                            </div>
                        @endif
                    </div>
                    {{-- end create Ilot --}}
                    <br><br>
                    {{-- Start create acte --}}
                    <h4>Ajoute acte  d'ilot :</h4>
                    <input type="text" hidden name="referenceActe_id" value=" {{ $ReferenceActe->id }}">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="date_pub" class="mr-sm-2">Date de publication :</label>
                            <input type="date" class="form-control" value="{{ $ReferenceActe->date_pub }}" name="date_pub">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nature_acte" class="mr-sm-2">Nature d'acte :</label>
                            <select class="custom-select" name="nature_acte">
                                <option value="{{ $ReferenceActe->nature_acte }}" selected>{{ $ReferenceActe->nature_acte }}</option>
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
                            <input type="text" class="form-control" value="{{ $ReferenceActe->volume1 }}" name="volume1" placeholder="enter Volume">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Construction_Acte" class="mr-sm-2">Construction d'acte :</label>
                            <select class="custom-select"  name="Construction_Acte">
                                <option value="{{ $ReferenceActe->Construction_Acte }}" selected >{{ $ReferenceActe->Construction_Acte }}</option>
                                <option value="lorsque les constructions ont été réalisées après acquisition du terrain d\'assiette">1-lorsque les constructions ont été réalisées après acquisition du terrain d\'assiette</option>
                                <option value="lorsque les constructions ont été affectées avec le terrain">2-lorsque les constructions ont été affectées avec le terrain</option>
                                <option value="Non renseigné">3-Non renseigné</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Origine_Acte" class="mr-sm-2">Origine_Acte :</label>
                            <select class="custom-select" name="Origine_Acte">
                                <option value="{{ $ReferenceActe->Origine_Acte }}" selected >{{ $ReferenceActe->Origine_Acte }}</option>
                                <option value="Non renseigner">1-Non renseigner</option>
                                <option value="Don">2-Don</option>
                                <option value="Cession à l-Etat à titre gratuit">3-Cession à l-Etat à titre gratuit</option>
                                <option value="Acquisition">4-Acquisition</option>
                                <option value="Réalisation">5-Réalisation</option>
                                <option value="Échange">6-Échange</option>
                                <option value="Bail ou convention">7-Bail ou convention</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="case11" class="mr-sm-2">Case :</label>
                            <input type="text" class="form-control" value="{{ $ReferenceActe->case11 }}" name="case11" placeholder="enter Case11">
                        </div>
                    </div>
                    {{-- end create acte --}}

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Ajoter</button>
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
        var $localiteInput = $('#localite-input');
        var $suggestionsList = $('#suggestions-list'); // Un élément HTML pour afficher les suggestions

        $localiteInput.on('input', function() {
            // Récupérez la valeur actuelle du champ de texte
            var searchText = $(this).val();
            console.log(searchText);
            // Obtenez la position du champ de texte
            var inputPosition = $(this).offset();

            // Mettez à jour la position de la liste de suggestions
            $suggestionsList.css({
                top: inputPosition.top + $(this).outerHeight(),
                left: inputPosition.left,
                width: $(this).outerWidth()
            });

            // Vérifiez s'il y a suffisamment de caractères pour déclencher la recherche
            if (searchText.length >= 3) {
                // Faites une requête à l'API Geoapify
                var apiKey = '6dc4b3a8b809474da008aede41f20822'; // Remplacez par votre clé API Geoapify
                var apiUrl = 'https://api.geoapify.com/v1/geocode/autocomplete?text=' + searchText + '&format=json&apiKey=' + apiKey;

                // Effectuez la requête AJAX
                $.ajax({
                    url: apiUrl,
                    method: 'GET',
                    success: function(response) {
                        // Effacez la liste des suggestions précédentes
                        $suggestionsList.empty();

                        // Vérifiez que les résultats existent
                        if (response.results) {
                            // Parcourez les résultats de l'API et ajoutez-les à la liste des suggestions
                            $.each(response.results, function(index, suggestion) {
                                // Vérifiez si la propriété 'formatted' existe dans l'objet 'suggestion'
                                if (suggestion.formatted) {
                                    // Créez un élément de liste pour chaque suggestion
                                    //   var $suggestionItem = $('<li class="bma_address">' + suggestion.formatted + '</li><span class="lat" style="display:none">' + suggestion.lat + '</span><span class="long" style="display:none">' + suggestion.lon + '</span>');
                                    var $suggestionItem = $('<li class="bma_address" data-lat="' + suggestion.lat + '" data-long="' + suggestion.lon + '">' + suggestion.formatted + '</li>');
                                    // Ajoutez un gestionnaire d'événement pour gérer la sélection de la suggestion
                                    $(document).on('click', '.bma_address', function() {
                                        // Mettez la valeur de la suggestion dans le champ de texte
                                        $localiteInput.val($(this).html());

                                        var lat = $(this).data('lat');
                                        var long = $(this).data('long');
                                        $('input[name="cord_X"]').val(lat);
                                        $('input[name="cord_y"]').val(long);
                                        // Effacez la liste des suggestions après avoir sélectionné une suggestion
                                        $suggestionsList.empty().hide();
                                    });

                                    // Ajoutez l'élément de suggestion à la liste
                                    $suggestionsList.append($suggestionItem);
                                }
                            });
                        }

                        // Affichez la liste des suggestions
                        $suggestionsList.show();
                    },
                    error: function(error) {
                        // Gérez les erreurs ici
                        console.error(error);
                    }
                });
            } else {
                // Effacez la liste des suggestions si le champ est vide
                $suggestionsList.empty().hide();
            }
        });

        // Gérez la fermeture de la liste des suggestions lors de la perte de focus du champ de texte
        $localiteInput.on('blur', function() {
       // $suggestionsList.empty().hide();
        });
    });

</script>
@endsection
