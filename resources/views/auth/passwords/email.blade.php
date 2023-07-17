@extends('layouts.auth')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="p-3">
                <div class="mb-4 text-center">
                    <h4 class="title">Reset your Password</h4>
                    <p class="text-muted">Enter your Email and instructions will be sent to you!
                    </p>
                </div>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        The reset password instruction already sent to your email!
                    </div>
                @endif
                <form class="form-horizontal m-t-30" action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" placeholder="Enter your Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group row m-t-20">
                        <div class="col-12 text-right">
                            <button class="btn btn-warning btn-block w-md waves-effect waves-light"
                                type="submit">Reset</button>
                        </div>
                    </div>
                    <p class="text-center">Remember It ? <a href="{{ route('login') }}" class="font-600 text-info"> Sign In
                            Here </a> </p>
                </form>
            </div>
        </div>
    </div>
    <div class="m-t-40 text-center text-white-50">
        <p>© 2018 - 2019 Framework Builder <i class="mdi mdi-heart text-danger"></i> by <a
                href="https://www.instagram.com/wisnuuakbr_/" class="text-white">Wisnu Akbara</a></p>
    </div>
@endsection
