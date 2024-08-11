@extends('layouts.auth')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="p-3">
                <div class="mb-4 text-center">
                    <h4 class="title">Register your Account</h4>
                    <p class="text-muted">Get started with our app, just create an account and enjoy the
                        experience.
                    </p>
                </div>
                <form class="form-horizontal m-t-10" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required id="name" placeholder="Enter your Name">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control  @error('name') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required id="email" placeholder="Enter your Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                            required id="password" placeholder="Enter your Password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Confirm Password</label></label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" placeholder="Enter your Password">
                    </div>
                    <div class="form-group row m-t-20">
                        <div class="col-12 text-right">
                            <button class="btn btn-block btn-info w-md waves-effect waves-light"
                                type="submit">Register</button>
                        </div>
                    </div>
                    <p class="text-center">Already have an account ? <a href="{{ route('login') }}"
                            class="font-600 text-info font-weight-bold"> Login </a> </p>
                    <div class="form-group m-t-10 mb-0 row">
                        <div class="col-12">
                            <p class="font-14 text-center text-muted mb-0">By registering you agree to the <a href="#"
                                    class="text-info">Terms of Use</a></p>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
