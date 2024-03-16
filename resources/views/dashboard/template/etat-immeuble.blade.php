@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="width: 100%;margin-left:0%">
            <div class="card-header">
                <button class="btn btn-primary float-right" id="printButton" onclick="imprimerTableau()">Imprimer</button>
            </div>
            <div id="invoices" class="card-body">
                <div id="invoiceContent">
                    <table class="table" id="tableToPrint">
                        <tr style="text-align: center;">
                            <th colspan="2">
                                Designation de l’immeuble
                            </th>
                        </tr>
                        <td class="column left" >
                        <div class="mb-3">
                            <p><strong>N_ilot: </strong>{{ $ilot->N_ilot  }}</p>
                            <p><strong>Denom_Ilot: </strong>{{ $ilot->Denom_Ilot  }}</p>
                        </div>
                        <div class="mb-3">
                            <p><strong>Nature: </strong>
                                @switch($ilot->Nature)
                                    @case(0)
                                        NON RENSEIGNIE
                                        @break
                                    @case(1)
                                        IMMEUBLE ADMINISTRATIFS
                                        @break
                                    @case(2)
                                        IMMEUBLE D-HABITATION
                                        @break
                                    @case(3)
                                        IMMEUBLE A USAGE SOCIAL OU CULTURELS
                                        @break
                                    @case(12)
                                        LOCAUX COMMERCIAUX
                                        @break
                                    @case(14)
                                        LOCAUX DE SENTE
                                        @break
                                    @case(16)
                                        LOCAUX INDISTRIELS
                                        @break
                                    @case(17)
                                        LOCAUX MIXTES (ADMINISTRATIFS COMMERCIAUX ETS  )
                                        @break
                                    @case(18)
                                        LOCAUX PROFESSIONNELS
                                        @break
                                    @case(22)
                                        AUTRE
                                        @break
                                    @default
                                    Inconnu
                                @endswitch
                            </p>
                            <p><strong>Utlisation: </strong>{{ $ilot->Utlisation  }}</p>
                        </div>
                        <div class="mb-3">
                            <p><strong>Rue_fr: </strong>{{ $ilot->Rue_fr  }}</p>
                            <p><strong>Localite: </strong>{{ $ilot->Localite  }}</p>
                            <p><strong>Ville: </strong>{{ $ilot->Ville  }}</p>
                            <p><strong>Pays: </strong>{{ $ilot->proprietaire->paye_name  }}</p>
                        </div>
                        <div class="mb-3">
                            <p><strong>il_surf_cadastree: </strong>{{ $ilot->il_surf_cadastree  }}</p>
                        </div>
                        <div class="mb-3">
                            <p><strong>Int_VV: </strong>
                                @switch($ilot->Int_VV)
                                    @case(1)
                                        CELLE INDIQUEE DANS L’ACTE D’AFFECTATION
                                        @break
                                    @case(2)
                                        CELLE QUI RESULTE DU COUT DE REALISATION
                                        @break
                                    @case(3)
                                        CELLE INDIQUEE DANS L-ACTE TRANSLATIF DE PROPRIETE LORSQU-IL S’AGIT D-UN IMMEUBLE ACQUIS
                                        @break
                                    @case(4)
                                        LE CAS ECHEANT LA VALEUR EST DETERMINEE PAR L-ADMINISTRATION DES DOMAINES
                                        @break
                                    @case(5)
                                        NON RENSEIGNIE
                                        @break
                                    @default
                                    Inconnu
                                @endswitch
                            </p>
                            <p><strong>Int_VL: </strong>
                                @switch($ilot->Int_VL)
                                    @case(1)
                                        LA VALEUR RESULTE DE L-ACTE D-AFFECTATION
                                        @break
                                    @case(2)
                                        LA VALEUR RESULTE DE L’ACTE TRANSLATIF DE PROPRIETE EN CAS D-ACQUISITION OU D-ECHANGE
                                        @break
                                    @case(3)
                                        LA VALEUR EST DETERMINEE PAR LE SERVICE DES DOMAINES
                                        @break
                                    @case(4)
                                        NON RENSEIGNER
                                        @break
                                    @default
                                        Inconnu
                                @endswitch
                            </p>
                        </div>
                        <div class="mb-3">
                            <p><strong>Age: </strong>{{ $ilot->Age  }}</p>
                            <p><strong>intit_Entretien: </strong>
                                @switch($ilot->ntit_Entretien)
                                    @case(1)
                                        BON ETAT
                                        @break
                                    @case(2)
                                        ASSEZ BON ETAT
                                        @break
                                    @case(3)
                                        VETUSTE
                                        @break
                                    @case(4)
                                        NON RENSEIGNIE
                                        @break
                                    @default
                                        Inconnu
                                @endswitch
                            </p>
                            <p><strong>Observation_enqueteur: </strong>{{ $ilot->Observation_enqueteur  }}</p>
                            <p><strong>date_Enquete: </strong>{{ $ilot->date_Enquete  }}</p>
                        </div>
                        <div class="mb-3">
                            <p><strong>cord_X: </strong>{{ $ilot->cord_X  }}</p>
                            <p><strong>cord_Y: </strong>{{ $ilot->cord_y  }}</p>
                        </div>
                        <div class="mb-3">
                            <p><strong>mantVV: </strong>{{ $ilot->mantVV  }}</p>
                            <p><strong>mantVL: </strong>{{ $ilot->mantVL  }}</p>
                        </div>
                        </td>

                        <tr style="text-align: center;">
                            <th colspan="2">
                                SERVICE AFFECTAIRE
                            </th>
                        </tr>
                        <td class="column left" >
                        <div class="mb-3">
                            <p><strong>Denomination_fr: </strong>{{ $ilot->proprietaire->Denomination_fr  }}</p>
                        </div>
                        <div class="mb-3">
                            <p><strong>Statut: </strong>{{ $ilot->proprietaire->statut?->Intitule  }}</p>
                            <p><strong>Tutelle: </strong>{{ $ilot->proprietaire->tutelle?->Intitule  }}</p>
                        </div>
                        <div class="mb-3">
                            <p><strong>txt_creation: </strong>{{ $ilot->proprietaire->anx_text_creati?->Intitule  }}</p>
                            <p><strong>Date_txt_creation: </strong>{{ $ilot->proprietaire->Date_txt_creation  }}</p>
                        </div>
                        <div class="mb-3">
                            <p><strong>Decision_affectation: </strong>{{ $ilot->proprietaire->deciaffect?->Intitule_fr  }}</p>
                            <p><strong>Num_Decision_affectation: </strong>{{ $ilot->proprietaire->Num_Decision_affectation	  }}</p>
                            <p><strong>Date_Decision_affectation: </strong>{{ $ilot->proprietaire->Date_Decision_affectation  }}</p>
                        </div>
                        </td>
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
//     var button = document.getElementById("printInvoice");
//     button.style.display = 'none';
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
