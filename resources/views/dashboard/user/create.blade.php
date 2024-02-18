{{-- {{ Form::open(['url' => 'users']) }}

<div class="form-row mb-3">
    <div class="form-group col-md-6">
        {{ Form::label('name', __('Nom & Prénom')) }}
        {{ Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter new user name')]) }}
    </div>

    <div class="form-group col-md-6">
        {{ Form::label('email', __('Compte (Compte@gmail.com)')) }}
        {{ Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('Enter new Email Address')]) }}
    </div>


    <div class="form-group col-md-6">
        {{ Form::label('password', __('Mot de Passe')) }}<br>
        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter new Password')]) }}
    </div>

    <div class="form-group col-md-6">
        {{ Form::label('password_confirmation', __('Confirmation de Mot de Passe')) }}<br>
        {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => __('Confirm Password')]) }}
    </div>
</div>



<div class="form-group col-md-12">
    <div class="border p-3 rounded text-center">
        {{ Form::label('role', __('La Tutelle')) }}
        <div class="d-flex justify-content-center mt-2">
            <label class="mr-3">
                {{ Form::radio('role', 'direction', false, ['class' => 'mr-2']) }}
                {{ __('DDN') }}
            </label>
            <label class="mr-3">
                {{ Form::radio('role', 'utilisateur', false, ['class' => 'mr-2']) }}
                {{ __('MAE') }}
            </label>
            <label>
                {{ Form::radio('role', 'consultation', false, ['class' => 'mr-2']) }}
                {{ __('Les deux tutelles au profil de consultation') }}
            </label>
        </div>
    </div>
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary btn-md" data-dismiss="modal">{{ __('Cancel') }}</button>
    <input class="btn btn-success btn-md" type="submit" value="{{ __('Create') }}">
</div>

{{ Form::close() }} --}}


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
                <form action="{{ route('dashboard.users.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name" class="mr-sm-2">Nom & Prénom :</label>
                            <input id="name" type="text" name="name" class="form-control" placeholder="Enter new user name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email" class="mr-sm-2">Compte (Compte@gmail.com) :</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter new Email Address">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password" class="mr-sm-2">Mot de Passe :</label>
                            <input id="password" type="password" name="password" class="form-control" placeholder="Enter new Password">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password_confirmation" class="mr-sm-2">Confirmation de Mot de Passe :</label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
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