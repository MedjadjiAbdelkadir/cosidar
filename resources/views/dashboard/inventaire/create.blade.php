<div class="modal fade" id="createInventaireModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Ajouter Inventaire
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dashboard.inventaires.store') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                <!-- add_form -->
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Num_ilot" class="mr-sm-2">Sélectionnez un Numéro d\'îlot' :</label>
                            <select class="custom-select" name="Num_ilot">
                                <option disabled>Select Numéro dîlot</option>
                                @foreach ( $ilotOptions as $ilot)
                                    <option value="{{ $ilot->Num_ilot }}">{{ $ilot->N_ilot }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="date_inv" class="mr-sm-2">Date Inv</label>
                            <input type="date" class="form-control" name="date_inv" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="designation" class="mr-sm-2">Designation :</label>
                            <input id="designation" type="text" name="designation" class="form-control" placeholder="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="observation" class="mr-sm-2">Observation :</label>
                            <input type="text" class="form-control" name="observation">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="photos" class="mr-sm-2">photos :</label>
                            <input type="file" class="form-control" name="photos">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="vedio" class="mr-sm-2">Vedio :</label>
                            <input type="file" class="form-control" name="vedio">
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