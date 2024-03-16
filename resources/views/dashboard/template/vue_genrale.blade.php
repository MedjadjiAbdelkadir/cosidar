@extends('layouts.admin.master')

@section('content')
<style>
    .bordered-cell {
        border: 2px solid black;
       /* background-color: rgba(0, 0, 0, 0.1);  */
        padding: 5px;
    }

    .table th, .table td {
        padding: 0.1rem;
        vertical-align: top;
    /* border-top: 1px solid #e9ecef;*/
    }
    @media print {
        .qr_code canvas {display: block !important;}
        body {font-size: 12pt;}
    }
    .table {
        max-width: 100%;
        overflow-x: auto;
    }
    .overflow{
        overflow-y: auto;
        max-height: 1000px;
        width: 100%;
        overflow-x: hidden;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="width: 100%;margin-left:0%">
            <div class="card-header">
                <button class="btn btn-primary float-right" id="printButton" onclick="imprimerTableau()">Imprimer</button>
            </div>
            <div id="invoices" class="card-body">
                <div id="invoiceContent" class="overflow">
                    <table class="table" id="tableToPrint">
                    <tbody>
                        <tr style="text-align: center;">
                            <th colspan="2">ANNEXE 4</th>
                        </tr>
                        <tr style="margin-top: 2px;">
                            <td colspan="2" class="bordered">
                                <table width="100%">
                                    <tr>
                                        <td class="column left " style="text-align: center;margin-left:10%;width:30%">
                                            <div class="bordered-cell" >
                                                Ministère de Finance <br/> Direction génerale du domaine national
                                            </div>
                                        </td>
                                        <td class="column right " style="text-align: center;margin-left:30%;width:30%">
                                            <div class="bordered-cell id_imm" >
                                                Tableau général des immeubles du domaine national <br/> fiche d'identification d'immeuble
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="column left">
                                Immatriculation: @if ($ilot->proprietaire)
                                    {{ $ilot->proprietaire->pe_num}}
                                @else
                                    Aucun propriétaire trouvé
                                @endif
                            </td>
                            <td class="column right" style="padding-left:580px !important">
                                Propriétaire: @if ($ilot->proprietaire)
                                    {{ $ilot->proprietaire->tutelle?->Intitule }}
                                @else
                                    Aucun propriétaire trouvé
                                @endif
                            </td>
                        </tr>
                        <tr style="margin-top: 2px;">
                            <td colspan="2" class="bordered" style="padding:5px">
                                <table width="100%">
                                    <tr>
                                        <td class="column  " style="text-align: center;padding:5px">
                                            <div class="bordered-cell" style="margin-left: 1%;width:98%">
                                                <div class="bordered-cell"> Service affectataire :   </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr style="margin-top: -15px;margin-bottom:-15px;">
                            <td colspan="2" style="margin-top: -15px;margin-bottom:-15px;padding:5px">
                                <table width="100%">
                                    <tr >
                                        <td style="text-align: center;padding:5px">
                                            Dénomination:@if ($ilot->proprietaire)
                                            {{ $ilot->proprietaire->Denomination_fr }}
                                            @else
                                                Aucun propriétaire trouvé
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="width: 100%;">
                                <table width="100%">
                                    <tr>
                                        <td>Statut:@if ($ilot->proprietaire)
                                            {{ $ilot->proprietaire->statut?->Intitule }}
                                            @else
                                                Aucun propriétaire trouvé
                                            @endif
                                        </td>
                                        <td >N°:@if ($ilot->proprietaire)
                                            {{ $ilot->proprietaire->pe_num  }}
                                            @else
                                                Aucun propriétaire trouvé
                                            @endif
                                        </td>
                                        <td >Date:@if ($ilot->proprietaire)
                                            {{ $ilot->proprietaire->Date_Decision_affectation }}
                                            @else
                                                Aucun propriétaire trouvé
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                        <td colspan="2" style="width: 100%;">
                            <table width="100%">
                                <tr>
                                    <td>Affetctation:@if ($ilot->proprietaire)
                                        {{ $ilot->proprietaire->deciaffect->Intitule_fr }}
                                        @else
                                            Aucun propriétaire trouvé
                                        @endif
                                    </td>
                                    <td>N°:@if ($ilot->proprietaire)
                                        {{ $ilot->proprietaire->Num_Decision_affectation }}
                                        @else
                                            Aucun propriétaire trouvé
                                        @endif
                                    </td>
                                    <td>Date:@if ($ilot->proprietaire)
                                        {{ \Carbon\Carbon::parse($ilot->proprietaire->Date_Decision_affectation	)->format('Y-m-d') }}
                                        @else
                                            Aucun propriétaire trouvé
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </td>
                        </tr>
                        <tr style="margin-top: -15px;margin-bottom:-15px;">
                            <td colspan="2" style="margin-top: -15px;margin-bottom:-15px;padding:5px">
                                <table width="100%">
                                    <tr >
                                        <td style="text-align: center;padding:5px">
                                            Création:@if ($ilot->proprietaire)
                                            {{ $ilot->proprietaire->anx_text_creati?->Intitule }}
                                            @else
                                                Aucun propriétaire trouvé
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr style="margin-top: 2px;">
                            <td colspan="2" class="bordered">
                                <table width="100%">
                                    <tr>
                                        <td class="column  " style="text-align: center;padding: 5px;">
                                            <div class="bordered-cell" style="margin-left: 1%;width:98%">
                                                <div class="bordered-cell"> SItuation de l'immeuble  </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr style="margin-top: 2px;">
                            <td colspan="2" class="bordered">
                                <table width="100%">
                                    <tr>
                                        <td class="column  " style="text-align: center;padding: 5px;">
                                            Dénomination:{{ $ilot->Denom_Ilot }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class=" left">
                                Voie:{{ $ilot->Rue_fr }}
                            </td>
                            <td class=" right" style="padding-left:480px !important">
                                N°:{{ $ilot->Num_Rue }}
                            </td>
                        </tr>
                        <tr style="margin-top: 2px;">
                            <td colspan="2" class="bordered">
                                <table width="100%">
                                    <tr>
                                        <td class="column  " style="text-align: center;padding: 5px;">
                                            Ville ou localité:{{ $ilot->Localite }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class=" left">
                                Pays:{{ $ilot->Pays }}
                            </td>
                        </tr>
                        <tr style="margin-top: 2px;">
                            <td colspan="2" class="bordered" style="padding:0px">
                                <table width="100%">
                                    <tr>
                                        <td class="column  " style="text-align: center;padding:0px">
                                            <div class="bordered-cell" style="margin-left: 1%;width:98%">
                                                <div class="bordered-cell"> Description de l'immeuble  </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr style="margin-top: 2px;">
                            <td colspan="2" class="bordered">
                                <table width="100%">
                                    <tr>
                                        <td class="column  " style="text-align: center;padding: 5px;">
                                            Nature:{{ $ilot->anx_nature_imm->Intitule }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr style="margin-top: 2px;">
                            <td colspan="2" class="bordered">
                                <table width="100%">
                                    <tr>
                                        <td class="column  " style="text-align: center;padding: 5px;">
                                            Utilisation:{{ $ilot->Utlisation}}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr style="margin-top: 2px;">
                            <td colspan="2" class="bordered">
                                <table width="100%">
                                    <tr>
                                        <td class="column  " style="text-align: center;">
                                            <div class="bordered-cell" style="margin-left: 1%;width:98%">
                                                <div class="bordered-cell"> Origine des droits  </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class=" left">
                                Origine:@if ($ilot->acteReference)
                                    {{ $ilot->acteReference->Origine_Acte }}
                                @else
                                    Aucun acte trouvé
                                @endif
                            </td>
                        </tr>
                        <tr style="margin-top: 2px;">
                            <td colspan="2" class="bordered">
                                <table width="100%">
                                    <tr>
                                        <td class="column  " style="text-align: center;padding: 5px;">
                                                Construction:@if ($ilot->acteReference)
                                                    {{ $ilot->acteReference->Construction_Acte }}
                                                @else
                                                    Aucun acte trouvé
                                                @endif
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr id="tab_droit" >
                            <td colspan="2" style="width: 100%;">
                                <table width="100%">
                                    <tr>
                                        <td>Acte ou texte:@if ($ilot->acteReference)
                                            {{ $ilot->acteReference->Num_Nat_Acte}}
                                            @else
                                                Aucun acte trouvé
                                            @endif
                                        </td>
                                        <td >Nature:@if ($ilot->acteReference)
                                            {{ $ilot->acteReference->nature_acte}}
                                            @else
                                                Aucun acte trouvé
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="width: 100%;">
                                <table width="100%">
                                    <tr>
                                        <td>N°:Acte ou texte:@if ($ilot->acteReference)
                                            {{ $ilot->acteReference->case11}}
                                            @else
                                                Aucun acte trouvé
                                            @endif
                                        </td>
                                        <td >Date:Acte ou texte:@if ($ilot->acteReference)
                                                {{ $ilot->acteReference->date_pub}}
                                            @else
                                                Aucun acte trouvé
                                            @endif
                                        </td>
                                        <td >Vol/N°:Acte ou texte:@if ($ilot->acteReference)
                                            {{ $ilot->acteReference->volume1}}/{{ $ilot->acteReference->Ref_JRN}}
                                            @else
                                                Aucun acte trouvé
                                            @endif
                                        </td>

                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr style="margin-top: 2px;">
                            <td colspan="2" class="bordered">
                            <table width="100%" style="border-collapse: collapse; margin-top: 2px;">
                                <tr>
                                    <td style="text-align: center;">
                                        <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box; margin-left: 1%; width: 98%;">
                                            <div style="width: 48%; display: inline-block;" class="bordered-cell">Consistance</div>
                                            <div style="width: 48%; display: inline-block; " class="bordered-cell">Réparation des bâtiments / Catégories</div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="text-align: center;">
                                        <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box; margin-left: 1%; width: 98%;">
                                            <div style="width: 20%; display: inline-block;" class="titre bordered-cell">Batiment N°<br/> Nombre des niveaux <br/> Sup bâtié au sol S.D.H.O</div>

                                            <!-- Votre boucle foreach -->
                                            @foreach ($ilot->batiments as $batiment)
                                                <div style="width: 20%; display: inline-block;text-align: center;" class="bordered-cell">
                                                    {{ $batiment['bat_no'] }}<br/>
                                                    Nbr_Niveau: {{ $batiment['Nbr_Niveau'] }}<br/>
                                                    sup_SDHO: {{ $batiment['sup_SDHO'] }}
                                                </div>
                                                @if ($loop->iteration == 5)
                                                    @break
                                                @endif
                                            @endforeach

                                            <!-- Votre boucle for
                                            @for ($i = count($ilot->batiments); $i < 5; $i++)
                                                <div style="width: 20%; display: inline-block;" ></div>
                                            @endfor-->
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="text-align: center;">
                                        <div style="border: 1px solid #000; box-sizing: border-box; width: 98%;text-align: center;">
                                            <div style=" width: 20%; display: inline-block;">Total Superficie :</div>
                                            <div style="width: 20%; display: inline-block;">{{ $sup_SDHO_total }}</div>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Superficie assiette:{{ $sup_assiette }}</td>
                                </tr>
                            </table>


                            </td>
                        </tr>
                        <tr style="margin-top: 2px;">
                            <td colspan="2" class="bordered">
                                <table width="100%">
                                    <tr>
                                        <td class="column  " style="text-align: center;">
                                            <div class="bordered-cell" style="margin-left: 1%;width:98%">
                                                <div class="bordered-cell"> Réparaition des surfaces par nature des locaux  </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <table width="100%">
                                        <tr>
                                                <td class="bordered-cell"></td>
                                                <td class="bordered-cell ">Bureaux</td>
                                                <td class="bordered-cell ">Archives</td>
                                                <td class="bordered-cell ">L.Habit</td>
                                                <td class="bordered-cell ">L.Cult</td>
                                                <td class="bordered-cell ">L.Indus</td>
                                                <td class="bordered-cell ">L.Ense</td>
                                                <td class="bordered-cell ">Garage</td>
                                                <td class="bordered-cell ">Divers</td>
                                                <td class="bordered-cell ">Totaux</td>

                                        </tr>
                                        <tr>
                                            <td class="bordered-cell ">Nbre <br/> Super</td>
                                            <td class="bordered-cell ">{{$bureauxPieces}}<br/>{{$bureauxSurface}}</td>
                                            <td class="bordered-cell ">{{$sallesArchivesPieces}}<br/>{{$sallesArchivesSurface}}</td>
                                            <td class="bordered-cell ">{{$locauxHabitationsPieces}}<br/>{{$locauxHabitationsSurface}}</td>
                                            <td class="bordered-cell ">{{$locauxCulturelsPieces}}<br/>{{$locauxCulturelsSurface}}</td>
                                            <td class="bordered-cell ">{{$nonRenseignePieces}}<br/>{{$nonRenseigneSurface}}</td>
                                            <td class="bordered-cell ">{{$enseignementPieces}}<br/>{{$enseignementSurface}}</td>
                                            <td class="bordered-cell ">{{$garagesPieces}}<br/>{{$garagesSurface}}</td>
                                            <td class="bordered-cell ">{{$usagesDiversPieces}}<br/>{{$usagesDiversSurface}}</td>
                                            <td class="bordered-cell ">{{$totalPieces}}<br/>{{$totalSurface}}</td>
                                        </tr>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr style="margin-top: 2px;">
                            <td colspan="2" class="bordered">
                                <table width="100%">
                                    <tr>
                                        <td class="column  " style="text-align: center;">
                                            <div class="bordered-cell" style="margin-left: 1%;width:98%">
                                                <div class="bordered-cell"> Evaluation  </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="width: 100%;">
                                <table width="100%">
                                    <tr>
                                        <td>Valeur vénale:{{ $ilot->Int_VV }}</td>
                                        <td >Valeur locative:{{ $ilot->Int_VL }}</td>
                                        <td >Age:{{ $ilot->Age }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr style="margin-top: 2px;">
                            <td colspan="2" class="bordered">
                                <table width="100%">
                                    <tr>
                                        <td class="column  " style="text-align: center;padding: 5px;">
                                            Mode de determination:{{ $ilot->type_enquete }}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="width: 100%;">
                                <table width="100%">
                                    <tr>
                                        <td>Entretien:{{ $ilot->entretien_intitule }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr style="margin-top: 2px;">
                            <td colspan="2" class="bordered">
                            <table width="100%" style="border-collapse: collapse;">
                                <tr>
                                    <td style="text-align: center;">
                                        <div style="border: 1px solid #000; padding: 10px; box-sizing: border-box; margin-left: 1%; width: 98%; padding-bottom: -74px; display: flex; justify-content: space-between; align-items: flex-start;">

                                            <div style="width: 23%; height: 220px;" class="bordered-cell">Observation<br/>{{ $ilot->Observation_enqueteur }}</div>
                                            <div style="width: 23%; height: 220px;" class="bordered-cell">Date de saisie Date edition <br/>{{ \Carbon\Carbon::parse($ilot->date_sais)->format('Y-m-d') }}</div>
                                            <div style="width: 23%; height: 220px;" class="bordered-cell">Date edition <br/>{{ \Carbon\Carbon::parse($ilot->date_Enquete)->format('Y-m-d') }}</div>

                                            <div style="width: 23%; text-align: center; height: 220px;" class="bordered-cell">
                                                <div class="qr_code" style="margin-top: 2%;">
                                                    <img src="{{ url('cosidar/qr.png') }}" width="200" alt="Code QR" />
                                                </div>

                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            </table>
                            </td>
                        </tr>
                    </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.0/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

<script>

    const printButton = document.getElementById('printButton');
    const invoiceContent = document.getElementById('invoiceContent');

    printButton.addEventListener('click', () => {
        printButton.style.display = 'none'; // hide the button while printing
        invoiceContent.classList.remove('overflow');
        invoiceContent.focus(); // Focus the invoice content for proper formatting
        window.print();
    });

// function imprimerTableau() {
//     var table = document.getElementById("tableToPrint");
//     var newWin = window.open('', 'Print-Window');
//         newWin.document.open();
//         newWin.document.write('<html><head><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"><style>@media print {.qr_code {display: block !important;} .bordered-cell {border: 2px solid black;padding: 5px;}}</style></head><body onload="window.print()">' + table.outerHTML + '</body></html>');
//         newWin.document.close();
//         setTimeout(function () {
//             window.print();
//             // newWin.close();
//         }, 10);
// }

</script>

@endsection
