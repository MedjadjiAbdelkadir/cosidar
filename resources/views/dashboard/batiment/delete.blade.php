<div class="modal fade" id="deleteBatimentModal{{$batiment->Num_Bat}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Delete Batiment
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dashboard.batiments.destroy' , 'test') }}" method="POST">
            <div class="modal-body">
                <!-- add_form -->
                @csrf
                @method('DELETE')
                <div class="form-group">
                    <h6>Etes-vous sûr de supprimer ? </h6>
                    <input type="hidden" name="id" value="{{ $batiment->Num_Bat }}" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-danger">
                    Delete
                </button>
            </div>
            </form>

        </div>
    </div>
</div>