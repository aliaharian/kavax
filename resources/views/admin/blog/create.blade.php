@extends('layouts.admin.dashboard.master')

@section('lib')
    <script src="{{ url('') }}/app/lib/ckeditor/ckeditor.js"></script>
    <script src="{{ url('') }}/app/lib/ckeditor/config.js"></script>
@endsection

@section('page-title', 'Create New Post')

@section('title-page')
    <span class="icon"><svg height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg"><path d="M422 0H0v452c0 33.086 26.914 60 60 60h392.0078C485.086 512 512 485.086 512 452V241h-90zM60 482c-16.543 0-30-13.457-30-30V30h362v422c0 10.9258 2.9492 21.168 8.0703 30zm422-211v181c0 16.543-13.4531 30-30 30-16.543 0-30-13.457-30-30V271zm0 0"/><path d="M60 181h302V60H60zm30-91h242v61H90zM60 211h151v30H60zM241 211h121v30H241zM60 271h151v30H60zM241 271h121v30H241zM60 331h151v30H60zM60 391h151v30H60zM241 421h121v-90H241zm30-60h61v30h-61zm0 0"/></svg></span>
    <span class="text">Create New Post</span>
@endsection

@section('content')
    <section class="form-section">
        {!! Form::open(['route'=>'blog.store', 'id'=>'form', 'enctype' => 'multipart/form-data']) !!}
        <div class="row">
            <div class="col-9">
                <div class="row">
                    {{-- Post Content --}}
                    <div class="col-12">
                        <div class="widget-block widget-item widget-style">
                            <div class="heading-widget">
                                <span class="widget-title">Post Content</span>
                            </div>

                            <div class="widget-content widget-content-padding">
                                <div class="form-group row no-gutters">
                                    @if($errors->has('title'))
                                        <span class="col-12 message-show">{{ $errors->first('title') }}</span>
                                    @endif
                                    {!! Form::text('title',null,[ 'id'=>'title' , 'class'=>'col-12 field-style input-text', 'placeholder'=>'Enter Post Title', 'required']) !!}
                                    <div class="col-12">{!! Form::label('title',"Post Title") !!}
                                        <span class="required">(Required)</span></div>
                                </div>

                                <div class="form-group">
                                    <div style="margin-bottom: 10px;">{!! Form::label('content_text','Post Content') !!}
                                        <span class="required">(Required)</span></div>
                                    <textarea class="field-style input-text" id="content_text" name="content_text" placeholder="Enter Post Content" required>{{ old('content_text') }}</textarea>
                                    @if($errors->has('content_text'))
                                        <span class="col-12 message-show">{{ $errors->first('content_text') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                {{-- Post Options --}}
                <div class="widget-block widget-item widget-style">
                    <div class="heading-widget">
                        <span class="widget-title">Post Options</span>
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
                        <button type="submit" class="submit-form-btn create-btn">Create Post</button>
                    </div>
                </div>

                {{-- Post Thumbnail --}}
                <div class="widget-block widget-item widget-style">
                    <div class="heading-widget">
                        <span class="widget-title">Post Thumbnail</span>
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
