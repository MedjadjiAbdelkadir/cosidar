<div class="modal fade" id="editBatimentModal{{ $batiment->Num_Bat }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Edit Batiment
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form autocomplete="off" action="{{ route('dashboard.batiments.update', 'test') }}" method="POST">
                    @method('PUT')
                    @csrf
                    {{-- $batiment->Num_Bat --}}
                    <input name="batiment_id" hidden value="{{ $batiment->id }}" class="form-control">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name" class="mr-sm-2">Numéro interne du Bâtiment (bat_no) :</label>
                            <input id="name" type="text" name="name" value="{{ $batiment->bat_no }}"
                                class="form-control">
                        </div>
                    
                        <div class="form-group col-md-6">
                            <label for="Num_ilot" class="mr-sm-2">Sélectionnez un Numéro d\'îlot' :</label>
                            <select class="form-control" name="Num_ilot">
                                <option disabled value="{{ $batiment->Num_ilot }}"></option>
                                @foreach ($ilotOptions as $ilot)
                                    <option value="{{ $ilot->Num_ilot }}">{{ $ilot->N_ilot }}</option>
                                @endforeach
                            </select>
                        </div>
                      
                        <div class="form-group col-md-6">
                            <label for="Nbr_Niveau" class="mr-sm-2">Nombre de Niveaux' :</label>
                            <select class="form-control" name="Nbr_Niveau">
                                <option disabled value="{{ $batiment->Nbr_Niveau }}"></option>
                                @for ($i = 0; $i < 400; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sup_SDHO" class="mr-sm-2">Surface SDHO :</label>
                            <input type="text" class="form-control" name="sup_SDHO"
                                value="{{ $batiment->sup_SDHO }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="nom_bat" class="mr-sm-2">Nom du Bâtiment :</label>
                            <input type="text" class="form-control" name="nom_bat" value="{{ $batiment->nom_bat }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="bat_desc" class="mr-sm-2">Description du Bâtiment :</label>
                            <input type="text" class="form-control" name="bat_desc"
                                value="{{ $batiment->bat_desc }}">
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
