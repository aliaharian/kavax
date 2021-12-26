@extends('layouts.admin.dashboard.master')

@section('lib')
    <script src="{{ url('') }}/app/lib/ckeditor/ckeditor.js"></script>
    <script src="{{ url('') }}/app/lib/ckeditor/config.js"></script>
@endsection

@section('page-title', 'Service Edit')

@section('title-page')
    <span class="icon"><svg height="512" viewBox="0 0 32 32" width="512" xmlns="http://www.w3.org/2000/svg"><path d="M23.5 30c-1.93 0-3.5-1.57-3.5-3.5V13.367c-1.865-1.189-3-3.234-3-5.473 0-2.45 1.358-4.666 3.544-5.785.311-.158.681-.145.978.037.297.183.478.505.478.854v4.323l1.5.6 1.5-.6V3c0-.349.181-.671.478-.854.297-.182.667-.195.978-.037C28.642 3.229 30 5.444 30 7.895c0 2.238-1.135 4.283-3 5.473V26.5c0 1.93-1.57 3.5-3.5 3.5zM20 5.066c-.637.785-1 1.775-1 2.828 0 1.694.941 3.229 2.456 4.005a1 1 0 0 1 .544.89V26.5c0 .827.673 1.5 1.5 1.5s1.5-.673 1.5-1.5V12.789a1 1 0 0 1 .544-.89C27.059 11.123 28 9.589 28 7.895c0-1.053-.363-2.043-1-2.828V8c0 .409-.249.776-.628.929l-2.5 1a.9944.9944 0 0 1-.743 0l-2.5-1C20.249 8.776 20 8.409 20 8z"/><path d="M17.074 30h-2.147c-1.039 0-1.915-.811-1.994-1.846l-.126-1.635c-.686-.208-1.35-.484-1.985-.824l-1.246 1.067c-.789.677-1.981.63-2.715-.103l-1.52-1.521c-.734-.734-.78-1.927-.104-2.716l1.067-1.245c-.34-.635-.616-1.299-.824-1.985l-1.634-.125C2.811 18.989 2 18.113 2 17.074v-2.148c0-1.039.811-1.915 1.847-1.994l1.634-.125c.208-.687.484-1.351.824-1.985L5.237 9.575c-.676-.788-.63-1.98.105-2.716L6.86 5.34c.735-.735 1.928-.78 2.716-.104l1.246 1.067c.635-.34 1.299-.616 1.985-.824l.126-1.635C13.012 2.811 13.888 2 14.926 2H16c.552 0 1 .447 1 1s-.448 1-1 1h-1.074l-.18 2.341c-.034.436-.347.799-.772.897-.967.223-1.887.604-2.734 1.135a.9948.9948 0 0 1-1.181-.089L8.274 6.755l-1.518 1.52 1.529 1.784c.285.332.32.811.088 1.181-.53.848-.912 1.768-1.135 2.734a.999.999 0 0 1-.898.772l-2.34.18v2.148l2.34.18c.436.033.8.347.898.772.223.967.604 1.887 1.135 2.734.232.37.196.849-.088 1.181l-1.529 1.784 1.519 1.52 1.784-1.529a.9978.9978 0 0 1 1.181-.089c.848.53 1.768.912 2.734 1.135.426.099.739.462.772.897l.18 2.341h2.147c.042-.55.521-.961 1.074-.92.551.042.963.523.92 1.074-.079 1.035-.955 1.846-1.993 1.846z"/><path d="M9 16c0-3.434 2.454-6.337 5.835-6.903.543-.097 1.061.276 1.151.821.091.545-.276 1.06-.821 1.151C12.752 11.474 11 13.548 11 16c0 3.453 3.43 5.861 6.667 4.716.518-.185 1.092.087 1.277.608.184.521-.088 1.092-.609 1.276C13.782 24.211 9 20.816 9 16z"/></svg></span>
    <span class="text">Service Edit</span>
@endsection

