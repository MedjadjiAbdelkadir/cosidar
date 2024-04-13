<div class="modal fade" id="editActeModal{{$acte->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Modifier un Acte
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form autocomplete="off" action="{{ route('dashboard.actes.update' , 'test') }}" method="POST">
                    @csrf
                    @method('PATH')
                    {{-- $batiment->Num_Bat --}}
                    <input type="hidden" name="id" value="{{ $acte->id }}" class="form-control">

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Num_ilot" class="mr-sm-2">Changer le numéro de l'îlot :</label>
                            <select class="form-control" name="Num_ilot">
                                <option disabled value="{{ $acte->Num_ilot }}">{{ $acte->Num_ilot }}</option>
                                @foreach ( $ilotOptions as $ilot)
                                    <option value="{{ $ilot }}">{{ $ilot }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="date_pub" class="mr-sm-2">Date de publication :</label>
                            <input type="date" class="form-control" name="date_pub" value="{{ $acte->date_pub }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nature_acte" class="mr-sm-2">Nature d'acte :</label>
                            <select class="form-control" name="nature_acte">
                                <option disabled value="{{ $acte->nature_acte }}"> {{ $acte->nature_acte }}</option>
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
                            <input type="text" class="form-control" name="volume1" value="{{ $acte->volume1 }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Construction_Acte" class="mr-sm-2">Construction d'acte :</label>
                            <select class="form-control" name="Construction_Acte">
                                <option disabled value="{{ $acte->Construction_Acte }}"> {{ $acte->Construction_Acte }}</option>
                                <option value="lorsque les constructions ont été réalisées après acquisition du terrain d\'assiette">lorsque les constructions ont été réalisées après acquisition du terrain d\'assiette</option>
                                <option value="lorsque les constructions ont été affectées avec le terrain">lorsque les constructions ont été affectées avec le terrain</option>
                                <option value="Non renseigné">Non renseigné</option>
                            </select>
                        </div>


                        <div class="form-group col-md-6">
                            <label for="Origine_Acte" class="mr-sm-2">Origine_Acte :</label>
                            <select class="form-control" name="Origine_Acte">
                                <option disabled value="{{ $acte->Origine_Acte }}"> {{ $acte->Origine_Acte }}</option>
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
                            <input type="text" class="form-control" name="Ref_JRN" value="{{ $acte->Ref_JRN }}">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="case11" class="mr-sm-2">Case11 :</label>
                            <input type="text" class="form-control" name="case11" value="{{ $acte->case11 }}">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Update</button>
            </div>
            </form>

        </div>
    </div>
</div>