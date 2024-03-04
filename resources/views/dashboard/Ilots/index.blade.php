@extends('layouts.admin.master')
@section('css')

@section('title')
LISTE DES ILOTS
@stop
@endsection

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Liste des Biens</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="default-color">Dashboard</a></li>
                <li class="breadcrumb-item active">Ilots</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    {{-- @include('dashboard.user.create') --}}
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    @if (auth()->user()->role == 'admin_direction' || auth()->user()->role == 'admin_sous_direction')
                        <div>
                            <button type="button" class="btn btn-primary x-small filter-ilots" data-validation="all" >
                                Tous ({{ count($ilots) }})
                            </button>
                            <button type="button" class="btn btn-success x-small filter-ilots" data-validation="1" >
                                Validés ({{ count($ilots->where('validation', 1)) }})
                            </button>
                            <button type="button" class="btn btn-danger x-small filter-ilots" data-validation="0" >
                                En Attents ({{ count($ilots->where('validation', 0)) }})
                            </button>
                        </div>
                    @endif
                    @if (auth()->user()->role == 'user_direction' || auth()->user()->role == 'user_sous_direction' || auth()->user()->role == 'user_consultation_direction')
                        <div>
                            <a href="{{ route('dashboard.ilots.create') }}" class="button x-small" >
                                Créer Bien
                            </a>
                        </div>
                    @endif
                    </div>

                <br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th>N° BIEN</th>
                                <th>DEnOMINATION</th>
                                <th>NATURL</th>
                                <th>UTILISATION</th>
                                <th>LOCALITE</th>
                                @if (Auth::user()->role == 'admin_direction')
                                    <th>VALIDATION</th>
                                @endif
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ilots as $key => $ilot)
                            {{-- @foreach ($batimentas;$batiment) --}}
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $ilot->Num_ilot }}</td>
                                <td>{{ $ilot->Denom_Ilot }}</td>
                                <td>{{ $ilot->nature_nom }}</td>
                                <td>{{ $ilot->Utlisation }}</td>
                                <td>{{ $ilot->Localite }}</td>
                                @if(auth()->user()->role == 'admin_direction' || auth()->user()->role == 'admin_sous_direction')
                                    <th>
                                        <select class="custom-select validation-dropdown" data-id="{{ $ilot->Num_ilot }}">
                                            <option  value="0" @if ($ilot->validation == 0) selected @endif>En attente</option>
                                            <option value="1" @if ($ilot->validation == 1) selected @endif>Validé</option>
                                        </select>
                                    </th>
                                @endif
                                <td>
                                    @if (auth()->user()->role == 'admin_direction' || auth()->user()->role == 'admin_sous_direction')
                                        <a class="btn btn-info btn-sm" href="{{ route('dashboard.ilots.show' , $ilot->Num_ilot) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-secondary addNote" data-toggle="modal" data-target="#noteBienModal{{ $ilot->id }}" data-id="{{$ilot->id}}">
                                            <i class="fa fa-sticky-note"></i>
                                        </button>
                                    @else
                                        <a class="btn btn-info btn-sm" href="{{ route('dashboard.ilots.show' , $ilot->Num_ilot) }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        @if (!is_null($ilot->notes))
                                            <button type="button" class="btn btn-sm btn-outline-secondary addNote" data-toggle="modal" data-target="#noteBienModal{{ $ilot->id }}" data-id="{{$ilot->id}}">
                                                <i class="fa fa-sticky-note"></i>
                                            </button>
                                        @endif
                                        <button type="button" class="btn btn-sm btn-danger delete_batiment" data-toggle="modal" data-target="#deleteBienModal{{ $ilot->Num_ilot }}" data-id="{{$ilot->Num_ilot}}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        <a href="{{ route('dashboard.ilots.edit', $ilot->id) }}" class="btn btn-success btn-sm Num_batiment"
                                            title="Edit"> <i class="fa fa-edit"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @include('dashboard.Ilots.deleted')
                            @include('dashboard.Ilots.notes')
                            {{-- @include('dashboard.Ilots.show') --}}
                            @endforeach

                        </tbody>
                    </table>
                    {{ $ilots->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function()
    {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        // Gestionnaire d'événements pour les boutons de filtre
        $('.filter-ilots').on('click', function() {
            var validation = $(this).data('validation');
            console.log(validation);
            if (validation == 'all') {
                if ($.fn.DataTable.isDataTable('#datatable')) {
                    $('#datatable').DataTable().destroy();
                    table.ajax.reload();
                }
            }
            else{
                if ($.fn.DataTable.isDataTable('#datatable')) {
                    $('#datatable').DataTable().destroy();
                }
                var table = $('#datatable').DataTable({
                    // Spécifiez vos options DataTables ici
                    columnDefs: [
                        {
                            targets: [6], // Indiquez l'index de la colonne masquée
                            visible: false // Rendre la colonne masquée invisible
                        }
                    ]
                });


                    // Utilisez la recherche avancée pour filtrer les données en fonction de la colonne masquée
                    table.column(6).search(validation).draw(); // Colonne 6 correspond à la colonne masquée "Validation"
                // table.column(6).search(validation).draw();
            }
        });

        // Change
        $(document).on('change', '.validation-dropdown', function()
        {
            var ilotId = $(this).data('id');
            var newValidation = $(this).val();
            console.log(ilotId, newValidation);

            $.ajax({
                type: 'POST',
                url: "{{ route('dashboard.ilots.updateValidation', ':ilotId') }}".replace(':ilotId', ilotId),
                data: {validation: newValidation},
                success: function(response){
                    Swal.fire({
                        title: "succès",
                        text: "Validation mise à jour avec succès",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 3000
                    }).then((result) => {
                        location.reload();
                    });
                }
            });

        });

    /* End ajax */
    });

</script>
@endsection
