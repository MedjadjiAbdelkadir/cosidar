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
            </div>
            <div id="invoices" class="card-body">
                <div id="invoiceContent">
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
                        <table class="table table-striped border">
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
//         newWin.document.write('<html><head><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"><style>@media print .bordered-cell {border: 2px solid black;padding: 5px;}}</style></head><body onload="window.print()">' + table.outerHTML + '</body></html>');
//         newWin.document.close();
//         setTimeout(function () {
//             window.print();
//             newWin.close();
//         }, 10);
// }

</script>
@endsection
