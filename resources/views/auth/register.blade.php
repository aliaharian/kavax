@extends('layouts.site.auth')

@section('page-title', 'Register')

@section('page-style', 'auth/auth.min.css')

@section('content')
    <div class="auth-form">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="heading">A few details about you...</div>

                    <div class="form-block">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row gy-4">
                                <div class="col-6">
                                    <div class="field-block label-without-field text-field">
                                        <div class="row g-0">
                                            <input type="text" id="full-name" class="@error('first_name') is-invalid @enderror col-12 order-1" name="full_name" value="{{ old('full_name') }}" required autocomplete="full_name" autofocus>
                                            <label for="full-name" class="col-12 order-0">Full Name:</label>
                                        </div>

                                        @error('full_name')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="field-block label-without-field text-field">
                                        <div class="row g-0">
                                            <input type="text" id="email" class="@error('email') is-invalid @enderror col-12 order-1" name="email" value="{{ old('email') }}" required autocomplete="email">
                                            <label for="email" class="col-12 order-0">Email:</label>
                                        </div>
                                        @error('email')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="field-block label-without-field text-field">
                                        <div class="row g-0">
                                            <input type="password" id="password" class="@error('password') is-invalid @enderror col-12 order-1" name="password" required autocomplete="new-password">
                                            <label for="password" class="col-12 order-0">password:</label>
                                        </div>
                                        @error('password')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-6" style="margin-bottom: 20px">
                                    <div class="field-block label-without-field text-field">
                                        <div class="row g-0">
                                            <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" class="col-12 order-1">
                                            <label for="confirm-password" class="col-12 order-0">CONFIRM PASSWORD:</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 gy-2">
                                    <div class="field-block check-box">
                                        <div class="row g-0">
                                            <input type="checkbox" id="terms">
                                            <label for="terms">I accept the terms and conditions</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 gy-2">
                                    <div class="field-block check-box">
                                        <div class="row g-0">
                                            <input type="checkbox" id="newsletter">
                                            <label for="newsletter">Yes, please keep me updated on KavaX news, events and offers.</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 center gy-5">
                                    <div class="field-block submit-form">
                                        <input type="submit" value="Register">
                                    </div>
                                </div>

                                <div class="col-12 form-link center">
                                    <div class="link-item"><a href="{{ url('login') }}">Already registered?</a></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
