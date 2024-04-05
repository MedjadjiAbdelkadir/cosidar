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
    table.border, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="width: 100%;margin-left:0%">
            <div class="card-header">
                <button class="btn btn-primary float-right" id="printButton" onclick="imprimerTableau()">Imprimer</button>
                <button class="btn btn-dark float-right mx-3" onclick="ConvertPDF()" id="create_pdf" >Export PDF</button>
            </div>
            <div id="invoices" class="card-body">
                <div id="invoiceContent" class="overflow">
                    <table class="table" id="tableToPrint" >
                    <tbody>
                        <tr class="border" style="text-align: center;">
                            <th class="border" colspan="2">
                                Université des sciences et technologie d’Oran USTO <br />
                                TP GESTION DES PROPRIETAIRE
                            </th>
                        </tr>
                        <tr class="border" style="text-align: center;">
                            <th class="border" colspan="2">
                                <img src="{{ asset('cosidar/logo.png') }}" width="190" alt="">
                            </th>
                        </tr>
                        <tr class="border" style="text-align: center;">
                            <th class="border" colspan="2">
                                L’EVALUATION DES BIENS De CONSIDER NATIONAL PAR REGION : {{ $proprietaires->region }}
                            </th>
                        </tr>
                        <td colspan="2" class="bordered">
                            <table width="100%">
                                <tr>
                                    <td class="border">
                                        <div>
                                            PAYE:
                                            @if ($proprietaires->paye)
                                                {{$proprietaires->paye }}
                                            @else
                                                il n'y a pas paye
                                            @endif.
                                        </div>
                                    </td>
                                    <td class="border" style="text-align: center;margin-left:30%;width:30%">
                                        <div class="" >
                                            <img src="{{ asset('qr_code/11.png') }}" width="100" alt="">
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <table class="table border">
                            <thead>
                                <tr>
                                    <th>Dénomination des biens</th>
                                    <th>Superficie de Bien</th>
                                    <th>Evaluation vénal </th>
                                    <th>Evaluation locative</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ilots as $ilot)
                                <tr >
                                    <td >
                                        <p>{{ $ilot->proprietaire->Denomination_fr }}</p><br>
                                        <p>{{ $ilot->Denom_Ilot }}, {{ $ilot->Utlisation }}, {{ $ilot->Localite }}, {{ $ilot->Ville }}, {{ $ilot->proprietaire->paye_name }}</p>
                                    </td>
                                    <td>{{ $ilot->il_surf_cadastree }}</td>
                                    <td>{{ $ilot->mantVV }}</td>
                                    <td>{{ $ilot->mantVL }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </tbody>
                    </table>
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
                doc.save('par-region-'+randomId+'.pdf');
            },
            margin: [5, 5, 2, 5],
            autoPaging: 'text',
            x: 0,
            y: 0,
            width: 200, //target width in the PDF document
            windowWidth: 950 //window width in CSS pixels
        });
    }
</script>

<script>
    // $(document).ready(function () {
    //     const invoiceContent = document.getElementById('invoiceContent');
    //     function generateRandomId(length) {
    //         return Math.random().toString(36).substr(2, length);
    //     }
    //     // Usage
    //     const randomId = generateRandomId(3);
    //     var form = $('.overflow'),
    //     cache_width = form.width(),
    //     a4 = [652, 2000]; // for a4 size paper width and height

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
    //             doc.addImage(img, 'JPEG', 10, 15);
    //             doc.save('parregion-'+randomId+'.pdf');
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
    const invoiceContent = document.getElementById('invoiceContent');
    const createpdfButton = document.getElementById('create_pdf');

    printButton.addEventListener('click', () => {
        printButton.style.display = 'none'; // hide the button while printing
        createpdfButton.style.display = 'none'; // hide the button while printing
        invoiceContent.classList.remove('overflow');
        invoiceContent.focus(); // Focus the invoice content for proper formatting
        window.print();
    });

</script>
@endsection
