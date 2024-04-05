@extends('layouts.admin.master')
@section('css')

@section('title')
List Fournisseur
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Fournisseurs</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Dashboard</a></li>
                <li class="breadcrumb-item active">List Fournisseurs</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if (auth()->user()->role == 'user_direction' || auth()->user()->role == 'user_sous_direction' || auth()->user()->role == 'user_consultation_direction')
                    <a class="btn btn-info btn-sm" href="{{ route('dashboard.fournisseurs.create') }}">
                        <i class="fa fa-plus"></i>
                        AJOUTER Fournisseur
                    </a>
                @endif
                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <td>Nom Ilot</td>
                                <th>Nom</th>
                                <th>Prenom</th>
                                <th>Address</th>
                                <th>Telephone</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fournisseurs as $key => $fournisseur)
                            {{-- @foreach ($batimentas;$batiment) --}}
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                {{-- inventaire --}}
                                <td>
                                    @if (isset($fournisseur->inventaire->ilot))
                                    {{$fournisseur->inventaire->ilot->N_ilot}}

                                    @else
                                    No Ilot
                                    @endif
                                    {{-- @isset($fournisseur->inventaire->ilot)

                                    {{$fournisseur->inventaire->ilot->N_ilot}}
                                    @endisset --}}

                                </td>

                                {{-- <td>{{$fournisseur->inventaire->ilot->N_ilot }}</td> --}}
                                <td>{{$fournisseur->nom }}</td>
                                <td>{{$fournisseur->prenom }}</td>
                                <td>{{$fournisseur->address }}</td>
                                <td>{{$fournisseur->numero_telephone }}</td>
                                <td>{{ $fournisseur->email }}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#showFournisseurModal{{$fournisseur->id}}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $fournisseurs->links() }}
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
