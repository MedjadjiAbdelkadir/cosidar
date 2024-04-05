<div class="modal fade" id="showInventaireModal{{$proprietaire->ilot->Num_ilot}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Détails de Inventaire
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="Num_ilot" class="mr-sm-2">Denomination de l'ilot :</label>
                        <input type="text" class="form-control" name="Num_ilot" disabled value="{{ $ilot->Denom_Ilot }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="date_pub" class="mr-sm-2">Numéro interne d'ilot :</label>
                        <input type="date" class="form-control" name="date_pub" disabled value="{{ $ilot->N_ilot }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nature_acte" class="mr-sm-2">Nature :</label>
                        <input type="text" class="form-control" name="nature_acte" disabled value="{{ $nombreBatiments }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="volume1" class="mr-sm-2">Service affictataire :</label>
                        <input type="text" class="form-control" name="volume1" value="{{ $ilot->nb_lot }}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="Construction_Acte" class="mr-sm-2">Localite :</label>
                        <input type="text" class="form-control" name="Construction_Acte" disabled value="{{ $ilot->Tot_sub_locaux }}">
                    </div>


                    <div class="form-group col-md-6">
                        <label for="Origine_Acte" class="mr-sm-2">Pays :</label>
                        <input type="text" class="form-control" name="Ref_JRN" disabled value="{{ $ilot->Int_VV }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="Ref_JRN" class="mr-sm-2">Ref_JRN :</label>
                        <input type="text" class="form-control" name="Ref_JRN" disabled value="{{ $acte->Ref_JRN }}">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="case11" class="mr-sm-2">Ville :</label>
                        <input type="text" class="form-control" name="case11" disabled value="{{ $nombreBatiments }}">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>