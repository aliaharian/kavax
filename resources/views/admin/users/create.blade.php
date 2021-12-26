@extends('layouts.admin.dashboard.master')

@section('title-page')
    <span class="icon"><img src="{{ asset('public/assets/admin/img/base/icons') }}/user.svg"></span>
    <span class="text">Create User</span>
@endsection

@section('content')
    <section class="form-section">
        <form action="{{ route('users.store') }}" method="POST">
            <div class="row">
                <div class="col-9">
                    <div class="widget-block widget-item widget-style">
                        <div class="heading-widget">
                            <div class="row">
                                <div class="col-9">
                                    <span class="widget-title">Create User</span>
                                </div>
                                <div class="col-3 left">
                                </div>
                            </div>
                        </div>

                        <div class="widget-content widget-content-padding">
                            @csrf
                            <div class="form-group row no-gutters">
                                @if($errors->has('full_name'))
                                    <span class="col-12 message-show">{{ $errors->first('full_name') }}</span>
                                @endif
                                {!! Form::text('full_name',null,[ 'id'=>'full_name' , 'class'=>'col-12 field-style input-text', 'placeholder'=>'Enter your Name']) !!}
                                {!! Form::label('full_name','Name:',['class'=>'col-12']) !!}
                            </div>
                            <div class="form-group row no-gutters">
                                @if($errors->has('email'))
                                    <span class="col-12 message-show">{{ $errors->first('email') }}</span>
                                @endif
                                {!! Form::email('email',null,[ 'id'=>'email' , 'class'=>'col-12 field-style input-text', 'placeholder'=>'Enter your Email']) !!}
                                {!! Form::label('email','Email:',['class'=>'col-12']) !!}
                            </div>
                            <div class="form-group row no-gutters">
                                @if($errors->has('password'))
                                    <span class="col-12 message-show">{{ $errors->first('password') }}</span>
                                @endif
                                <input type="password" name="password" class="col-12 field-style input-text" id="password" placeholder="Enter your Password">
                                <label class="col-12" for="password">Password:</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="widget-block widget-item widget-style">
                        <div class="heading-widget">
                            <span class="widget-title">Submit Information</span>
                        </div>

                        <div class="widget-content widget-content-padding widget-content-padding-side">
                            <div class="form-group row no-gutters">
                                @if($errors->has('role'))
                                    <span class="message-show">{{ $errors->first('role') }}</span>
                                @endif
                                <div class="col-12 field-style custom-select-field">
                                    <select class="form-control" name="role" id="role">
                                        <option value="">Select a item</option>
                                        <option value="admin" {{ isset($users) && $users->role == 'admin' ? 'selected': '' }}>Admin</option>
                                        <option value="author" {{ isset($users) && $users->role == 'author' ? 'selected': '' }}>Author</option>
                                        <option value="user" {{ isset($users) && $users->role == 'user' ? 'selected': '' }}>Users</option>
                                    </select>
                                </div>
                                {!! Form::label('role','Role:',['class'=>'col-12']) !!}
                            </div>
                            <button type="submit" class="submit-form-btn create-btn">Create</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection
