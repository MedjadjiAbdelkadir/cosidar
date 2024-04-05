@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="width: 100%;margin-left:0%">
            <div class="card-header">
                <button class="btn btn-primary float-right" id="printButton" onclick="imprimerTableau()">Imprimer </button>
                <button class="btn btn-dark float-right mx-3" onclick="ConvertPDF()" id="create_pdf" >Export PDF</button>
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
                                    /
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
                                        /
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



{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="{{ asset('jsPDF/jspdf.umd.js') }}"></script>
<script>
    window.jsPDF = window.jspdf.jsPDF;
    var doc = new jsPDF();
    function generateRandomId(length) {
        return Math.random().toString(36).substr(2, length);
    }
    // Usage
    const randomId = generateRandomId(3);
    // Convert HTML content to PDF
    function ConvertPDF() {
        var doc = new jsPDF();
        // Source HTMLElement or a string containing HTML.
        var elementHTML = document.querySelector("#invoiceContent");
        doc.html(elementHTML, {
            callback: function(doc) {
                // Save the PDF
                doc.save('annexe-'+randomId+'.pdf');
            },
            margin: [5, 5, 2, 5],
            autoPaging: 'text',
            x: 0,
            y: 0,
            width: 205, //target width in the PDF document
            windowWidth: 950 //window width in CSS pixels
        });
    }
</script>

<script>
    // $(document).ready(function () {
    //     const invoiceContent = document.getElementById('invoiceContent');
    //     var form = $('.overflow'),
    //     cache_width = form.width(),
    //     a4 = [895.28, 1841.89]; // for a4 size paper width and height

    //     $('#create_pdf').on('click', function () {
    //         invoiceContent.classList.remove('overflow');
    //         $('body').scrollTop(0);
    //         createPDF();
    //     });

    //     function createPDF() {
    //         getCanvas().then(function (canvas) {
    //             var
    //                 img = canvas.toDataURL("image/png"),
    //                 doc = new jsPDF({
    //                     unit: 'px',
    //                     format: 'a4'
    //                 });
    //             doc.addImage(img, 'JPEG', 5, 5);
    //             doc.save('techsolutionstuff.pdf');
    //             form.width(cache_width);
    //         });
    //     }

    //     function getCanvas() {
    //         form.width((a4[0] * 1.33333) - 80).css('max-width', 'none');
    //         return html2canvas(form, {
    //             imageTimeout: 2000,
    //             removeContainer: true
    //         });
    //     }
    // });
</script>
<script>
    const printButton = document.getElementById('printButton');
    const createButton = document.getElementById('create_pdf');
    const invoiceContent = document.getElementById('invoiceContent');

    printButton.addEventListener('click', () => {
        printButton.style.display = 'none'; // hide the button while printing
        createButton.style.display = 'none'; // hide the button while printing
        invoiceContent.classList.remove('overflow');
        invoiceContent.focus(); // Focus the invoice content for proper formatting
        window.print();
    });
</script>
@endsection
