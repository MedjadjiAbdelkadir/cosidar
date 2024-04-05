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
    .height {
        transform: rotate(90deg);
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
                <div id="invoiceContent" class="overflow" >
                    
                    <table class="table" id="tableToPrint" >
                    <tbody>
                        <tr>
                            <th class="border" colspan="2" width="40%">
                                <h1 class="text-primary">
                                    INVENTAIRE
                                </h1>
                            </th>
                            <th class="border" colspan="2">
                                <h6 >
                                    Paye: {{ $inventaire->paye_name }}
                                </h6>
                            </th>
                        </tr>

                        <td colspan="2" >
                            @if (!is_null($proprietaire))
                                <table class="table table-bordered" width="60%">
                                    <thead>
                                        <tr>
                                            <th colspan="2">INFO PROPRIETAIRE</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th >Name</th>
                                            <th >{{ $proprietaire->Denomination_fr }} </th>
                                        </tr>
                                        <tr>
                                            <th>Nom En Clature</th>
                                            <th>{{ $proprietaire->NOMENCLATURE }}</th>
                                        </tr>
                                        <tr>
                                            <th>Utlisation</th>
                                            <th>{{ $ilot->Utlisation }}</th>
                                        </tr>
                                        <tr>
                                            <th>Adderss</th>
                                            <th>{{ $ilot->Localite }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif

                        </td>
                        <tr>
                            <th class="border" colspan="2">
                                <h6 >
                                    Denomination ilot: {{ $ilot->Denom_Ilot }}
                                </h6>
                            </th>
                        </tr>
                        <div style="position: relative;">
                            <div style="position: absolute; top:0;">
                            <table class="table table-bordered " >
                                <thead class="border-dark">
                                    <tr class="border-dark">
                                        <td>#</td>
                                        <th>Produit</th>
                                        <th>Description</th>
                                        <th>Fournisseurl </th>
                                        <th>Cout</th>
                                        <th >
                                            Garantie
                                        </th>
                                        <th>Date D'achat</th>
                                        <th>Marque</th>
                                        <th>Style</th>
                                        <th>No De Série</th>
                                        <th>Condition</th>
                                        <th>Remarques</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->Descrption }}</td>
                                        <td>
                                            {{ $fournisseur->nom }}
                                        </td>
                                        <td>{{ $product->price }}</td>
                                        <td>
                                            <span>{{ $product->garantie }}  </span>
                                            <span>{{ $product->garanDateJusq    }}</span>

                                        </td>
                                        <td>{{ $product->dateAchat }}</td>
                                        <td>{{ $product->marque }}</td>
                                        <td>{{ $product->serieNum }}</td>
                                        <td>{{ $product->id }}</td>
                                        <td>{{ $product->remarque }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </dir>
                        </div>

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
                doc.save('inventaire-'+randomId+'.pdf');
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
