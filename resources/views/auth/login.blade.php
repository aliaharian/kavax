@extends('layouts.site.auth')

@section('page-title', 'Login')

@section('page-style', 'auth/auth.min.css')

@section('content')
    <div class="auth-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-4">
                    <div class="heading">Complete your user information</div>

                    <div class="form-block">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="row gy-4">
                                <div class="col-12">
                                    <div class="field-block label-without-field text-field">
                                        <div class="row g-0">
                                            <input name="email" type="text" id="email" class="@error('email') is-invalid @enderror col-12 order-1" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                            <label for="email" class="col-12 order-0">Email:</label>
                                        </div>

                                        @error('email')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="field-block label-without-field text-field">
                                        <div class="row g-0">
                                            <input type="password" id="password" name="password" class="@error('password') is-invalid @enderror col-12 order-1" required autocomplete="current-password">
                                            <label for="password" class="col-12 order-0">password:</label>
                                        </div>

                                        @error('password')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 center gy-5">
                                    <div class="field-block submit-form">
                                        <input type="submit" value="Login">
                                    </div>
                                </div>

                                <div class="col-12 form-link center">
                                    <div class="link-item"><a href="{{ url('register') }}">Are you a member?</a></div>
                                    <div class="link-item"><a href="#">Forgot Password</a></div>
                                </div>
                            </div>
                            <input class="form-check-input d-none" type="hidden" value="1" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
