{{-- deleteUserModal{{ $user->id }} --}}

<div class="modal fade" id="noteBienModal{{ $ilot->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Ajouter une note
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <h5>{{ $ilot->Denom_Ilot }}</h5>
                <form action="{{ route('dashboard.ilots.notes') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="id" value="{{ $ilot->id }}" class="form-control">
                        <div class="mb-3">
                            <label for="note" class="form-label">Ajouter une note</label>
                            <textarea class="form-control border border-secondary" id="note" name="note" rows="8" @if(auth()->user()->role == 'user_direction' || auth()->user()->role == 'user_sous_direction' || auth()->user()->role == 'user_consultation_direction') disabled @endif >
                                {{ $ilot->notes }}
                            </textarea>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-success">
                    Ajoute
                </button>
            </div>
            </form>

        </div>
    </div>
</div>
