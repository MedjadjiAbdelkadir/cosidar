@extends('layouts.Home.app')
@section('content')
    {{-- Carousel Start --}}
        @include('Home.Salid.index')
    {{-- Carousel --}}
    <!-- Facts Start -->
        @include('Home.Facts.index')
    <!-- Facts End --
    <!-- About Start -->
        @include('Home.About.index')
    <!-- About end -->
    <!-- Service Start -->
        @include('Home.Service.index')
    <!-- Service end -->
    <!-- Service Start -->
        @include('Home.Feature.index')
    <!-- Service end -->
    <!-- Project Start -->
        {{-- @include('Home.Project.index') --}}
    <!-- Project end -->
    {{-- Map start --}}
        @include('Home.Map.index')
    {{-- Map end --}}
@endsection

@section('js')

<script>
    // Créer une carte Leaflet
    var map = L.map('map').setView([0, 0], 2); // Coordonnées initiales et niveau de zoom initial

    // Ajouter une couche de carte (par exemple, OpenStreetMap)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 25,
    }).addTo(map);
    // Créez une instance XMLHttpRequest pour effectuer la requête
    var xhr = new XMLHttpRequest();
    // Définissez la méthode et l'URL de la requête
    xhr.open("GET",   "{{ asset('template') }}", true);

    // Configurez la fonction de rappel pour gérer la réponse
    xhr.onreadystatechange = function () {

        // Vérifiez si la requête est terminée et la réponse est prête
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Analysez la réponse JSON
            var data = JSON.parse(xhr.responseText);
            // Vérifiez que data est un tableau et qu'il n'est pas vide
            if (Array.isArray(data) && data.length > 0) {
                // Parcourez les données JSON et ajoutez des marqueurs sur la carte
                data.forEach(function (donnee) {
                    var cordX = donnee.cord_X;
                    var cordY = donnee.cord_y;
                    var denomIlot = donnee.Denom_Ilot;

                    var pays = donnee.Pays;
                    var localite = donnee.Localite;

                    var nom_affiche = " Nom du bien : "+ denomIlot +"<br/> Localité : "+localite +" <br/> Pays : "+ pays;

                    // Vérifiez que les coordonnées sont valides
                    if (cordX != null && cordY != null) {
                        // Créez un marqueur et ajoutez-le à la carte
                        console.log([cordY, cordX]);
                        L.marker([cordX, cordY]).addTo(map).bindPopup(nom_affiche); // Affichez le nom de l'îlot en tant que pop-up
                    }
                });
            } else {
                console.error("Aucune donnée valide n'a été récupérée.");
            }
        }
    };

    // Envoyez la requête
    xhr.send();
</script>
</div>
@endsection
