@extends('layouts.Auth.app')

@section('content')
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex align-content-center h-100">
                <img src="{{ asset('cosidar/logo.png') }}" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6 contents">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <h3>Log In</h3>
                            <p class="mb-4">Welcome.</p>
                        </div>
                        <form action="{{ route('login') }}" method="POST">
                            @csrf

                            <div class="form-group first">
                                <label for="email">{{ __('Email Address') }}</label>
                                <input id="email" type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group last mb-4">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="d-flex mb-5 align-items-center">
                                <label for="remember" class="control control--checkbox mb-0"><span class="caption">{{ __('Remember Me') }}</span>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                <div class="control__indicator"></div>
                                </label>
                                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                            </div>

                            <button type="submit" class="btn btn-block btn-primary">
                                {{ __('Log In') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
