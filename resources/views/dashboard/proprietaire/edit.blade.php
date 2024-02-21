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
            <form action="{{ route('dashboard.proprietaires.update', 'test') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $proprietaire->pe_num }}" class="form-control">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Num_ilot" class="mr-sm-2">Numéro de l'îlot :</label>
                            <select class="form-control" name="Num_ilot">
                                <option disabled value="{{ $proprietaire->Num_ilot }}">{{  $proprietaire->Num_ilot }}</option>
                                @foreach ( $ilotOptions as $ilot)
                                    <option value="{{ $ilot }}">{{ $ilot }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Denomination_fr" class="mr-sm-2">Dénomination (fr) :</label>
                            <input type="text" class="form-control" name="Denomination_fr" value="{{ $proprietaire->Denomination_fr }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Statut" class="mr-sm-2">Statut :</label>
                            <select class="form-control" name="Statut">
                                <option disabled value="{{ $proprietaire->Statut }}">{{   $proprietaire->Statut }}</option>
                                @foreach ( $anx_statut as $anx_statut)
                                    <option value="{{ $anx_statut }}">{{ $anx_statut }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Tutelle" class="mr-sm-2">Tutelle :</label>
                            <select class="form-control" name="Tutelle">
                                <option disabled value="{{ $proprietaire->Tutelle }}">{{   $proprietaire->Tutelle }}</option>
                                @foreach ( $anx_tutelle as $anx_tutelle)
                                    <option value="{{ $anx_tutelle }}">{{ $anx_tutelle }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txt_creation" class="mr-sm-2">Texte de création :</label>
                            <select class="form-control" name="txt_creation">
                                <option disabled value="{{ $proprietaire->txt_creation }}">{{ $proprietaire->txt_creation }}</option>
                                @foreach ( $anx_text_creati as $anx_text_creati)
                                    <option value="{{ $anx_text_creati }}">{{ $anx_text_creati }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Decision_affectation" class="mr-sm-2">Décision d'affectation :</label>
                            <select class="form-control" name="Decision_affectation">
                                <option disabled value="{{ $proprietaire->Decision_affectation }}">{{ $proprietaire->Decision_affectation }}</option>
                                @foreach ( $deciaffect as $deciaffect)
                                    <option value="{{ $deciaffect }}">{{ $deciaffect }}</option>
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