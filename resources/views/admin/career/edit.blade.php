@extends('layouts.admin.dashboard.master')

@section('lib')
    <script src="{{ url('') }}/app/lib/ckeditor/ckeditor.js"></script>
    <script src="{{ url('') }}/app/lib/ckeditor/config.js"></script>
@endsection

@section('page-title', 'Career Edit')

@section('title-page')
    <span class="icon"><svg height="512pt" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg"><path d="M422 0H0v452c0 33.086 26.914 60 60 60h392.0078C485.086 512 512 485.086 512 452V241h-90zM60 482c-16.543 0-30-13.457-30-30V30h362v422c0 10.9258 2.9492 21.168 8.0703 30zm422-211v181c0 16.543-13.4531 30-30 30-16.543 0-30-13.457-30-30V271zm0 0"/><path d="M60 181h302V60H60zm30-91h242v61H90zM60 211h151v30H60zM241 211h121v30H241zM60 271h151v30H60zM241 271h121v30H241zM60 331h151v30H60zM60 391h151v30H60zM241 421h121v-90H241zm30-60h61v30h-61zm0 0"/></svg></span>
    <span class="text">Career Edit</span>
@endsection

@section('content')
    <section class="form-section">
        <form action="{{ route('career.update' , $Career->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-9">
                    <div class="row">
                        {{-- Career Content --}}
                        <div class="col-12">
                            <div class="widget-block widget-item widget-style">
                                <div class="heading-widget">
                                    <span class="widget-title">Career Content</span>
                                </div>

                                <div class="widget-content widget-content-padding">
                                    <div class="form-group row no-gutters">
                                        @if($errors->has('title'))
                                            <span class="col-12 message-show">{{ $errors->first('title') }}</span>
                                        @endif
                                        {!! Form::text('title',$Career->title,[ 'id'=>'title' , 'class'=>'col-12 field-style input-text', 'placeholder'=>'Enter Career Title']) !!}
                                        <div class="col-12">{!! Form::label('title',"Career Title") !!}
                                            <span class="required">(Required)</span></div>
                                    </div>

                                    <div class="form-group">
                                        <div style="margin-bottom: 10px;">{!! Form::label('content_text','Career Content') !!}
                                            <span class="required">(Required)</span></div>
                                        <textarea class="field-style input-text" id="content_text" name="content_text" placeholder="Enter Career Content">{{ $Career->content_text }}</textarea>
                                        @if($errors->has('content_text'))
                                            <span class="col-12 message-show">{{ $errors->first('content_text') }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Career Meta Data --}}
                        <div class="col-12">
                            <div class="widget-block widget-item widget-style">
                                <div class="heading-widget">
                                    <span class="widget-title">Career Meta Data</span>
                                </div>

                                <div class="widget-content widget-content-padding">
                                    <div class="row gy-4">
                                        <div class="col-6">
                                            <div class="form-group d-flex flex-column">
                                                @if($errors->has('location'))
                                                    <span class="message-show">{{ $errors->first('location') }}</span>
                                                @endif
                                                {!! Form::text('location',$Career->location,[ 'id'=>'location' , 'class'=>' field-style input-text', 'placeholder'=>'Enter Career Location', 'required']) !!}
                                                <div>{!! Form::label('location',"Location") !!}
                                                    <span class="required">(Required)</span></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group d-flex flex-column">
                                                @if($errors->has('term'))
                                                    <span class="message-show">{{ $errors->first('term') }}</span>
                                                @endif
                                                {!! Form::text('term',$Career->term,[ 'id'=>'term' , 'class'=>'field-style input-text', 'placeholder'=>'Enter Career Term', 'required']) !!}
                                                <div>{!! Form::label('term',"Term") !!}
                                                    <span class="required">(Required)</span></div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group d-flex flex-column">
                                                @if($errors->has('salary'))
                                                    <span class="message-show">{{ $errors->first('salary') }}</span>
                                                @endif
                                                {!! Form::text('salary',$Career->salary,[ 'id'=>'salary' , 'class'=>'field-style input-text', 'placeholder'=>'Enter Career Salary', 'required']) !!}
                                                <div>{!! Form::label('salary',"Salary") !!}
                                                    <span class="required">(Required)</span></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    {{-- Career Options --}}
                    <div class="widget-block widget-item widget-style">
                        <div class="heading-widget">
                            <div class="row align-items-center">
                                <div class="col-10"><span class="widget-title">Career Options</span></div>
                                <div class="col-2 left">
                                    <a target="_blank" href="{{ Url("career/$Career->slug") }}"><span class="icon"><img width="100%" src="{{ asset('public/assets/admin/img/base/icons/show.svg') }}"></span></a>
                                </div>
                            </div>
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
                                        <option @if(old('status') == 'published') selected @else @if($Career->status == 'published') selected @endif @endif value="published">Publish</option>
                                        <option @if(old('status') == 'draft') selected @else @if($Career->status == 'draft') selected @endif @endif value="draft">Draft</option>
                                    </select>
                                </div>

                                {{-- Publish Status --}}
                                {!! Form::label('status','Publish Status',['class'=>'col-12']) !!}
                            </div>
                            <button type="submit" class="submit-form-btn">Update Career</button>
                        </div>
                    </div>

                    {{-- Career Thumbnail --}}
                    <div class="widget-block widget-item widget-style">
                        <div class="heading-widget">
                            <span class="widget-title">Career Thumbnail</span>
                        </div>

                        <div class="widget-content widget-content-padding widget-content-padding-side">
                            <div class="form-group row no-gutters">
                                @if($errors->has('thumbnail'))
                                    <span class="message-show">{{ $errors->first('thumbnail') }}</span>
                                @endif
                                <div class="col-12 field-style custom-select-field">
                                    <div class="thumbnail-image-upload">
                                        <div>
                                            <label for="thumbnail-image" id="thumbnail-label" class="thumbnail-label"><img id="thumbnail-preview" src="@if($Career->thumbnail && isset(\App\Model\Attachments::find($Career->thumbnail)->path)) {{asset('storage/app/career/thumbnail/636').'/'.\App\Model\Attachments::find($Career->thumbnail)->path}} @else{{ asset('public/assets/admin/img/base/icons/image.svg') }}@endif"></label>
                                            <input onchange="readURL(this)" name="thumbnail" type="file" class="thumbnail-image" id="thumbnail-image" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {!! Form::close() !!}
        </form>
    </section>

@endsection

@section('footer')
    {{-- CKEditor Config --}}
    <script type="text/javascript">
        CKEDITOR.replace('content_text', {
            language: 'enn',
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
