@extends('layouts.admin.master')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card" style="width: 100%;margin-left:0%">
            <div class="card-header">
                <button class="btn btn-primary float-right" id="printInvoice" onclick="imprimerTableau()">Imprimer</button>
            </div>
            <div id="invoices" class="card-body">
                <div style="overflow-y: auto; max-height: 700px; width: 100%; overflow-x: hidden;">
                    <table class="table" id="tableToPrint">
                    <tbody>
                        <tr style="text-align: center;">
                            <th colspan="2">
                                Université des sciences et technologie d’Oran USTO <br />
                                TP GESTION DES PROPRIETAIRE
                            </th>
                        </tr>
                        <tr style="text-align: center;">
                            <th colspan="2">
                                <img src="{{ asset('cosidar/logo.png') }}" width="190" alt="">
                            </th>
                        </tr>
                        <tr style="text-align: center;">
                            <th colspan="2">
                                L’EVALUATION DES BIENS De CONSIDER NATIONAL PAR REGION :
                            </th>
                        </tr>
                        <td class="column left" >
                            PAYE:
                            @if ($ilot->proprietaire->paye_name)
                                {{$ilot->proprietaire->paye_name }}
                            @else
                                il n'y a pas paye
                            @endif
                        </td>

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

function imprimerTableau() {
    var table = document.getElementById("tableToPrint");
    var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write('<html><head><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"><style>@media print {.qr_code {display: block !important;} .bordered-cell {border: 2px solid black;padding: 5px;}}</style></head><body onload="window.print()">' + table.outerHTML + '</body></html>');
        newWin.document.close();
        setTimeout(function () {
            window.print();
            // newWin.close();
        }, 10);
}

</script>
@endsection
