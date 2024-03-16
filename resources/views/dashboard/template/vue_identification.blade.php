@extends('layouts.admin.master')

@section('content')
<style>
    .bordered-cell {
        border: 2px solid black;
        padding: 5px;
    }
    .table th, .table td {
        padding: 0.1rem;
        vertical-align: top;
    }
    @media print {
        .qr_code canvas {
            display: block !important;
        }
        body {
            font-size: 10px;
        }
    }
</style>
<style type="text/css">
    .overflow{
        overflow-y: auto;
        max-height: 1000px;
        width: 100%;
        overflow-x: hidden;
    }
    .bordered-cell {
        border: 2px solid black;
       /* background-color: rgba(0, 0, 0, 0.1);  */
        padding: 5px;
    }
    @media screen, print {
        .table {
            /* width: 100%;*/
            border-collapse: collapse;
        }
        #tableToPrint {
            transform: rotate(90deg);
            transform-origin: 50% 50%;
        }
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="width: 100%; margin-left: 0%">
                <div class="card-header">
                    <button class="btn btn-primary float-right" id="printButton" onclick="imprimerTableau()">Imprimer</button>
                </div>
                <div class="card-body">
                    <div id="invoiceContent" class="overflow">
                        <table class="table printable" style="border-spacing: 10px;">
                            <tr>
                                <td style="width: 100%; height: 100%; vertical-align: top;">
                                    <table class="table printable">
                                        <tr class="bordered-cell">
                                            <td style="text-align: center; background-color: white;"></td>
                                            <td style="text-align: center; background-color: white;">Ministère de Finance <br/> Direction génerale du domaine national</td>
                                            <td style="text-align: center; background-color: white;"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <table class="table " id="tableToPrint" style=" margin-top: 260px; margin-right: -100px">
                            <tr>
                                <td style="width: 100%; text-align: center;">Annexe 1</td>
                            </tr>
                            <tr>
                                <td style="width: 100%; text-align: center;">Fiche d'identification d'immeuble</td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="table printable">
                                        <tr>
                                            <td style="text-align: center; background-color: #e7f5f7; padding:30px 90px" class="bordered-cell">
                                                <p><strong><u>SERVICE AFFECTATION</u></strong></p>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            Dénomination :@if ($ilot->proprietaire)
                                                                {{ $ilot->proprietaire->Denomination_fr }}
                                                            @else
                                                                Aucun propriétaire trouvé
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="width: 33.33%;">
                                                            Statut:
                                                            @if ($ilot->proprietaire)
                                                                {{ $ilot->proprietaire->statut?->Intitule }}
                                                            @else
                                                                Aucun propriétaire trouvé
                                                            @endif
                                                        </td>
                                                        <td style="width: 33.33%;">
                                                            Tutelle: Propriétaire:
                                                            @if ($ilot->proprietaire)
                                                                {{ $ilot->proprietaire->tutelle?->Intitule }}
                                                            @else
                                                                Aucun propriétaire trouvé
                                                            @endif
                                                        </td>
                                                        <td style="width: 33.33%;">
                                                            Date:
                                                            <p style="font-size: 11px; margin: 0;">
                                                                @if ($ilot->proprietaire)
                                                                    {{ \Carbon\Carbon::parse($ilot->proprietaire->Date_txt_creation)->format('Y-m-d') }}
                                                                @else
                                                                    Aucun propriétaire trouvé
                                                                @endif
                                                            </p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            Décision d'affectation :@if ($ilot->proprietaire)
                                                                {{ $ilot->proprietaire->deciaffect->Intitule_fr }}
                                                            @else
                                                                Aucun propriétaire trouvé
                                                            @endif
                                                        </td>
                                                        <td>
                                                            N° :@if ($ilot->proprietaire)
                                                                {{ $ilot->proprietaire->deciaffect->Deci_Af }}
                                                            @else
                                                                Aucun propriétaire trouvé
                                                            @endif
                                                        </td>
                                                        <td>
                                                            Date : <br/>
                                                            <p style="font-size: 11px;">
                                                                @if ($ilot->proprietaire)
                                                                    {{ $ilot->proprietaire->Date_Decision_affectation }}
                                                                @else
                                                                    Aucun propriétaire trouvé
                                                                @endif
                                                            </p>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <p><strong><u>SITUATION DE L'IMMEUBLE</u></strong></p>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            N° Ilot : {{ $ilot->Num_ilot }}
                                                        </td>
                                                        <td>
                                                            Dénomination :{{ $ilot->Denom_Ilot }}

                                                        </td>
                                                    </tr>
                                                </table>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            Rue :{{ $ilot->Rue_fr }}
                                                        </td>
                                                        <td>
                                                            N° :{{ $ilot->Num_Rue }}
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            Localité :{{ $ilot->Localite }}
                                                        </td>

                                                    </tr>
                                                </table>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            Ville : {{ $ilot->Ville }}
                                                        </td>
                                                        <td>
                                                            Pays :{{ $ilot->Pays }}
                                                        </td>
                                                    </tr>
                                                </table>
                                                <p><strong><u>DESCRIPTION DE L'IMMEUBLE</u></strong></p>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            Nature : {{ $ilot->nature_nom }}
                                                        </td>
                                                        <td>
                                                            Utilisation :{{ $ilot->Utlisation}}
                                                        </td>
                                                    </tr>
                                                </table>
                                                <p><strong><u>ORIGINE DES DROITS</u></strong></p>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            Origine :
                                                            @if ($ilot->proprietaire)
                                                                {{ $ilot->acteReference->Origine_Acte }}
                                                            @else
                                                                Aucun acte trouvé
                                                            @endif
                                                        </td>
                                                        <td>
                                                            Construction :
                                                            @if ($ilot->proprietaire)
                                                                {{ $ilot->acteReference->Construction_Acte }}
                                                            @else
                                                                Aucun acte trouvé
                                                            @endif
                                                        </td>
                                                        <td>
                                                            Nature de l'acte ou du texte :
                                                            @if ($ilot->proprietaire)
                                                                {{ $ilot->acteReference->nature_acte}}
                                                            @else
                                                                Aucun acte trouvé
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            Réference de l'acte :
                                                            @if ($ilot->proprietaire)
                                                                {{ $ilot->acteReference->Num_Nat_Acte}}
                                                            @else
                                                                Aucun acte trouvé
                                                            @endif
                                                        </td>
                                                        <td>
                                                            Date :
                                                            @if ($ilot->proprietaire)
                                                                <p style="font-size: 11px;">
                                                                    {{ $ilot->acteReference->date_pub}}
                                                                </p>
                                                            @else
                                                                Aucun acte trouvé
                                                            @endif
                                                        </td>
                                                        <td>
                                                            N° :
                                                            @if ($ilot->proprietaire)
                                                                {{ $ilot->acteReference->case11}}
                                                            @else
                                                                Aucun acte trouvé
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            Volume :
                                                            @if ($ilot->proprietaire)
                                                                {{ $ilot->acteReference->volume1}}/{{ $ilot->acteReference->Ref_JRN}}
                                                            @else
                                                                Aucun acte trouvé
                                                            @endif
                                                        </td>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td style="text-align: center; background-color: #D5F1CB;" class="bordered-cell">Consistance
                                                <table>
                                                    <tr>
                                                        <td>
                                                            REPARATION DES BATIMENTS PAR CATEGORIE :
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table style="border-collapse: collapse; width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th style="border: 1px solid black; background-color: #f2f2f2;">N° Batiment</th>
                                                            <th style="border: 1px solid black; background-color: #f2f2f2;">nbre de niveaux</th>
                                                            <th style="border: 1px solid black; background-color: #f2f2f2;">Sup Bat au sol</th>
                                                            <th style="border: 1px solid black; background-color: #f2f2f2;">S.D.H.O</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="border: 1px solid black;">
                                                                @foreach ($ilot->batiments as $batiment)
                                                                    <div style="width: 20%;;text-align: center;" >
                                                                        {{ $batiment['bat_no'] }}<br/>
                                                                    </div>
                                                                    @if ($loop->iteration == 5)
                                                                        @break
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td style="border: 1px solid black;">
                                                                @foreach ($ilot->batiments as $batiment)
                                                                    <div style="width: 20%; text-align: center;" >
                                                                        {{ $batiment['Nbr_Niveau'] }}<br/>
                                                                    </div>
                                                                    @if ($loop->iteration == 5)
                                                                        @break
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td style="border: 1px solid black;">data3  construction supp</td>
                                                            <td style="border: 1px solid black;">
                                                                @foreach ($ilot->batiments as $batiment)
                                                                    <div style="width: 20%; ;text-align: center;" >
                                                                        {{ $batiment['sup_SDHO'] }}<br/>
                                                                    </div>
                                                                    @if ($loop->iteration == 5)
                                                                        @break
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2" style="border: 1px solid black;">Total des superficies batiments</td>
                                                            <td style="border: 1px solid black;">{{$totalSurface}}</td>
                                                            <td  style="border: 1px solid black;">{{ $sup_SDHO_total }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="3" style="border: 1px solid black;">Superficie du terrain d'assiette</td>
                                                            <td style="border: 1px solid black;">{{$sup_SDHO_total + $totalSurface}} </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            REPARATION DES SURFACES UTILES PAR NATURE DES LOCAUX :
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table style="border-collapse: collapse; width: 100%;">
                                                    <thead>
                                                        <tr>
                                                            <th style="border: 1px solid black; background-color: #f2f2f2;"></th>
                                                            <th style="border: 1px solid black; background-color: #f2f2f2;">Bureaux</th>
                                                            <th style="border: 1px solid black; background-color: #f2f2f2;">Arch</th>
                                                            <th style="border: 1px solid black; background-color: #f2f2f2;">L.Hab</th>
                                                            <th style="border: 1px solid black; background-color: #f2f2f2;">L.Cult</th>
                                                            <th style="border: 1px solid black; background-color: #f2f2f2;">L.Ind</th>
                                                            <th style="border: 1px solid black; background-color: #f2f2f2;">L.Ensg</th>
                                                            <th style="border: 1px solid black; background-color: #f2f2f2;">Garage</th>
                                                            <th style="border: 1px solid black; background-color: #f2f2f2;">Divers</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td style="border: 1px solid black;">Nbre pieces</td>
                                                            <td style="border: 1px solid black;">{{$bureauxPieces}}</td>
                                                            <td style="border: 1px solid black;">{{$sallesArchivesPieces}}</td>
                                                            <td style="border: 1px solid black;">{{$locauxHabitationsPieces}}</td>
                                                            <td style="border: 1px solid black;">{{$locauxCulturelsPieces}}</td>
                                                            <td style="border: 1px solid black;">{{$nonRenseignePieces}}</td>
                                                            <td style="border: 1px solid black;">{{$enseignementPieces}}</td>
                                                            <td style="border: 1px solid black;">{{$garagesPieces}}</td>
                                                            <td style="border: 1px solid black;">{{$nonRenseignePieces}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border: 1px solid black;">Superficies</td>
                                                            <td style="border: 1px solid black;">{{$bureauxSurface}}</td>
                                                            <td style="border: 1px solid black;">{{$sallesArchivesSurface}}</td>
                                                            <td style="border: 1px solid black;">{{$locauxHabitationsSurface}}</td>
                                                            <td style="border: 1px solid black;">{{$locauxCulturelsSurface}}</td>
                                                            <td style="border: 1px solid black;">{{$nonRenseigneSurface}}</td>
                                                            <td style="border: 1px solid black;">{{$enseignementSurface}}</td>
                                                            <td style="border: 1px solid black;">{{$garagesSurface}}</td>
                                                            <td style="border: 1px solid black;">{{$usagesDiversSurface}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="9" style="border: 1px solid black;">{{$totalSurface}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            EVALUATION
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            V.V :  {{ $ilot->Int_VV }} D.A
                                                        </td>
                                                        <td>
                                                            V.L :  {{ $ilot->Int_VL }} D.A
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            Mode de détermination de valeur
                                                        </td>
                                                        <td>
                                                            Age :{{ $ilot->Age }}
                                                        </td>
                                                        <td>
                                                            Entretien :{{ $ilot->entretien_intitule }}
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            OBSERVATION :
                                                            <br/>
                                                            {{ $ilot->Observation_enqueteur }}
                                                        </td>
                                                    </tr>
                                                </table>
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <p style="font-size: 11px;">
                                                                Fiche établie le :{{ \Carbon\Carbon::parse($ilot->date_Enquete)->format('Y-m-d') }}
                                                            </p>
                                                        </td>
                                                        <td>
                                                            Téléphone enquêteur : {{$ilot->Num_enqui}}
                                                        </td>

                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <tr>
                            <th class="border" >
                                <img src="{{ asset('qr_code/11.png') }}" width="180" alt="">
                            </th>
                        </tr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    const printButton = document.getElementById('printButton');
    const invoiceContent = document.getElementById('invoiceContent');

    printButton.addEventListener('click', () => {
        printButton.style.display = 'none'; // hide the button while printing
        invoiceContent.classList.remove('overflow');
        invoiceContent.focus(); // Focus the invoice content for proper formatting
        window.print();
    });

//     function imprimerTableau() {
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
