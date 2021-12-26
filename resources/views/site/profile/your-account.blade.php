@extends('layouts.profile.master')

@section('page-title', 'Your Account')

@section('content')
    <article class="content-inner">
        <div class="heading-page-block">
            <div class="heading-text">Your account</div>
            <div class="excerpt-page">Keep your details up to date and change your preferences here.</div>
        </div>

        <div class="page-content-body profile-edit-form">
            <div class="form-title">A few details about you...</div>
            <form>
                <div class="row align-items-center">
                    <div class="col-6 item">
                        <div class="field-block">
                            <label>First name</label> <input type="text" name="">
                        </div>
                    </div>
                    <div class="col-6 item">
                        <div class="field-block">
                            <label>Last name</label> <input type="text" name="">
                        </div>
                    </div>
                    <div class="col-6 item">
                        <div class="field-block">
                            <label>Email address</label> <input type="email" name="">
                        </div>
                    </div>
                    <div class="col-6 item center">
                        <div class="password-link"><a href="#">Change your password</a></div>
                    </div>
                    <div class="col-6 item">
                        <div class="field-block">
                            <label>Phone number</label> <input type="email" name="">
                        </div>
                    </div>
                    <div class="col-6 item">
                        <div class="field-block">
                            <label>Add a new number</label> <input type="email" name="">
                        </div>
                    </div>
                    <div class="col-12 item center">
                        <div class="submit-form">
                            <button>Save changes</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </article>
@endsection
