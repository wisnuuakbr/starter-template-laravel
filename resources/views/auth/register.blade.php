@extends('layouts.auth')

@section('content')
    <div class="card">
        <div class="card-body">

            <div class="p-3 text-center">
                <a href="#" class="logo-admin"><img src="{{ asset('style') }}/assets/images/logo.png" height="26"
                        alt="logo"></a>
            </div>

            <div class="p-3">

                <form class="form-horizontal m-t-10" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required id="name" placeholder="Enter your name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control  @error('name') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required id="email" placeholder="Enter your email">
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

                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label></label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="Enter password">
                    </div>

                    <div class="form-group row m-t-20">
                        <div class="col-12 text-right">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Register</button>
                        </div>
                    </div>

                    <div class="form-group m-t-30 mb-0 row">
                        <div class="col-12">
                            <p class="font-14 text-center text-muted mb-0">By registering you agree to the Foxia <a
                                    href="#" class="text-primary">Terms of Use</a></p>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="m-t-40 text-center text-white-50">
        <p>Already have an account ? <a href="{{ route('login') }}" class="font-600 text-white"> Login </a> </p>
        <p>© 2018 - 2019 Framework Builder <i class="mdi mdi-heart text-danger"></i> by <a
                href="https://www.instagram.com/wisnuuakbr_/" class="text-white">Wisnu Akbara</a></p>
    </div>
@endsection
