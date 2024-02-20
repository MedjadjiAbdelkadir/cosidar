<div class="modal fade" id="changeStatusUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Change Status
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('dashboard.users.changeStatus' , 'test') }}" method="POST">
                <div class="modal-body">
                    <!-- add_form -->
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <h6>Êtes-vous sûr d'avoir @if($user->user_status == 1) désactivé @else Deactive @endif l'utilisateur ?</ا>
                        <input type="hidden" name="id" value="{{ $user->id }}" class="form-control">
                    </div>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Change</button>
            </div>
            </form>

        </div>
    </div>
</div>