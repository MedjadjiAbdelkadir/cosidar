<div class="modal fade" id="createProprietaireModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Créer un Proprietaire
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dashboard.proprietaires.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        {{-- <div class="form-group col-md-6">
                            <label for="Num_ilot" class="mr-sm-2">Numéro de l'îlot :</label>
                            <select class="form-control" name="Num_ilot">
                                <option disabled >Select Numéro de l'îlot</option>
                                @foreach ( $ilotOptions as $ilot)
                                    <option value="{{ $ilot }}">{{ $ilot }}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label for="Denomination_fr" class="mr-sm-2">Dénomination (fr) :</label>
                            <input type="text" class="form-control" name="Denomination_fr">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Statut" class="mr-sm-2">Statut :</label>
                            <select class="form-control" name="Statut">
                                <option disabled >Select Status</option>
                                @foreach ( $anx_statut as $anx_statut)
                                    <option value="{{ $anx_statut }}">{{ $anx_statut }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Tutelle" class="mr-sm-2">Tutelle :</label>
                            <select class="form-control" name="Tutelle">
                                <option disabled >Select Tutelle</option>                                
                                @foreach ( $anx_tutelle as $anx_tutelle)
                                    <option value="{{ $anx_tutelle }}">{{ $anx_tutelle }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="txt_creation" class="mr-sm-2">Texte de création :</label>
                            <select class="form-control" name="txt_creation">
                                <option disabled >Select Texte de création</option>
                                @foreach ( $anx_text_creati as $anx_text_creati)
                                    <option value="{{ $anx_text_creati }}">{{ $anx_text_creati }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Decision_affectation" class="mr-sm-2">Décision d'affectation :</label>
                            <select class="form-control" name="Decision_affectation">
                                <option disabled >Select Décision d'affectation</option>
                                @foreach ( $deciaffect as $deciaffect)
                                    <option value="{{ $deciaffect }}">{{ $deciaffect }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Date_Decision_affectation" class="mr-sm-2">Date de décision d'affectation :</label>
                            <input type="date" class="form-control" name="Date_Decision_affectation">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Date_txt_creation" class="mr-sm-2">Date de création :</label>
                            <input type="date" class="form-control" name="Date_txt_creation">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </form>

        </div>
    </div>
</div>