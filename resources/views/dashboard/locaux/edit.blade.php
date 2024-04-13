<div class="modal fade" id="editLocauxModal{{$local->lot_no}}">" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Edit Locaux
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form autocomplete="off" action="{{ route('dashboard.locaux.update', 'test') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" value="{{ $local->lot_no }}" class="form-control">

                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="Num_ilot" class="mr-sm-2">Numéro de l'îlot :</label>
                            <select class="form-control" name="Num_ilot">
                                <option disabled value="{{ $local->Num_ilot }}">{{ $local->Num_ilot }}</option>
                                @foreach ( $ilotOptions as $ilot)
                                    <option value="{{ $ilot->Num_ilot }}">{{ $ilot->N_ilot }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="Num_Bat" class="mr-sm-2">Numéro du Bâtiment :</label>
                            <select class="form-control" name="Num_Bat">
                                <option disabled value="{{ $local->Num_Bat }}">{{ $local->Num_Bat }}</option>
                                @foreach ( $batimentOptions as $Num_Bat)
                                    <option value="{{ $Num_Bat->Num_Bat }}">{{ $Num_Bat->bat_no }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Nature_Loc" class="mr-sm-2">Nature du Local :</label>
                            <select class="form-control" name="Nature_Loc">
                                <option value="{{ $local->Nature_Loc }}">{{ $local->nature_loc }}</option>
                                @foreach ( $nature_locaux as $Nature_Loc)
                                <option value="{{ $Nature_Loc->NNatLoc }}">{{ $Nature_Loc->Intitule }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="lot_surface" class="mr-sm-2">Surface du Lot :</label>
                            <input type="text" class="form-control" name="lot_surface" value="{{ $local->lot_surface }}">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="nb_piece" class="mr-sm-2">Nombre de Pièces :</label>
                            <input type="text" class="form-control" name="nb_piece" value="{{ $local->nb_piece }}">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="nb_indiv" class="mr-sm-2">Nombre d'Individus :</label>
                            <input type="text" class="form-control" name="nb_indiv" value="{{ $local->nb_indiv }}">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="droit_charge" class="mr-sm-2">Droit de Charge :</label>
                            <input type="text" class="form-control" name="droit_charge" value="{{ $local->droit_charge }}">
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