@section('content')
    <section class="form-section">
        <form action="{{ route('services.update' , $Services->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
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
                                        {!! Form::text('title',$Services->title,[ 'id'=>'title' , 'class'=>'col-12 field-style input-text', 'placeholder'=>'Title', 'required']) !!}
                                        <div class="col-12">{!! Form::label('title',"Title") !!}
                                            <span class="required">(Required)</span></div>
                                    </div>

                                    <div class="form-group row no-gutters">
                                        {!! Form::text("service_meta[][heading_text]",json_decode($Services->service_meta, true)['heading_text'],[ 'id'=>'service_meta_heading_text' , 'class'=>'col-12 field-style input-text', 'placeholder'=>'Heading Text', 'required']) !!}
                                        <div class="col-12">{!! Form::label('service_meta_heading_text',"Heading Text") !!}
                                            <span class="required">(Required)</span></div>
                                    </div>

                                    <div class="form-group">
                                        <div style="margin-bottom: 10px;">{!! Form::label('content_text','Content') !!}
                                            <span class="required">(Required)</span></div>
                                        <textarea required class="field-style input-text" id="content_text" name="content_text" placeholder="Enter Content">{{ $Services->content_text }}</textarea>
                                        @if($errors->has('content_text'))
                                            <span class="col-12 message-show">{{ $errors->first('content_text') }}</span>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <div style="margin-bottom: 10px;">{!! Form::label('excerpt','Excerpt') !!}</div>
                                        <textarea class="field-style input-text" id="excerpt" name="excerpt" placeholder="Enter Excerpt">{{ $Services->excerpt }}</textarea>
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
                                            <div class="field-list small-image row" id="services_include_list">
                                                @php $service_include_count = 0; @endphp
                                                @if($Services->service_includes)
                                                    @foreach(json_decode($Services->service_includes, true) as $item)
                                                        <div class='text-field col-12' id='field-service-inc-{{ $service_include_count += 1 }}'>
                                                            <div class='row align-items-center'>
                                                                <div class='col-2'>
                                                                    <div class="thumbnail-image-upload">
                                                                        <div>
                                                                            <label for='thumbnail-image-{{ $service_include_count }}' id='thumbnail-label-{{ $service_include_count }}' class="thumbnail-label no-text"><img id='thumbnail-preview-{{ $service_include_count }}' src="@if($item['icon'] && isset(\App\Model\Attachments::find($item['icon'])->path)) {{asset('storage/app/services/service-include').'/'.\App\Model\Attachments::find($item['icon'])->path}} @else{{ asset('public/assets/admin/img/base/icons/image.svg') }}@endif"></label>
                                                                            <input value="{{ $item['icon'] }}" onchange="readURL(this)" name="service_includes[][icon]" type="file" class="thumbnail-image" id='thumbnail-image-{{ $service_include_count }}' accept="image/*">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='col-10'>
                                                                    <input value="{{ $item['name'] }}" placeholder='Service Name...' class='input-field' type="text" name="service_includes[][name]" id="service_includes">
                                                                    <span class='delete-row icon-close' onclick='delete_service_inc({{ $service_include_count }})'><img src='{{ asset('public/assets/admin/img/base/icons') }}/close.svg'></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="add-field center" id="addService">
                                                <span class="icon-plus"></span>Add Service
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Services Technology --}}
                        <div class="col-6">
                            <div class="widget-block widget-item widget-style">
                                <div class="heading-widget">
                                    <span class="widget-title">Technology List</span>
                                </div>

                                <div class="widget-content widget-content-padding widget-content-padding-side">
                                    <div class="form-group">
                                        <div class="technology-items text-field-repeater">
                                            <div class="field-list row small-image" id="technology_items_list">
                                                @php $technology_list_count = 0; @endphp
                                                @if($Services->technology_list)
                                                    @foreach(json_decode($Services->technology_list, true) as $item)
                                                        <div class='text-field col-12' id='field-tech-item-{{ $technology_list_count += 1 }}'>
                                                            <div class='row align-items-center'>
                                                                <div class='col-2'>
                                                                    <div class="thumbnail-image-upload">
                                                                        <div>
                                                                            <label for='thumbnail-image-tech-{{ $technology_list_count }}' id='thumbnail-label-tech-{{ $technology_list_count }}' class="thumbnail-label no-text"><img id='thumbnail-preview-{{ $technology_list_count }}' src="@if($item['icon'] && isset(\App\Model\Attachments::find($item['icon'])->path)) {{asset('storage/app/services/technology').'/'.\App\Model\Attachments::find($item['icon'])->path}} @else{{ asset('public/assets/admin/img/base/icons/image.svg') }}@endif"></label>
                                                                            <input value="{{ $item['icon'] }}" onchange="readURL(this)" name="technology_list[][icon]" type="file" class="thumbnail-image" id='thumbnail-image-tech-{{ $technology_list_count }}' accept="image/*">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class='col-10'>
                                                                    <input value="{{ $item['name'] }}" placeholder='Technology Name...' class='input-field' type="text" name="technology_list[][name]" id="technology_item_tech_name_{{ $technology_list_count }}">
                                                                    <span class='delete-row icon-close' onclick='delete_technology_item({{ $technology_list_count }})'><img src='{{ asset('public/assets/admin/img/base/icons') }}/close.svg'></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
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
                    {{-- Post Options --}}
                    <div class="widget-block widget-item widget-style">
                        <div class="heading-widget">
                            <div class="row align-items-center">
                                <div class="col-10"><span class="widget-title">Post Options</span></div>
                                <div class="col-2 left">
                                    <a target="_blank" href="{{ Url("services/$Services->slug") }}"><span class="icon"><img width="100%" src="{{ asset('public/assets/admin/img/base/icons/show.svg') }}"></span></a>
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
                                        <option @if(old('status') == 'published') selected @else @if($Services->status == 'published') selected @endif @endif value="published">Publish</option>
                                        <option @if(old('status') == 'draft') selected @else @if($Services->status == 'draft') selected @endif @endif value="draft">Draft</option>
                                    </select>
                                </div>

                                {{-- Publish Status --}}
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
                                        <option @if(old('service_level') == 'parent') selected @else @if($Services->service_level == 'parent') selected @endif @endif value="parent" {{ old('service_level') === "parent" ? "selected" : "" }}>Parent</option>
                                        <option @if(old('service_level') == 'child') selected @else @if($Services->service_level == 'child') selected @endif @endif value="child" {{ old('service_level') === "child" ? "selected" : "" }}>Child</option>
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
                                        @forelse($ParentServices as $item)
                                            <option @if(old('parent_id') == $item->id) selected @else @if($Services->parent_id == $item->id) selected @endif @endif value="{{ $item->id }}" {{ old('parent_id') === $item->id ? "selected" : "" }}>{{ $item->title }}</option>
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
                                            <option @if(old('portfolio_id') == $item->id) selected @else @if($Services->portfolio_id == $item->id) selected @endif @endif value="{{ $item->id }}" {{ old('portfolio_id') === $item->id ? "selected" : "" }}>{{ $item->title }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>

                                {!! Form::label('portfolio_id','Select Portfolio',['class'=>'col-12']) !!}
                            </div>

                            <button type="submit" class="submit-form-btn">Update Service</button>
                        </div>
                    </div>

                    {{-- Thumbnail --}}
                    <div class="widget-block widget-item widget-style">
                        <div class="heading-widget">
                            <span class="widget-title">Service Header Banner</span>
                        </div>

                        <div class="widget-content widget-content-padding widget-content-padding-side">
                            <div class="form-group row no-gutters">
                                <div class="col-12 field-style custom-select-field">
                                    <div class="thumbnail-image-upload">
                                        <div>
                                            <label for="thumbnail-image" id="thumbnail-label" class="thumbnail-label"><img id="thumbnail-preview" src="@if($Services->thumbnail && isset(\App\Model\Attachments::find($Services->thumbnail)->path)) {{asset('storage/app/services/thumbnail/636').'/'.\App\Model\Attachments::find($Services->thumbnail)->path}} @else{{ asset('public/assets/admin/img/base/icons/image.svg') }}@endif"></label>
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
                                            <label for="service_meta_icon_service" class="thumbnail-label"><img id="thumbnail-preview" src="@if(isset(json_decode($Services->service_meta, true)['icon_service']) && isset(\App\Model\Attachments::find(json_decode($Services->service_meta, true)['icon_service'])->path)) {{asset('storage/app/services/service-icon').'/'.\App\Model\Attachments::find(json_decode($Services->service_meta, true)['icon_service'])->path}} @else{{ asset('public/assets/admin/img/base/icons/image.svg') }}@endif"></label>
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

    {{-- Add Service Include --}}
    <script>
        jQuery(document).ready(function () {
            var i = {{ $service_include_count }};
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
            var j = {{ $technology_list_count }};
            jQuery("#addTechnology").click(function () {
                j += 1;
                jQuery("#technology_items_list").append("<div class='text-field col-12' id='field-tech-item-" + j + "'><div class='row align-items-center'><div class='col-2'><div class=\"thumbnail-image-upload\"><div><label for='thumbnail-image-tech-" + j + "' id='thumbnail-label-tech-" + j + "' class=\"thumbnail-label no-text\"><img id='thumbnail-preview-text-" + j + "' src=\"{{ asset('public/assets/admin/img/base/icons/image.svg') }}\"></label><input required onchange=\"readURL(this)\" name=\"technology_list[][icon]\" type=\"file\" class=\"thumbnail-image\" id='thumbnail-image-tech-" + j + "' accept=\"image/*\"></div></div></div><div class='col-10'><input placeholder='Technology Name...' class='input-field' type=\"text\" name=\"technology_list[][name]\" id=\"technology_item_tech_name_\"> <span class='delete-row icon-close' onclick='delete_technology_item(" + j + ")'><img src='{{ asset('public/assets/admin/img/base/icons') }}/close.svg'></span></div></div>");
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
