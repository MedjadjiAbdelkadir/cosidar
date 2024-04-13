<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Ajouter utilisateur
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form autocomplete="off" action="{{ route('dashboard.users.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name" class="mr-sm-2">Nom & Prénom :</label>
                            <input id="name" type="text" name="name" class="form-control"
                                placeholder="Enter new user name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email" class="mr-sm-2">Compte (Compte@gmail.com) :</label>
                            <input type="text" class="form-control" name="email"
                                placeholder="Enter new Email Address">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password" class="mr-sm-2">Mot de Passe :</label>
                            <input id="password" type="password" name="password" class="form-control"
                                placeholder="Enter new Password">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation" class="mr-sm-2">Confirmation de Mot de Passe :</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Confirm Password">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address" class="mr-sm-2">Address :</label>
                            <input type="text" class="form-control" name="address" placeholder="Entre Address">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="role" class="mr-sm-2">Role :</label>
                            <select class="custom-select" name="role">
                                <option disabled selected>Select Role User</option>
                                @if (auth()->user()->role == 'admin_direction')
                                    <option value="user_direction">User Direction</option>
                                    <option value="user_consultation_direction">User Consultation Direction</option>
                                    <option value="admin_sous_direction">Admin SousDirection</option>
                                @elseif (auth()->user()->role == 'admin_sous_direction')
                                    <option value="user_sous_direction">User SousDirection</option>
                                    <option value="user_consultation_sous_direction">User Consultation SousDirection
                                    </option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sector" class="mr-sm-2">Sector :</label>
                            <select class="custom-select" name="sector">
                                <option disabled selected>Select Sector User</option>
                                <option value="Sector 1">Sector 1</option>
                                <option value="Sector 2">Sector 2</option>
                                <option value="Sector 3">Sector 3</option>
                                <option value="Sector 4">Sector 4</option>
                            </select>
                        </div>
                    </div>
                    <br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Create</button>
            </div>
            </form>

        </div>
    </div>
</div>
