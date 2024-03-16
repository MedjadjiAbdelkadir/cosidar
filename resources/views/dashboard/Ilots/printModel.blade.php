<div class="modal fade" id="PrintBienModal{{ $ilot->Num_ilot }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Etat Sorte Ilot
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <a class="btn btn-info btn-sm" href="{{ route('dashboard.ilots.vueidentification' , $ilot->Num_ilot) }}">
                    Etat Sorte 1
                </a>
                <a class="btn btn-info btn-sm" href="{{ url('/dashboard/ilots/vue-generale',$ilot->Num_ilot) }}" >
                    Etat Sorte 2
                </a>
                <a class="btn btn-info btn-sm" href="{{ route('dashboard.evaluations.show', $ilot->id) }}" >
                    Etat Sorte 3
                </a>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>
