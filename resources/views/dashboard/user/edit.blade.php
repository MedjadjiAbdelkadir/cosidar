<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Edit
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('dashboard.users.update' , 'test') }}" method="POST">
                    @csrf
                    @method('PATH')
                    <input type="hidden" name="id" value="{{ $user->id }}" class="form-control">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name" class="mr-sm-2">Nom & Prénom :</label>
                            <input id="name" type="text" name="name" value="{{ $user->name }}" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email" class="mr-sm-2">Compte (Compte@gmail.com) :</label>
                            <input type="text" class="form-control" name="email" value="{{ $user->email }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password" class="mr-sm-2">Mot de Passe :</label>
                            <input id="password" type="text" name="password" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation" class="mr-sm-2">Confirmation de Mot de Passe :</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address" class="mr-sm-2">Address :</label>
                            <input type="text" class="form-control" name="address" value="{{ $user->address }}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="role" class="mr-sm-2">Role :</label>
                            <select class="custom-select" name="role">
                                <option selected value="{{ $user->role }}">{{ $user->role }}</option>
                                <option value="admin_direction">Admin Direction</option>
                                <option value="user_direction">User Direction</option>
                                <option value="consultation_direction">Consultation Direction</option>
                                <option value="admin_sous_direction">Admin SousDirection</option>
                                <option value="user_sous_direction">User SousDirection</option>
                                <option value="consultation_sous_direction">Consultation SousDirection</option>
                            </select>
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