@extends('layouts.auth')
@section('content')
    <style>
        .underline-text {
            text-decoration: underline;
            color: black;
        }
    </style>
    <div class="card">
        <div class="card-body">
            <div class="p-3">
                <div class="mb-4 text-center">
                    <h4 class="title">Login to your Account</h4>
                    <p class="text-muted">Get started with our app, just create an account and enjoy the
                        experience.
                    </p>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form class="form-horizontal" action="{{ url('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Username</label>
                        <input type="text" class="form-control @error('user_mail') is-invalid @enderror" name="user_mail"
                            value="{{ old('user_mail') }}" required autocomplete="email" placeholder="Enter your Email or Username">
                        @error('user_mail')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('user_pass') is-invalid @enderror" name="user_pass"
                            required id="password" placeholder="Enter your Password">
                        @error('user_pass')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row m-t-30">
                        <div class="col-sm-6">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right">
                            {{-- <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock"></i> Forgot
                                your password?</a> --}}
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block w-md waves-effect waves-light" name="remember"
                            value="1" type="submit">Sign
                            In</button>
                    </div>
                    <p class="text-center">Don't have an account ? <a href="{{ route('register') }}"
                            class="text-info font-weight-bold"> Signup Now </a>
                    </p>
                    <div class="text-center mb-2">
                        <span class="text-muted font-weight-bold">Or</span>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('google.login') }}" class="btn btn-light btn-block waves-effect waves-light">
                            <i class="fa fa-google-plus mr-2"></i>Sign in with Google
                        </a>
                    </div>
                    <div class="text-center mt-4">
                        <a href="#" class="underline-text">Term of use &amp; Conditions</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
