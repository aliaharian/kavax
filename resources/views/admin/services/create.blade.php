@extends('layouts.admin.dashboard.master')

@section('lib')
    <script src="{{ url('') }}/app/lib/ckeditor/ckeditor.js"></script>
    <script src="{{ url('') }}/app/lib/ckeditor/config.js"></script>
@endsection

@section('page-title', 'Create New Service')

@section('title-page')
    <span class="icon"><svg height="512" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg"><path d="M23.5 30c-1.93 0-3.5-1.57-3.5-3.5V13.367c-1.865-1.189-3-3.234-3-5.473 0-2.45 1.358-4.666 3.544-5.785.311-.158.681-.145.978.037.297.183.478.505.478.854v4.323l1.5.6 1.5-.6V3c0-.349.181-.671.478-.854.297-.182.667-.195.978-.037C28.642 3.229 30 5.444 30 7.895c0 2.238-1.135 4.283-3 5.473V26.5c0 1.93-1.57 3.5-3.5 3.5zM20 5.066c-.637.785-1 1.775-1 2.828 0 1.694.941 3.229 2.456 4.005a1 1 0 0 1 .544.89V26.5c0 .827.673 1.5 1.5 1.5s1.5-.673 1.5-1.5V12.789a1 1 0 0 1 .544-.89C27.059 11.123 28 9.589 28 7.895c0-1.053-.363-2.043-1-2.828V8c0 .409-.249.776-.628.929l-2.5 1a.9944.9944 0 0 1-.743 0l-2.5-1C20.249 8.776 20 8.409 20 8z"/><path d="M17.074 30h-2.147c-1.039 0-1.915-.811-1.994-1.846l-.126-1.635c-.686-.208-1.35-.484-1.985-.824l-1.246 1.067c-.789.677-1.981.63-2.715-.103l-1.52-1.521c-.734-.734-.78-1.927-.104-2.716l1.067-1.245c-.34-.635-.616-1.299-.824-1.985l-1.634-.125C2.811 18.989 2 18.113 2 17.074v-2.148c0-1.039.811-1.915 1.847-1.994l1.634-.125c.208-.687.484-1.351.824-1.985L5.237 9.575c-.676-.788-.63-1.98.105-2.716L6.86 5.34c.735-.735 1.928-.78 2.716-.104l1.246 1.067c.635-.34 1.299-.616 1.985-.824l.126-1.635C13.012 2.811 13.888 2 14.926 2H16c.552 0 1 .447 1 1s-.448 1-1 1h-1.074l-.18 2.341c-.034.436-.347.799-.772.897-.967.223-1.887.604-2.734 1.135a.9948.9948 0 0 1-1.181-.089L8.274 6.755l-1.518 1.52 1.529 1.784c.285.332.32.811.088 1.181-.53.848-.912 1.768-1.135 2.734a.999.999 0 0 1-.898.772l-2.34.18v2.148l2.34.18c.436.033.8.347.898.772.223.967.604 1.887 1.135 2.734.232.37.196.849-.088 1.181l-1.529 1.784 1.519 1.52 1.784-1.529a.9978.9978 0 0 1 1.181-.089c.848.53 1.768.912 2.734 1.135.426.099.739.462.772.897l.18 2.341h2.147c.042-.55.521-.961 1.074-.92.551.042.963.523.92 1.074-.079 1.035-.955 1.846-1.993 1.846z"/><path d="M9 16c0-3.434 2.454-6.337 5.835-6.903.543-.097 1.061.276 1.151.821.091.545-.276 1.06-.821 1.151C12.752 11.474 11 13.548 11 16c0 3.453 3.43 5.861 6.667 4.716.518-.185 1.092.087 1.277.608.184.521-.088 1.092-.609 1.276C13.782 24.211 9 20.816 9 16z"/></svg></span>
    <span class="text">Create New Service</span>
@endsection

