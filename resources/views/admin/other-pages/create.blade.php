@extends('layouts.admin.dashboard.master')

@section('lib')
    <script src="{{ url('') }}/app/lib/ckeditor/ckeditor.js"></script>
    <script src="{{ url('') }}/app/lib/ckeditor/config.js"></script>
@endsection

@section('page-title', 'Create New Page')

@section('title-page')
    <span class="icon"><svg height="512" viewBox="0 0 64 64" width="512" xmlns="http://www.w3.org/2000/svg"><path d="M45.4 61.8H8.5c-1.1 0-2-.9-2-2V11.3c0-1.1.9-2 2-2h24.3c.5 0 1 .2 1.3.5l12.5 11.1c.4.4.7.9.7 1.5v37.5c.1 1-.8 1.9-1.9 1.9zm-34.9-4h32.8V23.3L32 13.3H10.5z"/><path d="M55.5 54.7H45.3c-1.1 0-2-.9-2-2s.9-2 2-2h8.1V16.2l-11.3-10H20.6v5.1c0 1.1-.9 2-2 2s-2-.9-2-2V4.2c0-1.1.9-2 2-2H43c.5 0 1 .2 1.3.5l12.5 11.1c.4.4.7.9.7 1.5v37.5c0 1-.9 1.9-2 1.9z"/></svg></span>
    <span class="text">Create New Page</span>
@endsection

