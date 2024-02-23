@extends('layouts.admin.master')
@section('css')

@section('title')
Inventaires
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Dashboard</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Dashboard</a></li>
                <li class="breadcrumb-item active">Inventaires</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    @include('dashboard.inventaire.create')

    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <button type="button"class="button x-small"  data-toggle="modal" data-target="#createInventaireModal">
                    Create Inventaire
                </button>
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ __('DENOMINATION') }}</th>
                                <th>{{ __('NATURE') }}</th>
                                <th>{{ __('service affectataire') }}</th>
                                <th>{{ __('LOCALITE') }}</th>
                                <th>{{ __('PAYS') }}</th>
                                <th>{{ __('ville') }}</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $natureList = [
                                '0' => '0-NON RENSEIGNIE',
                                '1' => '1-IMMEUBLE ADMINISTRATIFS',
                                '2' => '2-IMMEUBLE D-HABITATION',
                                '3' => '3-IMMEUBLE A USAGE SOCIAL OU CULTURELS',
                                '12' => '12-LOCAUX COMMERCIAUX',
                                '14' => '14-LOCAUX DE SENTE',
                                '16' => '16-LOCAUX INDISTRIELS',
                                '17' => '17-LOCAUX MIXTES (ADMINISTRATIFS COMMERCIAUX ETS)',
                                '18' => '18-LOCAUX PROFESSIONNELS',
                                '22' => '22-AUTRE'
                            ];
                        @endphp
                            @foreach ($Ilots as $key => $Ilot)
                            {{-- @foreach ($batimentas;$batiment) --}}
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                {{-- <td>{{$proprietaire->ilot }}</td> --}}

                                <td>{{$Ilot->Denom_Ilot }}</td>
                                <td>{{$natureList[$Ilot->Nature] }}</td>
                                <td>{{$Ilot->proprietaire->Denomination_fr }}</td>
                                <td>{{$Ilot->Localite }}</td>
                                <td>{{$Ilot->Pays }}</td>
                                <td>{{$Ilot->Ville }}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#showInventaireModal{{$Ilot->Num_ilot}}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </td>
                                {{-- @if($proprietaire->Nature)
                                    <td>{{ $natureList[$proprietaire->ilot->Nature] ?? 'Unknown' }}</td>
                                @else
                                    <td>No ilot associated</td>
                                @endif
                                <td>{{ $proprietaire->Denomination_fr }}</td>
                                <td>{{ $proprietaire->ilot->Localite }}</td>
                                <td>{{ $proprietaire->ilot->Pays }}</td>
                                <td>{{ $proprietaire->ilot->Ville }}</td> --}}

                                {{-- <td>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#showInventaireModal{{$proprietaire->ilot->Num_ilot}}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </td> --}}
                            </tr>
                            {{-- @include('dashboard.inventaire.show') --}}

                            @endforeach

                        </tbody>
                    </table>
                    {{ $Ilots->links() }}                                            
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = $('#datatable-basic').DataTable();
        
            $('#pays_placeholder').on('change', function () {
                var selectedValue_pays = $(this).val();
                console.log(selectedValue_pays);
                table.column(5).search(selectedValue_pays).draw();
            });
        });
    </script>
   <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = $('#datatable-basic').DataTable();
            $('#nature_filter').on('change', function () {
                var selectedOption = $('#nature_filter').find(':selected');
                var selectedValue_nature = selectedOption.data('nom');
                selectedValue_nature = selectedValue_nature ? selectedValue_nature.toLowerCase() : '';
                console.log('Selected Nature Filter Value:', selectedValue_nature);
                table.column(3).search(selectedValue_nature).draw();
            });
       });
    </script>
@endsection
