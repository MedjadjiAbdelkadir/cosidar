@extends('layouts.admin.master')
@section('css')

@section('title')
Dashboard
@stop
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <span class="text-danger">
                                    <i class="fa fa-users highlight-icon" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">Utilisateurs (DGDN/MAECNAE)</p>
                                <h4>{{$nombreUtilisateurs}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <span>
                                    <i class="fa fa-home highlight-icon" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">Nombre (Totale Des Biens)</p>
                                <h4>{{$nombreIlots}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <span>
                                    <i class="fa fa-building highlight-icon" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">Nombre Total des Batiments</p>
                                <h4>{{$nombreBatiments}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <span>
                                    <i class="fa fa-archive highlight-icon" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">Nombre Totale des Locaux</p>
                                <h4>{{$nombreLocaux}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <span>
                                    <i class="fa fa-users highlight-icon" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">SUPERFICIE TOTAL DES BIEN (M²)</p>
                                <h4>{{$totalSupIlots}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <span>
                                    <i class="fa fa-users highlight-icon" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">SUPERFICIE TOTALE DES BATIMENT SDHO (M²)</p>
                                <h4>{{$totalSupBatimentsSDHO}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <span>
                                    <i class="fa fa-users highlight-icon" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">UPERFICIE TOTALE DES BATIMENT(M²)</p>
                                <h4>{{$totalSupBatiments}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 mb-30">
                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="clearfix">
                            <div class="float-left">
                                <span>
                                    <i class="fa fa-users highlight-icon" aria-hidden="true"></i>
                                </span>
                            </div>
                            <div class="float-right text-right">
                                <p class="card-text text-dark">SUPERFICIE TOTALE DES LOCAUX(M²)</p>
                                <h4>{{$totalSupLocaux}}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
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
                        @if (Auth::user()->role == 'direction')
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
                        @if(Auth::user()->role == 'direction')
                            <th>
                                <select class="custom-select validation-dropdown" data-id="{{ $ilot->Num_ilot }}">
                                    <option  value="0" @if ($ilot->validation == 0) selected @endif>En attente</option>
                                    <option value="1" @if ($ilot->validation == 1) selected @endif>Validé</option>
                                </select>
                            </th>
                        @endif
                        <td>
                            {{-- href="{{ route('dashboard.ilots.vuegenerale ' , $ilot->Num_ilot) }} --}}
                            <a class="btn btn-info btn-sm" href="{{ url('/dashboard/ilots/vue-generale',$ilot->Num_ilot) }}" >
                                <i class="fa fa-eye"></i>
                            </a>

                            <button type="button" class="btn btn-sm btn-danger delete_batiment" data-toggle="modal" data-target="#deleteBienModal{{ $ilot->Num_ilot }}" data-id="{{$ilot->Num_ilot}}">
                                <i class="fa fa-trash"></i>
                            </button>

                            <button type="button" class="btn btn-success btn-sm Num_batiment" data-toggle="modal"
                                data-target="#editBienModal{{ $ilot->Num_ilot }}"  data-id="{{$ilot->Num_ilot}}" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            {{-- <button type="button" class="btn btn-sm btn-success edit_batiment" data-toggle="modal" data-target="#batimentModal" data-id="{{$batiment->Num_Bat}}">
                                <i class="fa fa-pencil-alt"></i>
                            </button>  --}}
                        </td>
                    </tr>
                    @include('dashboard.Ilots.deleted')
                    @include('dashboard.Ilots.edit')
                    {{-- @include('dashboard.Ilots.show') --}}
                    @endforeach

                </tbody>
            </table>
            {{ $ilots->links() }}
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection
