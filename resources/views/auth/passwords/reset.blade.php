@extends('layouts.auth')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="p-3">
                <div class="float-right text-right">
                    <h4 class="font-18 mt-4 m-b-5">Reset Password</h4>
                </div>
                <a href="#" class="logo-admin"><img src="{{ asset('style') }}/assets/images/logo.png" height="26"
                        alt="logo"></a>
            </div>

            <div class="p-3">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        Enter your Email and instructions will be sent to you!
                    </div>
                @endif

                <form class="form-horizontal m-t-30" action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $email ?? old('email') }}" placeholder="Enter email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Passwor</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" placeholder="Enter password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label>
                        <input id="password-confirm" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
                            placeholder="Enter password">
                    </div>

                    <div class="form-group row m-t-20">
                        <div class="col-12 text-right">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Reset</button>
                        </div>
                    </div>

                </form>
            </div>

        </div>
    </div>

    <div class="m-t-40 text-center text-white-50">
        <p>Remember It ? <a href="{{ route('login') }}" class="font-600 text-white"> Sign In Here </a> </p>
        <p>© 2018 - 2019 Framework Builder <i class="mdi mdi-heart text-danger"></i> by <a
                href="https://www.instagram.com/wisnuuakbr_/" class="text-white">Wisnu Akbara</a></p>
    </div>
@endsection
