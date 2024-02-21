<div class="modal fade" id="createLocauxModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Ajouter Locaux
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('dashboard.locaux.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="Num_ilot" class="mr-sm-2">Numéro de l'îlot :</label>
                            <select class="form-control" name="Num_ilot">
                                <option disabled >Select Numéro de l'îlot</option>
                                @foreach ( $ilotOptions as $ilot)
                                    <option value="{{ $ilot }}">{{ $ilot }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="Num_Bat" class="mr-sm-2">Numéro du Bâtiment :</label>
                            <select class="form-control" name="Num_Bat">
                                <option disabled>Select Numéro du Bâtiment</option>
                                @foreach ( $ilotOptions as $Num_Bat)
                                    <option value="{{ $Num_Bat }}">{{ $Num_Bat }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Nature_Loc" class="mr-sm-2">Nature du Local :</label>
                            <select class="form-control" name="Nature_Loc">
                                <option disabled>Select Nature du Local</option>
                                @foreach ( $nature_locaux as $Nature_Loc)
                                    <option value="{{ $Nature_Loc }}">{{ $Nature_Loc }}</option>
                                @endforeach 
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="lot_surface" class="mr-sm-2">Surface du Lot :</label>
                            <input type="text" class="form-control" name="lot_surface" >
                        </div>

                        <div class="form-group col-md-3">
                            <label for="nb_piece" class="mr-sm-2">Nombre de Pièces :</label>
                            <input type="text" class="form-control" name="nb_piece" >
                        </div>

                        <div class="form-group col-md-3">
                            <label for="nb_indiv" class="mr-sm-2">Nombre d'Individus :</label>
                            <input type="text" class="form-control" name="nb_indiv">
                        </div>

                        <div class="form-group col-md-3">
                            <label for="droit_charge" class="mr-sm-2">Droit de Charge :</label>
                            <input type="text" class="form-control" name="droit_charge">
                        </div>
                    </div>
                    <br><br>
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