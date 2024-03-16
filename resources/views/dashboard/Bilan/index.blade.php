@extends('layouts.admin.master')
@section('css')

@section('title')
Activité utilisateurs
@stop
@endsection

@section('page-header')
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">Bilan du Production</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">Dashboard</a></li>
                <li class="breadcrumb-item active">BILAN</li>
            </ol>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    {{-- @include('dashboard.user.create') --}}
    <div class="col-md-12 mb-30">
        <div class="card card-statistics">
            <div class="card-body">
                <h3 class="mb-0">
                    @if(Auth::user()->parent_id == 0)
                        {{ __('Activité utilisateurs') }}
                    @else
                        {{ __('Activité utilisateurs') }}
                    @endif
                </h3>
            </div>
            <div class="card-body">
                <form id="dateFilterForm" class="mb-3">
                    @csrf
                    <div class="row" >
                        <div class="form-group col-md-4">
                            <label for="startDate">Date de début</label>
                            <input type="date" class="form-control" id="startDate" name="startDate">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="endDate">Date de fin</label>
                            <input type="date" class="form-control" id="endDate" name="endDate">
                        </div>
                        <div class="form-group col-md-4 mt-3">
                            <button type="submit" class="btn btn-primary mt-4">Filtrer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="card card-statistics ">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable-basic" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th>Nom de l'utilisateur</th>
                                <th>Rôle de l'utilisateur</th>
                                <th>Nombre d'activités</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activityUsers as $user )
                            {{-- @foreach ($batimentas;$batiment) --}}
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $user->user_name }}</td>
                                <td>{{ $user->user_role }}</td>
                                <td>{{ $user->activity_count }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-neutral Num_batiment"  data-id="{{$user->user_id}}">
                                        <i class="fa fa-eye"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $activityUsers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('#dateFilterForm').submit(function (event) {
            event.preventDefault();
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();

            $.ajax({
                url: '{{ route('dashboard.ilots.filterActivityByDate') }}',
                method: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    startDate: startDate,
                    endDate: endDate
                },
                success: function (data) {
                     // Mettez à jour le tableau avec les données filtrées ici
                    var tableBody = $('#datatable-basic tbody');
                    tableBody.empty(); // Efface le contenu actuel du tableau
                    if (data.length > 0) {
                        data.forEach(function (user) {
                            tableBody.append(
                                '<tr>' +
                                '<td>' + user.user_name + '</td>' +
                                '<td>' + user.user_role + '</td>' +
                                '<td>' + user.activity_count + '</td>' +
                                '</tr>'
                            );
                        });
                    } else {
                        tableBody.append('<tr><td colspan="3">Aucune donnée correspondante trouvée</td></tr>');
                    }
                    // Vous pouvez également mettre à jour le graphique ici si nécessaire
                    console.log(data);
                },
                error: function (xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });


    $(".details_activity").click(function(){
        id_user = ($(this).data('id'));
        var url = "{{ url('/') }}/ilots/" + id_user + "/getIliotsByIdUser";
        window.location.href = url;
    });
</script>

@endsection
