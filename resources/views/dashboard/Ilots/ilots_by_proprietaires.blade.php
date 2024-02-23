@extends('layouts.admin.master')
@section('css')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('title')
Situation de l’immeuble
@stop
@endsection

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0 text-danger">Situation de l’immeuble</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">Dashboard</a></li>
                {{-- <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">Dashboard</a></li> --}}
                <li class="breadcrumb-item active">Situation de l’immeuble</li>
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
                <div class="row">
                    <div class="col-sm-12 col-md-2 col-lg-3">
                        <div class="table-responsive">
                            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                                <thead>
                                    <tr>
                                        <th scope="col">#ID</th>
                                        <th>Denomination</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ilots as $key => $ilot)
                                    {{-- @foreach ($batimentas;$batiment) --}}
                                    <tr id="{{$ilot->Num_ilot}}" class="li_ilot" style="cursor: pointer;">
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$ilot->Denom_Ilot}}</td>
                                    </tr>
                                    @endforeach
        
                                </tbody>
                            </table>
                            {{ $ilots->links() }}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-10 col-lg-9">
                        <div class="map" style="display:none">
                            <div style="display:flex;margin-bottom: 20px;">
                                <div class="col-lg-6 div1" style="border: 1px solid #000;width: 50%;"></div>
                                <div class="col-lg-6 div2" style="border: 1px solid #000;width: 50%;"></div>
                            </div>
                            <div id="map" style="height: 400px;"></div>
                        </div>
                        <iframe id="google" src=""  width="100%" height="600px"  style="display:none"></iframe>
                    </div>
                </div>

            </div>

    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {

        ////////////
        var map;

        // Fonction pour initialiser la carte
        function initializeMap() {
            // Initialisation de la carte
            map = L.map('map').setView([0, 0], 2);

            // Ajouter une couche de carte (par exemple, OpenStreetMap)
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);
        }

//////////////



        $(document).on('click', '.li_ilot', function() {
               
            if (map) {
                map.remove();
            }

            //  marker ="";
            $(".div1").html("");
            $(".div2").html("");


            var ilotId = $(this).attr('id');
            //////////////////////

            $.ajax({
                url : "{{ url('dashboard/ilots/get_full_detail_ilot')}}"+'/'+ilotId,
                method: 'GET',
                success: function(data) {
                    console.log(data);
                    if (data.ilot) {
                        $(".div1")
                            .append("<p><span class='titles'>Age : </span><span class='titles_data'>" + (data.ilot.Age ?? "") + "</span></p>")
                            .append("<p><span class='titles'>Denomination Ilot :</span><span class='titles_data'> " + (data.ilot.Denom_Ilot ?? "") + "</span></p>")
                            .append("<p><span class='titles'>Localite :</span><span class='titles_data'> " + (data.ilot.Localite ?? "") + "</span></p>")
                            .append("<p><span class='titles'>Nature Nom :</span><span class='titles_data'> " + (data.ilot.nature_nom ?? "") + "</span></p>")
                            .append("<p><span class='titles'>Pays :</span><span> " + (data.ilot.Pays ?? "") + "</span></p>");

                        $(".div2")
                            .append("<p><span class='titles'>Observation enqueteur :</span><span class='titles_data'> " + (data.ilot.Observation_enqueteur ?? "") + "</span></p>")
                            .append("<p><span class='titles'>Type enquete :</span><span class='titles_data'> " + (data.ilot.type_enquete ?? "") + "</span></p>")
                            .append("<p><span class='titles'>Denomination Proprietaire :</span><span class='titles_data'> " + (data.ilot.proprietaire?.Denomination_fr ?? "") + "</span></p>")
                            .append("<p><span class='titles'>Nature Nom :</span><span class='titles_data'> " + (data.ilot.nature_nom ?? "") + "</span></p>")
                            .append("<p><span class='titles'>Intitule Deciaffect :</span><span class='titles_data'> " + (data.ilot.proprietaire?.deciaffect?.Intitule_fr ?? "") + "</span></p>");
                    } else {
                    // console.error("data.ilot est indéfini ou null.");
                        console.log("data.ilot est indéfini ou null.");

                    }

                    $(".titles").css({
                        "font-weight": "bold",  // Texte en gras
                        "margin-right": "5px"   // Marge à droite pour les deux points
                    });
                
                                
                    $(".titles_data").each(function() {
                        var $this = $(this);
                        var content = $this.text();
                        if (content.length > 30) {
                        // var shortenedContent = content.substring(0, 30) + "...";
                            var shortenedContent = content;

                            $this.text(shortenedContent).attr("title", content);
                        }
                    });            
                        

                    ///////////////////////////////
                    $(".content_ilots").css("display","none");
                    //$(".map").css("display","block");
                    $("#google").css("display","block");
                    $(".list_ilots").css("display","none");
                    $(".retour").css("display","block");


                    initializeMap();
                    //////////
                    $(".retour").click(function(){
                    $(".content_ilots").css("display","block");
                    //  $(".map").css("display","none");
                    $("#google").css("display","none");

                    $(".list_ilots").css("display","block");
                    $(".retour").css("display","none");

                })

            //////////  
                //  data = JSON.parse(data);
                
            ////////////////
                // Vérifier que data est un tableau et qu'il n'est pas vide
            console.log(data.ilot)

                if (data.ilot.cord_X) {
                    // Parcourir les données JSON et ajouter des marqueurs sur la carte
                    var cordX = data.ilot.cord_X;
                    var cordY = data.ilot.cord_y;
                    var denomIlot = data.ilot.Denom_Ilot;

                        // Vérifier que les coordonnées sont valides
                    if (cordX != null && cordY != null) {
                        // Créer un marqueur et l'ajouter à la carte
                        marker = L.marker([cordX, cordY]).addTo(map).bindPopup(denomIlot); // Afficher le nom de l'îlot en tant que pop-up
                        //////////////////// 
                        $("#google").attr("src","https://maps.google.com/maps?q="+cordX +','+cordY+"&output=embed")     
                        //alert("https://maps.google.com/maps?q="+cordX +','+cordY+"&output=embed")
                        //////////////////////////
                    }
                    
                    } else {
                    // if (marker !== null) 
                        {
                        //map.removeLayer(marker);
                    }
                        console.log("Aucune donnée valide n'a été récupérée.");
                    }
                    
                    


                    ////////////////////////////
                    },
                    error: function(error) {
                        console.log(error);
                    }

            });   // fin get ajax

            //////////////////////
           
        });

    });
</script>
@endsection
