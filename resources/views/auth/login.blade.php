@extends('layouts.auth')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="p-3 text-center">
                <a href="{{ url('/login') }}" class="logo-admin"><img src="{{ asset('style') }}/assets/images/logo_dark.png"
                        height="60" alt="logo"></a>
            </div>
            <div class="p-3">
                <div class="text-center">
                    <a href="{{ route('google.login') }}" class="btn btn-light btn-block waves-effect waves-light">
                        <i class="fa fa-google-plus mr-2"></i>Sign in with Google
                    </a>
                </div>
                <div class="text-center mt-4">
                    <span class="text-muted">or</span>
                </div>
                <form class="form-horizontal m-t-10" action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" placeholder="Enter email address">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            required id="password" placeholder="Enter password">
                        @error('password')
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
                            <button class="btn btn-primary w-md waves-effect waves-light" name="remember" value="1"
                                type="submit">Log
                                In</button>
                        </div>
                    </div>
                    <div class="form-group m-t-30 mb-0 row">
                        <div class="col-12 text-center">
                            <a href="{{ route('password.request') }}" class="text-muted"><i class="mdi mdi-lock"></i> Forgot
                                your password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="m-t-40 text-center text-white-50">
        <p>Don't have an account ? <a href="{{ route('register') }}" class="font-600 text-white"> Signup Now </a> </p>
        <p>© 2018 - 2019 Starter Template <i class="mdi mdi-heart text-danger"></i> by <a
                href="https://www.instagram.com/wisnuuakbr_/" class="text-white">Wisnu Akbara</a></p>
    </div>
@endsection
