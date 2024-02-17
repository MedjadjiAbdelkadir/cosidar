<div class="modal fade" id="createUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    Create
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="Name" class="mr-sm-2">Nom & Prénom :</label>
                            <input id="Name" type="text" name="Name" class="form-control" placeholder="Enter new user name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name_en" class="mr-sm-2">Compte (Compte@gmail.com) :</label>
                            <input type="text" class="form-control" name="Name_en" placeholder="Enter new Email Address">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name" class="mr-sm-2">Mot de Passe :</label>
                            <input id="Name" type="text" name="Name" class="form-control" placeholder="Enter new Password">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Name_en" class="mr-sm-2">Confirmation de Mot de Passe :</label>
                            <input type="text" class="form-control" name="Name_en" placeholder="Confirm Password">
                        </div>
                    </div>
                    <br><br>
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