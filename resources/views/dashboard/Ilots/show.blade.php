@extends('layouts.admin.master')
@section('css')

@section('title')
ORIGINE DES DROITS
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
                <li class="breadcrumb-item">ORIGINE DES DROITS</li>
                <li class="breadcrumb-item active">ORIGINE DES DROITS</li>
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
                <div class="row">
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Numéro d'ilot</label>
                        <input disabled type="text"  name="N_ilot" class="form-control" value="{{  $ilot->N_ilot  }}" required placeholder="Enter Numéro d'ilot">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Âge</label>
                        <input disabled type="text" class="form-control" name="Age" value="{{  $ilot->Age  }}" placeholder="Enter Âge">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Denomination de l'ilot</label>
                        <input disabled type="text" class="form-control" name="Denom_Ilot" value="{{  $ilot->Denom_Ilot  }}" required placeholder="Enter Denomination de l'ilot">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Intitulé d'entretien</label>
                        @switch($ilot->intit_Entretien)
                            @case(1)
                                <input disabled type="text" class="form-control" value="1-BON ETAT">
                                @break
                            @case(2)
                                <input disabled type="text" class="form-control" value="2-ASSEZ BON ETAT">
                                @break
                            @case(3)
                                <input disabled type="text" class="form-control" value="3-VETUSTE">
                                @break
                            @case(4)
                                <input disabled type="text" class="form-control" value="4-NON RENSEIGNIE">
                                @break
                            @default
                                <input disabled type="text" class="form-control" value="Non select">
                        @endswitch
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Nature</label>
                        @switch($ilot->intit_Entretien)
                            @case(0)
                                <input disabled type="text" class="form-control" value="0-NON RENSEIGNIE">
                                @break
                            @case(1)
                                <input disabled type="text" class="form-control" value="1-IMMEUBLE ADMINISTRATIFS">
                                @break
                            @case(2)
                                <input disabled type="text" class="form-control" value="2-IMMEUBLE D-HABITATION">
                                @break
                            @case(3)
                                <input disabled type="text" class="form-control" value="3-IMMEUBLE A USAGE SOCIAL OU CULTURELS">
                                @break
                            @case(12)
                                <input disabled type="text" class="form-control" value="12-LOCAUX COMMERCIAUX">
                                @break
                            @case(14)
                                <input disabled type="text" class="form-control" value="14-LOCAUX DE SENTE">
                                @break
                            @case(16)
                                <input disabled type="text" class="form-control" value="16-LOCAUX INDISTRIELS">
                                @break
                            @case(17)
                                <input disabled type="text" class="form-control" value="17-LOCAUX MIXTES (ADMINISTRATIFS COMMERCIAUX ETS  )">
                                @break
                            @case(18)
                                <input disabled type="text" class="form-control" value="18-LOCAUX PROFESSIONNELS">
                                @break
                            @case(22)
                                <input disabled type="text" class="form-control" value="22-AUTRE">
                                @break
                            @default
                                <input disabled type="text" class="form-control" value="Non select">
                        @endswitch
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Type d'enquête</label>
                        <input disabled type="text" name="type_enquete" class="form-control" value="{{  $ilot->type_enquete  }}" placeholder="Enter Type d'enquête ">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Utilisation</label>
                        <input disabled type="text" name="Utlisation" class="form-control" value="{{  $ilot->Utlisation  }}" placeholder="Enter Utilisation ">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Observation de l'enquêteur</label>
                        <input disabled type="text" name="Observation_enqueteur" class="form-control" value="{{  $ilot->Observation_enqueteur  }}" placeholder="Enter Observation de l'enquêteur">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Rue_fr</label>
                        <input disabled type="text" class="form-control" value="{{  $ilot->Rue_fr  }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Date de l'enquête</label>
                        <input disabled type="date" name="date_Enquete" class="form-control" value="{{  $ilot->date_Enquete  }}" placeholder="Enter  ">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Localite</label>
                        <input disabled type="text" name="Localite" id="localite-input" value="{{  $ilot->Localite  }}" autocomplete="off" class="form-control" placeholder="Enter Localite">
                        <ul id="suggestions-list"></ul>
                        <input disabled type="hidden" name="cord_X">
                        <input disabled type="hidden" name="cord_y">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Numéro téléphone de l'enquêteur</label>
                        <input disabled type="text" name="Num_enqui" class="form-control" value="{{  $ilot->Num_enqui  }}" placeholder="Enter Numéro téléphone de l'enquêteur ">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Ville</label>
                        <input disabled type="text" name="Ville" class="form-control" value="{{  $ilot->Ville  }}" placeholder="Enter Ville ">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Evaluation vénale</label>
                        @switch($ilot->Int_VV)
                            @case(1)
                                <input disabled type="text" class="form-control" value="CELLE INDIQUEE DANS L’ACTE D’AFFECTATION">
                                @break
                            @case(2)
                                <input disabled type="text" class="form-control" value="CELLE QUI RESULTE DU COUT DE REALISATION">
                                @break
                            @case(3)
                                <input disabled type="text" class="form-control" value="CELLE INDIQUEE DANS L-ACTE TRANSLATIF DE PROPRIETE LORSQU-IL S’AGIT D-UN IMMEUBLE ACQUIS">
                                @break
                            @case(4)
                                <input disabled type="text" class="form-control" value="LE CAS ECHEANT LA VALEUR EST DETERMINEE PAR L-ADMINISTRATION DES DOMAINES">
                                @break
                            @case(4)
                                <input disabled type="text" class="form-control" value="NON RENSEIGNIE">
                                @break
                            @default
                                <input disabled type="text" class="form-control" value="Non select">
                        @endswitch
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Pays</label>
                        <input disabled type="text" class="form-control"  value="{{ $ilot->Pays }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Evaluation locative</label>
                        @switch($ilot->Int_VL)
                            @case(1)
                                <input disabled type="text" class="form-control" value="1-LA VALEUR RESULTE DE L-ACTE D-AFFECTATION">
                                @break
                            @case(2)
                                <input disabled type="text" class="form-control" value="2-LA VALEUR RESULTE DE L’ACTE TRANSLATIF DE PROPRIETE EN CAS D-ACQUISITION OU D-ECHANGE">
                                @break
                            @case(3)
                                <input disabled type="text" class="form-control" value="3-LA VALEUR EST DETERMINEE PAR LE SERVICE DES DOMAINES">
                                @break
                            @case(4)
                                <input disabled type="text" class="form-control" value="4-NON RENSEIGNER">
                                @break
                            @default
                                <input disabled type="text" class="form-control" value="Non select">
                        @endswitch
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Surface cadastrée</label>
                        <input disabled type="text" name="il_surf_cadastree" value="{{  $ilot->il_surf_cadastree  }}" class="form-control" placeholder="Enter Surface cadastrée ">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Montant Valeur Venale </label>
                        <input disabled type="text" name="mantVV" value="{{  $ilot->mantVV  }}" class="form-control" placeholder="Enter Montant Valeur Venale ">
                    </div>

                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Numéro de rue</label>
                        <input disabled type="text" name="Num_Rue" value="{{  $ilot->Num_Rue  }}" class="form-control" placeholder="Enter Numéro de rue ">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="mr-sm-2">Montant Valeur Locative</label>
                        <input disabled type="text" class="form-control" value="{{  $ilot->mantVL  }}" name="mantVL" placeholder="Montant Valeur Locative">
                    </div>

                    @if ($ilot->image)
                        <div class="d-flex justify-content-center mx-auto">
                            <img src="{{ asset($ilot->image) }}" alt="" width="250px"/>
                        </div>
                    @endif
                </div>
                {{-- Start create acte --}}
                <h4> acte  d'ilot :</h4>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="date_pub" class="mr-sm-2">Date de publication :</label>
                        <input type="date" class="form-control" value="{{ $ReferenceActe->date_pub }}" disabled >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nature_acte" class="mr-sm-2">Nature d'acte :</label>
                        <input disabled type="text" class="form-control" value="{{ $ReferenceActe->nature_acte }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="volume1" class="mr-sm-2">Volume :</label>
                        <input type="text" class="form-control" value="{{ $ReferenceActe->volume1 }}" name="volume1" disabled >
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Construction_Acte" class="mr-sm-2">Construction d'acte :</label>
                        <input disabled type="text" class="form-control" value="{{ $ReferenceActe->Construction_Acte }}" disabled>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="Origine_Acte" class="mr-sm-2">Origine_Acte :</label>
                        <input type="text" value="{{ $ReferenceActe->Origine_Acte }}" class="form-control" disabled>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="case11" class="mr-sm-2">Case :</label>
                        <input type="text" class="form-control" value="{{ $ReferenceActe->case11 }}"  disabled>
                    </div>
                </div>
                {{-- end create acte --}}
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('dashboard.ilots.index') }}" class="btn btn-secondary mx-2">Retour</a>
                        <form action="{{ route('dashboard.batiments.create') }}" method="GEt">
                            <input hidden type="text" name="ilot_id" value="{{ $ilot->id }}">
                            <button type="submit" class="btn btn-success mx-2">Ajoute un Batiment</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')

@endsection

