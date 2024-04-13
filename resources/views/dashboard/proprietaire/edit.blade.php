<div class="modal fade" id="editProprietaireModal{{$proprietaire->pe_num}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Éditer le Propriétaire
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form autocomplete="off" action="{{ route('dashboard.proprietaires.update', 'test') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $proprietaire->pe_num }}" class="form-control">

                    
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Denomination_fr" class="mr-sm-2">Dénomination (fr) :</label>
                            <input type="text" class="form-control" name="Denomination_fr" value="{{ $proprietaire->Denomination_fr }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Statut" class="mr-sm-2">Statut :</label>
                            <select class="form-control" name="Statut">
                                <option selected value="{{ $proprietaire->statut?->id }}">{{   $proprietaire->statut?->Intitule }}</option>
                                @foreach ( $anx_statut as $anx_statut)
                                {{-- <p>{{ $anx_statut }}</p> --}}
                                    <option value="{{ $anx_statut->id }}">{{ $anx_statut->Intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Tutelle" class="mr-sm-2">Tutelle :</label>
                            <select class="form-control" name="Tutelle">
                                <option selected value="{{ $proprietaire->tutelle?->bi_natjur }}">{{   $proprietaire->tutelle?->Intitule }}</option>
                                @foreach ( $anx_tutelle as $anx_tutelle)
                                    <option value="{{ $anx_tutelle->bi_natjur }}">{{ $anx_tutelle->Intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txt_creation" class="mr-sm-2">Texte de création :</label>
                            <select class="form-control" name="txt_creation">
                                <option selected value="{{ $proprietaire->anx_text_creati?->bi_natjur }}">{{ $proprietaire->anx_text_creati?->Intitule }}</option>
                                @foreach ( $anx_text_creati as $anx_text_creati)
                                    <option value="{{ $anx_text_creati->bi_natjur }}">{{ $anx_text_creati->Intitule }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Decision_affectation" class="mr-sm-2">Décision d'affectation :</label>
                            <select class="form-control" name="Decision_affectation">
                                <option disabled value="{{ $proprietaire->deciaffect?->id }}">{{ $proprietaire->deciaffect?->Intitule_fr }}</option>
                                @foreach ( $deciaffect as $deciaffect)
                                    <option value="{{ $deciaffect->id }}">{{ $deciaffect->Intitule_fr }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Date_Decision_affectation" class="mr-sm-2">Date de décision d'affectation :</label>
                            <input type="date" class="form-control" name="Date_Decision_affectation" value="{{ $proprietaire->Date_Decision_affectation }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Date_txt_creation" class="mr-sm-2">Date de création :</label>
                            <input type="date" class="form-control" name="Date_txt_creation" value="{{ \Carbon\Carbon::parse($proprietaire->Date_txt_creation)->format('Y-m-d') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>