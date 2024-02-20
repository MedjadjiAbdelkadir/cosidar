<div class="modal fade" id="showBienModal{{ $ilot->Num_ilot }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Situation de L'immeuble
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h4>Détails de l'ilot</h4>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Numéro d'ilot</label>
                            <input type="text"  name="N_ilot" class="form-control" value="{{  $ilot->N_ilot  }}" required placeholder="Enter Numéro d'ilot">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Âge</label>
                            <input type="text" class="form-control" name="Age" value="{{  $ilot->Age  }}" placeholder="Enter Âge">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Denomination de l'ilot</label>
                            <input type="text" class="form-control" name="Denom_Ilot" value="{{  $ilot->Denom_Ilot  }}" required placeholder="Enter Denomination de l'ilot">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Intitulé d'entretien</label>
                            @switch($ilot->intit_Entretien)
                                @case(1)
                                    <input type="text" class="form-control" value="1-BON ETAT">
                                    @break
                                @case(2)
                                    <input type="text" class="form-control" value="2-ASSEZ BON ETAT">
                                    @break
                                @case(3)
                                    <input type="text" class="form-control" value="3-VETUSTE">
                                    @break
                                @case(4)
                                    <input type="text" class="form-control" value="4-NON RENSEIGNIE">
                                    @break
                                @default
                                    <input type="text" class="form-control" value="Non select">
                            @endswitch
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Nature</label>
                            @switch($ilot->intit_Entretien)
                                @case(0)
                                    <input type="text" class="form-control" value="0-NON RENSEIGNIE">
                                    @break
                                @case(1)
                                    <input type="text" class="form-control" value="1-IMMEUBLE ADMINISTRATIFS">
                                    @break
                                @case(2)
                                    <input type="text" class="form-control" value="2-IMMEUBLE D-HABITATION">
                                    @break
                                @case(3)
                                    <input type="text" class="form-control" value="3-IMMEUBLE A USAGE SOCIAL OU CULTURELS">
                                    @break
                                @case(12)
                                    <input type="text" class="form-control" value="12-LOCAUX COMMERCIAUX">
                                    @break
                                @case(14)
                                    <input type="text" class="form-control" value="14-LOCAUX DE SENTE">
                                    @break
                                @case(16)
                                    <input type="text" class="form-control" value="16-LOCAUX INDISTRIELS">
                                    @break
                                @case(17)
                                    <input type="text" class="form-control" value="17-LOCAUX MIXTES (ADMINISTRATIFS COMMERCIAUX ETS  )">
                                    @break
                                @case(18)
                                    <input type="text" class="form-control" value="18-LOCAUX PROFESSIONNELS">
                                    @break
                                @case(22)
                                    <input type="text" class="form-control" value="22-AUTRE">
                                    @break
                                @default
                                    <input type="text" class="form-control" value="Non select">
                            @endswitch
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Type d'enquête</label>
                            <input type="text" name="type_enquete" class="form-control" value="{{  $ilot->type_enquete  }}" placeholder="Enter Type d'enquête ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Utilisation</label>
                            <input type="text" name="Utlisation" class="form-control" value="{{  $ilot->Utlisation  }}" placeholder="Enter Utilisation ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Observation de l'enquêteur</label>
                            <input type="text" name="Observation_enqueteur" class="form-control" value="{{  $ilot->Observation_enqueteur  }}" placeholder="Enter Observation de l'enquêteur">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Rue_fr</label>
                            <input type="text" class="form-control" value="{{  $ilot->Rue_fr  }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Date de l'enquête</label>
                            <input type="date" name="date_Enquete" class="form-control" value="{{  $ilot->date_Enquete  }}" placeholder="Enter  ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Localite</label>
                            <input type="text" name="Localite" id="localite-input" value="{{  $ilot->Localite  }}" autocomplete="off" class="form-control" placeholder="Enter Localite">
                            <ul id="suggestions-list"></ul>
                            <input type="hidden" name="cord_X">
                            <input type="hidden" name="cord_y">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Numéro téléphone de l'enquêteur</label>
                            <input type="text" name="Num_enqui" class="form-control" value="{{  $ilot->Num_enqui  }}" placeholder="Enter Numéro téléphone de l'enquêteur ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Ville</label>
                            <input type="text" name="Ville" class="form-control" value="{{  $ilot->Ville  }}" placeholder="Enter Ville ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Evaluation vénale</label>
                            @switch($ilot->Int_VV)
                                @case(1)
                                    <input type="text" class="form-control" value="CELLE INDIQUEE DANS L’ACTE D’AFFECTATION">
                                    @break
                                @case(2)
                                    <input type="text" class="form-control" value="CELLE QUI RESULTE DU COUT DE REALISATION">
                                    @break
                                @case(3)
                                    <input type="text" class="form-control" value="CELLE INDIQUEE DANS L-ACTE TRANSLATIF DE PROPRIETE LORSQU-IL S’AGIT D-UN IMMEUBLE ACQUIS">
                                    @break
                                @case(4)
                                    <input type="text" class="form-control" value="LE CAS ECHEANT LA VALEUR EST DETERMINEE PAR L-ADMINISTRATION DES DOMAINES">
                                    @break
                                @case(4)
                                    <input type="text" class="form-control" value="NON RENSEIGNIE">
                                    @break
                                @default
                                    <input type="text" class="form-control" value="Non select">
                            @endswitch
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Pays</label>
                            <input type="text" class="form-control"  value="{{ $ilot->Pays }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Evaluation locative</label>
                            @switch($ilot->Int_VL)
                                @case(1)
                                    <input type="text" class="form-control" value="1-LA VALEUR RESULTE DE L-ACTE D-AFFECTATION">
                                    @break
                                @case(2)
                                    <input type="text" class="form-control" value="2-LA VALEUR RESULTE DE L’ACTE TRANSLATIF DE PROPRIETE EN CAS D-ACQUISITION OU D-ECHANGE">
                                    @break
                                @case(3)
                                    <input type="text" class="form-control" value="3-LA VALEUR EST DETERMINEE PAR LE SERVICE DES DOMAINES">
                                    @break
                                @case(4)
                                    <input type="text" class="form-control" value="4-NON RENSEIGNER">
                                    @break
                                @default
                                    <input type="text" class="form-control" value="Non select">
                            @endswitch
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Surface cadastrée</label>
                            <input type="text" name="il_surf_cadastree" value="{{  $ilot->il_surf_cadastree  }}" class="form-control" placeholder="Enter Surface cadastrée ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Montant Valeur Venale </label>
                            <input type="text" name="mantVV" value="{{  $ilot->mantVV  }}" class="form-control" placeholder="Enter Montant Valeur Venale ">
                        </div>

                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Numéro de rue</label>
                            <input type="text" name="Num_Rue" value="{{  $ilot->Num_Rue  }}" class="form-control" placeholder="Enter Numéro de rue ">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="mr-sm-2">Montant Valeur Locative</label>
                            <input type="text" class="form-control" value="{{  $ilot->mantVL  }}" name="mantVL" placeholder="Montant Valeur Locative">
                        </div>

                        @if ($ilot->image)
                            <div class="d-flex justify-content-center mx-auto">
                                <img src="{{ asset($ilot->image) }}" alt="" width="250px"/>
                            </div>
                        @endif
                    </div>
                    <br><br>
            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary " data-bs-dismiss="modal">Fermer</button>
                    </div>
        </div>
    </div>
</div>