@section('content')
    <section class="form-section">
        {!! Form::open(['route'=>'other-pages.store', 'id'=>'form', 'enctype' => 'multipart/form-data']) !!}
        <div class="row">
            <div class="col-9">
                <div class="row">
                    {{-- Page Content --}}
                    <div class="col-12">
                        <div class="widget-block widget-item widget-style">
                            <div class="heading-widget">
                                <span class="widget-title">Page Content</span>
                            </div>

                            <div class="widget-content widget-content-padding">
                                <div class="form-group row no-gutters">
                                    @if($errors->has('title'))
                                        <span class="col-12 message-show">{{ $errors->first('title') }}</span>
                                    @endif
                                    {!! Form::text('title',null,[ 'id'=>'title' , 'class'=>'col-12 field-style input-text', 'placeholder'=>'Enter Page Title', 'required']) !!}
                                    <div class="col-12">{!! Form::label('title',"Page Title") !!}
                                        <span class="required">(Required)</span></div>
                                </div>

                                <div class="form-group row no-gutters">
                                    @if($errors->has('heading_text'))
                                        <span class="col-12 message-show">{{ $errors->first('heading_text') }}</span>
                                    @endif
                                    {!! Form::text('heading_text',null,[ 'id'=>'heading_text' , 'class'=>'col-12 field-style input-text', 'placeholder'=>'Enter Heading Text']) !!}
                                    <div class="col-12">{!! Form::label('heading_text',"Page Heading Text") !!}</div>
                                </div>

                                <div class="form-group">
                                    <div style="margin-bottom: 10px;">{!! Form::label('content_text','Page Content') !!}
                                        <span class="required">(Required)</span></div>
                                    <textarea class="field-style input-text" id="content_text" name="content_text" placeholder="Enter Page Content" required>{{ old('content_text') }}</textarea>
                                    @if($errors->has('content_text'))
                                        <span class="col-12 message-show">{{ $errors->first('content_text') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div style="margin-bottom: 10px;">{!! Form::label('excerpt','Page Excerpt') !!}</div>
                                    <textarea class="field-style input-text" id="excerpt" name="excerpt" placeholder="Enter Excerpt">{{ old('excerpt') }}</textarea>
                                    @if($errors->has('excerpt'))
                                        <span class="col-12 message-show">{{ $errors->first('excerpt') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Meet The Team --}}
                    <div class="col-12">
                        <div class="widget-block widget-item widget-style">
                            <div class="heading-widget">
                                <span class="widget-title">Meet The Team</span>
                            </div>

                            <div class="widget-content widget-content-padding widget-content-padding-side">
                                <div class="form-group">
                                    <div class="team text-field-repeater">
                                        <div class="field-list small-image row" id="team_list"></div>
                                        <div class="add-field center" id="addTeam">
                                            <span class="icon-plus"></span>Add Item
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                {{-- Page Options --}}
                <div class="widget-block widget-item widget-style">
                    <div class="heading-widget">
                        <span class="widget-title">Page Options</span>
                    </div>

                    <div class="widget-content widget-content-padding widget-content-padding-side">
                        {{-- Publish Status --}}
                        <div class="form-group row no-gutters">
                            @if($errors->has('status'))
                                <span class="message-show">{{ $errors->first('status') }}</span>
                            @endif
                            <div class="col-12 field-style custom-select-field">
                                <select class="form-control" name="status" id="status">
                                    <option value="">Choose an Option</option>
                                    <option selected value="published" {{ old('status') === "published" ? "selected" : "" }}>Published</option>
                                    <option value="draft" {{ old('status') === "draft" ? "selected" : "" }}>Draft</option>
                                </select>
                            </div>

                            {{-- Publish Status --}}
                            {!! Form::label('status','Publish Status',['class'=>'col-12']) !!}
                        </div>

                        {{-- Template --}}
                        <div class="form-group row no-gutters">
                            @if($errors->has('template'))
                                <span class="message-show">{{ $errors->first('template') }}</span>
                            @endif
                            <div class="col-12 field-style custom-select-field">
                                <select class="form-control" name="template" id="template">
                                    <option value="">Choose an Option</option>
                                    <option value="published" {{ old('template') === "about-us" ? "selected" : "" }}>About Us</option>
                                </select>
                            </div>

                            {{-- Publish Status --}}
                            {!! Form::label('template','Template',['class'=>'col-12']) !!}
                        </div>

                        <button type="submit" class="submit-form-btn create-btn">Create Page</button>
                    </div>
                </div>

                {{-- Page Thumbnail --}}
                <div class="widget-block widget-item widget-style">
                    <div class="heading-widget">
                        <span class="widget-title">Page Header Image</span>
                    </div>

                    <div class="widget-content widget-content-padding widget-content-padding-side">
                        <div class="form-group row no-gutters">
                            @if($errors->has('thumbnail'))
                                <span class="message-show">{{ $errors->first('thumbnail') }}</span>
                            @endif
                            <div class="col-12 field-style custom-select-field">
                                <div class="thumbnail-image-upload">
                                    <div>
                                        <label for="thumbnail-image" id="thumbnail-label" class="thumbnail-label"><img id="thumbnail-preview" src="{{ asset('public/assets/admin/img/base/icons/image.svg') }}"></label>
                                        <input required onchange="readURL(this)" name="thumbnail" type="file" class="thumbnail-image" id="thumbnail-image" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@endsection

@section('footer')
    {{-- CKEditor Config --}}
    <script type="text/javascript">
        CKEDITOR.replace('content_text', {
            language: 'en',
            filebrowserUploadUrl: "{{route('ckeditor.image-upload', ['path' => 'product','_token' => csrf_token()])}}",
            filebrowserUploadMethod: 'form',
            width: '100%',
            height: '282',
            uiColor: '#fdfdfd',
        });
    </script>

    {{-- Add Meet The Team --}}
    <script>
        jQuery(document).ready(function () {
            var i = 0;
            jQuery("#addTeam").click(function () {
                i += 1;
                jQuery("#team_list").append("<div class='text-field col-12' id='field-team-" + i + "'><div class='row align-items-center'><div class='col-2'><div class=\"thumbnail-image-upload\"><div><label for='thumbnail-image-" + i + "' id='thumbnail-label-" + i + "' class=\"thumbnail-label no-text\"><img id='thumbnail-preview-" + i + "' src=\"{{ asset('public/assets/admin/img/base/icons/image.svg') }}\"></label><input required onchange=\"readURL(this)\" name=\"team[" + i + "][image]\" type=\"file\" class=\"thumbnail-image\" id='thumbnail-image-" + i + "' accept=\"image/*\"></div></div></div><div class='col-5'><input placeholder='Full Name...' class='input-field' type=\"text\" name=\"team[" + i + "][name]\" id=\"team\"></div><div class='col-5'><input placeholder='Job Name...' class='input-field' type=\"text\" name=\"team[" + i + "][job]\" id=\"team\"> <span class='delete-row icon-close' onclick='delete_team(" + i + ")'><img src='{{ asset('public/assets/admin/img/base/icons') }}/close.svg'></span></div></div>");
                return false;
            });
        });

        function delete_team($id) {
            $('#field-team-' + $id).remove();
        }
    </script>

    {{-- Thumbnail Preview --}}
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(input).prev().find('img').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
    </script>
@endsection