@section('content')
    <section class="form-section">
        {!! Form::open(['route'=>'services.store', 'id'=>'form', 'enctype' => 'multipart/form-data']) !!}
        <div class="row">
            <div class="col-9">
                <div class="row">
                    {{-- Content --}}
                    <div class="col-12">
                        <div class="widget-block widget-item widget-style">
                            <div class="heading-widget">
                                <span class="widget-title">Service Content</span>
                            </div>

                            <div class="widget-content widget-content-padding">
                                <div class="form-group row no-gutters">
                                    @if($errors->has('title'))
                                        <span class="col-12 message-show">{{ $errors->first('title') }}</span>
                                    @endif
                                    {!! Form::text('title',null,[ 'id'=>'title' , 'class'=>'col-12 field-style input-text', 'placeholder'=>'Enter Title', 'required']) !!}
                                    <div class="col-12">{!! Form::label('title',"Title") !!}
                                        <span class="required">(Required)</span></div>
                                </div>


                                <div class="form-group row no-gutters">
                                    {!! Form::text("service_meta[][heading_text]", null,[ 'id'=>'service_meta_heading_text' , 'class'=>'col-12 field-style input-text', 'placeholder'=>'Heading Text', 'required']) !!}
                                    <div class="col-12">{!! Form::label('service_meta_heading_text',"Heading Text") !!}
                                        <span class="required">(Required)</span></div>
                                </div>

                                <div class="form-group">
                                    <div style="margin-bottom: 10px;">{!! Form::label('content_text','Content') !!}
                                        <span class="required">(Required)</span></div>
                                    <textarea class="field-style input-text" id="content_text" name="content_text" placeholder="Enter Content" required>{{ old('content_text') }}</textarea>
                                    @if($errors->has('content_text'))
                                        <span class="col-12 message-show">{{ $errors->first('content_text') }}</span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <div style="margin-bottom: 10px;">{!! Form::label('excerpt','Excerpt') !!}</div>
                                    <textarea class="field-style input-text" id="excerpt" name="excerpt" placeholder="Enter Excerpt">{{ old('excerpt') }}</textarea>
                                    @if($errors->has('excerpt'))
                                        <span class="col-12 message-show">{{ $errors->first('excerpt') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Services Include --}}
                    <div class="col-6">
                        <div class="widget-block widget-item widget-style">
                            <div class="heading-widget">
                                <span class="widget-title">Services Include</span>
                            </div>

                            <div class="widget-content widget-content-padding widget-content-padding-side">
                                <div class="form-group">
                                    <div class="service-inc text-field-repeater">
                                        <div class="field-list small-image row" id="services_include_list"></div>
                                        <div class="add-field center" id="addService">
                                            <span class="icon-plus"></span>Add Service
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Technology List --}}
                    <div class="col-6">
                        <div class="widget-block widget-item widget-style">
                            <div class="heading-widget">
                                <span class="widget-title">Technology List</span>
                            </div>

                            <div class="widget-content widget-content-padding widget-content-padding-side">
                                <div class="form-group">
                                    <div class="technology-items text-field-repeater">
                                        <div class="field-list row small-image" id="technology_items_list"></div>
                                        <div class="add-field center" id="addTechnology">
                                            <span class="icon-plus"></span>Add Technology
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3">
                {{-- Options --}}
                <div class="widget-block widget-item widget-style">
                    <div class="heading-widget">
                        <span class="widget-title">Service Options</span>
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

                            {!! Form::label('status','Publish Status',['class'=>'col-12']) !!}
                        </div>

                        {{-- Service Level --}}
                        <div class="form-group row no-gutters">
                            @if($errors->has('service_level'))
                                <span class="message-show">{{ $errors->first('service_level') }}</span>
                            @endif
                            <div class="col-12 field-style custom-select-field">
                                <select class="form-control" name="service_level" id="service_level">
                                    <option value="">Choose an Option</option>
                                    <option selected value="parent" {{ old('service_level') === "parent" ? "selected" : "" }}>Parent</option>
                                    <option value="child" {{ old('service_level') === "child" ? "selected" : "" }}>Child</option>
                                </select>
                            </div>

                            {!! Form::label('service_level','Service Level',['class'=>'col-12']) !!}
                        </div>

                        {{-- Select Parent Service --}}
                        <div class="form-group row no-gutters">
                            @if($errors->has('parent_id'))
                                <span class="message-show">{{ $errors->first('parent_id') }}</span>
                            @endif
                            <div class="col-12 field-style custom-select-field">
                                <select class="form-control" name="parent_id" id="parent_id">
                                    <option value="">Choose an Option</option>
                                    <option value="">Choose an Option</option>
                                    @forelse($Services as $item)
                                        <option value="{{ $item->id }}" {{ old('parent_id') === $item->id ? "selected" : "" }}>{{ $item->title }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                            {!! Form::label('parent_id','Select Parent',['class'=>'col-12']) !!}
                        </div>

                        {{-- Select Portfolio --}}
                        <div class="form-group row no-gutters">
                            @if($errors->has('portfolio_id'))
                                <span class="message-show">{{ $errors->first('portfolio_id') }}</span>
                            @endif
                            <div class="col-12 field-style custom-select-field">
                                <select class="form-control" name="portfolio_id" id="portfolio_id">
                                    <option value="">Choose an Option</option>
                                    <option value="">Choose an Option</option>
                                    @forelse($Portfolio as $item)
                                        <option value="{{ $item->id }}" {{ old('portfolio_id') === $item->id ? "selected" : "" }}>{{ $item->title }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>

                            {!! Form::label('parent_id','Select Portfolio',['class'=>'col-12']) !!}
                        </div>

                        <button type="submit" class="submit-form-btn create-btn">Create Service</button>
                    </div>
                </div>

                {{-- Thumbnail --}}
                <div class="widget-block widget-item widget-style">
                    <div class="heading-widget">
                        <span class="widget-title">Service Header Banner</span>
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
                                        <input onchange="readURL(this)" name="thumbnail" type="file" class="thumbnail-image" id="thumbnail-image" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Service Icon --}}
                <div class="widget-block widget-item widget-style">
                    <div class="heading-widget">
                        <span class="widget-title">Service Icon</span>
                    </div>

                    <div class="widget-content widget-content-padding widget-content-padding-side">
                        <div class="form-group row no-gutters">
                            @if($errors->has('thumbnail'))
                                <span class="message-show">{{ $errors->first('thumbnail') }}</span>
                            @endif
                            <div class="col-12 field-style custom-select-field">
                                <div class="thumbnail-image-upload">
                                    <div>
                                        <label for="service_meta_icon_service" class="thumbnail-label"><img id="thumbnail-preview" src="{{ asset('public/assets/admin/img/base/icons/image.svg') }}"></label>
                                        <input onchange="readURL(this)" name="service_meta[][icon_service]" type="file" class="thumbnail-image" id="service_meta_icon_service" accept="image/*">
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

    {{-- Add Service Include --}}
    <script>
        jQuery(document).ready(function () {
            var i = 0;
            jQuery("#addService").click(function () {
                i += 1;
                jQuery("#services_include_list").append("<div class='text-field col-12' id='field-service-inc-" + i + "'><div class='row align-items-center'><div class='col-2'><div class=\"thumbnail-image-upload\"><div><label for='thumbnail-image-" + i + "' id='thumbnail-label-" + i + "' class=\"thumbnail-label no-text\"><img id='thumbnail-preview-" + i + "' src=\"{{ asset('public/assets/admin/img/base/icons/image.svg') }}\"></label><input required onchange=\"readURL(this)\" name=\"service_includes[][icon]\" type=\"file\" class=\"thumbnail-image\" id='thumbnail-image-" + i + "' accept=\"image/*\"></div></div></div><div class='col-10'><input placeholder='Service Name...' class='input-field' type=\"text\" name=\"service_includes[][name]\" id=\"service_includes\"> <span class='delete-row icon-close' onclick='delete_service_inc(" + i + ")'><img src='{{ asset('public/assets/admin/img/base/icons') }}/close.svg'></span></div></div>");
                return false;
            });

        });

        function delete_service_inc($id) {
            $('#field-service-inc-' + $id).remove();
        }
    </script>

    {{-- Add Service Technology --}}
    <script>
        jQuery(document).ready(function () {
            var j = 0;
            jQuery("#addTechnology").click(function () {
                j += 1;
                jQuery("#technology_items_list").append("<div class='text-field col-12' id='field-tech-item-" + j + "'><div class='row align-items-center'><div class='col-2'><div class=\"thumbnail-image-upload\"><div><label for='thumbnail-image-tech-" + j + "' id='thumbnail-label-" + j + "' class=\"thumbnail-label no-text\"><img id='thumbnail-preview-text-" + j + "' src=\"{{ asset('public/assets/admin/img/base/icons/image.svg') }}\"></label><input required onchange=\"readURL(this)\" name=\"technology_list[][icon]\" type=\"file\" class=\"thumbnail-image\" id='thumbnail-image-tech-" + j + "' accept=\"image/*\"></div></div></div><div class='col-10'><input placeholder='Technology Name...' class='input-field' type=\"text\" name=\"technology_list[][name]\" id=\"technology_item\"> <span class='delete-row icon-close' onclick='delete_technology_item(" + j + ")'><img src='{{ asset('public/assets/admin/img/base/icons') }}/close.svg'></span></div></div>");
                return false;
            });

        });

        function delete_technology_item($id) {
            $('#field-tech-item-' + $id).remove();
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
