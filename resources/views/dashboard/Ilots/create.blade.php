<div class="modal fade" id="createBienModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Situation de L'immeuble
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Ajouter un ilot</h4>
                <!-- add_form -->
                <form action="{{ route('dashboard.ilots.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Numéro d'ilot</label>
                            <input type="text"  name="N_ilot" class="form-control" required placeholder="Enter Numéro d'ilot">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Âge</label>
                            <input type="text" class="form-control" name="Age" placeholder="Enter Âge">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Denomination de l'ilot</label>
                            <input type="text" class="form-control" name="Denom_Ilot" required placeholder="Enter Denomination de l'ilot">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Intitulé d'entretien</label>
                            <select  name="intit_Entretien" id="" required class="form-control">
                                <option value="1">1-BON ETAT</option>
                                <option value="2">2-ASSEZ BON ETAT</option>
                                <option value="3">3-VETUSTE</option>
                                <option value="4">4-NON RENSEIGNIE</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Nature</label>
                            <select class="form-control" name="Nature" id="" required>
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
                            <input type="text" name="type_enquete" class="form-control" placeholder="Enter Type d'enquête ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Utilisation</label>
                            <input type="text" name="Utlisation" class="form-control" placeholder="Enter Utilisation ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Observation de l'enquêteur</label>
                            <input type="text" name="Observation_enqueteur" class="form-control" placeholder="Enter Observation de l'enquêteur">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Rue_fr</label>
                            <select name="Rue_fr" id="" class="form-control" required>
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
                            <input type="date" name="date_Enquete" class="form-control" placeholder="Enter  ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Localite</label>
                            <input type="text" name="Localite" id="localite-input" autocomplete="off" class="form-control" placeholder="Enter Localite">
                            <ul id="suggestions-list"></ul>
                            <input type="hidden" name="cord_X">
                            <input type="hidden" name="cord_y">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Numéro téléphone de l'enquêteur</label>
                            <input type="text" name="Num_enqui" class="form-control" placeholder="Enter Numéro téléphone de l'enquêteur ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Ville</label>
                            <input type="text" name="Ville" class="form-control" placeholder="Enter Ville ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Evaluation vénale</label>
                            <select name="Int_VV"  class="form-control" required>
                                <option value="1">CELLE INDIQUEE DANS L’ACTE D’AFFECTATION</option>
                                <option value="2">CELLE QUI RESULTE DU COUT DE REALISATION</option>
                                <option value="3">CELLE INDIQUEE DANS L-ACTE TRANSLATIF DE PROPRIETE LORSQU-IL S’AGIT D-UN IMMEUBLE ACQUIS</option>
                                <option value="4">LE CAS ECHEANT LA VALEUR EST DETERMINEE PAR L-ADMINISTRATION DES DOMAINES</option>
                                <option value="5">NON RENSEIGNIE</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Pays</label>
                            <div class="custom-select">
                                <span class="selected-option" style="margin-top: -10px;">Sélectionnez un pays</span>
                                {{-- <ul class="options" style="background-color:white;height: 200px;overflow-y: scroll;">
                                    @foreach($pays as $paysInfo)
                                        <li data-value="{{ $paysInfo['name'] }}">
                                            <img src="{{ asset('public/'.$paysInfo['flag_1x1']) }}" alt="{{ $paysInfo['name'] }}" class="flag-icon">
                                            {{ $paysInfo['name'] }}
                                        </li>
                                    @endforeach
                                </ul> --}}
                            </div>
                            <input type="hidden" name="Pays" id="pays" value="">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Evaluation locative</label>
                            <select name="Int_VL" class="form-control" required>
                                <option value="1">1-LA VALEUR RESULTE DE L-ACTE D-AFFECTATION</option>
                                <option value="2">2-LA VALEUR RESULTE DE L’ACTE TRANSLATIF DE PROPRIETE EN CAS D-ACQUISITION OU D-ECHANGE</option>
                                <option value="3">3-LA VALEUR EST DETERMINEE PAR LE SERVICE DES DOMAINES</option>
                                <option value="4">4-NON RENSEIGNER</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Surface cadastrée</label>
                            <input type="text" name="il_surf_cadastree" class="form-control" placeholder="Enter Surface cadastrée ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Montant Valeur Venale </label>
                            <input type="text" name="mantVV" class="form-control" placeholder="Enter Montant Valeur Venale ">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Numéro de rue</label>
                            <input type="text" name="Num_Rue" class="form-control" placeholder="Enter Numéro de rue ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Montant Valeur Locative</label>
                            <input type="text" class="form-control" name="mantVL" placeholder="Montant Valeur Locative">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Images</label>
                            <input type="file" name="images[]" multiple class="form-control" >
                        </div>
                    </div>
                    <br><br>
            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" aria-label="Close" ata-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success">Ajoter</button>
                    </div>
                </form>
        </div>
    </div>
</div>

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

    $(document).ready(function () {
        $('.options').hide();
        // Ouvrir et fermer la liste déroulante personnalisée
        $('.selected-option').click(function () {
            $('.options').toggle();
        });
        // Sélectionner une option
        $('.options li').click(function () {
            var selectedValue = $(this).data('value');
            $('.selected-option').text(selectedValue);
            $('input[name="Pays"]').val(selectedValue);
            $('.options').hide();
        });
    });

</script>
@endsection
