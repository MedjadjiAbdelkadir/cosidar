<div class="modal fade" id="createActeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Créer un Acte
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form autocomplete="off" action="{{ route('dashboard.actes.store') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Num_ilot" class="mr-sm-2">Numéro de l'îlot :</label>
                            <select class="form-control" name="Num_ilot">
                                <option disabled value="">Select Numéro de l'îlot</option>
                                @foreach ( $ilotOptions as $ilot)
                                    <option value="{{ $ilot }}">{{ $ilot }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date_pub" class="mr-sm-2">Date de publication :</label>
                            <input type="date" class="form-control" name="date_pub">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nature_acte" class="mr-sm-2">Nature d'acte :</label>
                            <select class="form-control" name="nature_acte">
                                <option disabled value="">Select Nature d'acte</option>
                                <option value="Loi">Loi</option>
                                <option value="Décret">Décret</option>
                                <option value="Arrêté">Arrêté</option>
                                <option value="Acte">Acte</option>
                                <option value="Convention bilatérale">Convention bilatérale</option>
                                <option value="Non renseigné">Non renseigné</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="volume1" class="mr-sm-2">Volume1 :</label>
                            <input type="text" class="form-control" name="volume1">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Construction_Acte" class="mr-sm-2">Construction d'acte :</label>
                            <select class="form-control" name="Construction_Acte">
                                <option disabled >Select Construction d'acte</option>
                                <option value="lorsque les constructions ont été réalisées après acquisition du terrain d\'assiette">lorsque les constructions ont été réalisées après acquisition du terrain d\'assiette</option>
                                <option value="lorsque les constructions ont été affectées avec le terrain">lorsque les constructions ont été affectées avec le terrain</option>
                                <option value="Non renseigné">Non renseigné</option>
                            </select>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="Origine_Acte" class="mr-sm-2">Origine_Acte :</label>
                            <select class="form-control" name="Origine_Acte">
                                <option disabled >Select Origine Acte</option>
                                <option value="Non renseigner">Non renseigner</option>
                                <option value="Don">Don</option>
                                <option value="Cession à l-Etat à titre gratuit">Cession à l-Etat à titre gratuit</option>
                                <option value="Acquisition">Acquisition</option>
                                <option value="Réalisation">Réalisation</option>
                                <option value="Échange">Échange</option>
                                <option value="Bail ou convention">Bail ou convention</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="Ref_JRN" class="mr-sm-2">Ref_JRN :</label>
                            <input type="text" class="form-control" name="Ref_JRN">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="case11" class="mr-sm-2">Case11 :</label>
                            <input type="text" class="form-control" name="case11">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>