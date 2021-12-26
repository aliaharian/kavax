@extends('layouts.admin.dashboard.master')

@section('page-title', 'Create New Portfolio')

@section('title-page')
    <span class="icon"><svg viewBox="0 -31 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M497.0938 60.004c-.0313 0-.0625-.004-.0938-.004H361V45c0-24.8125-20.1875-45-45-45H196c-24.8125 0-45 20.1875-45 45v15H15C6.6484 60 0 66.8438 0 75v330c0 24.8125 20.1875 45 45 45h422c24.8125 0 45-20.1875 45-45V75.2578c-.5742-9.8516-6.6328-15.1992-14.9063-15.2539zM181 45c0-8.2695 6.7305-15 15-15h120c8.2695 0 15 6.7305 15 15v15H181zm295.1875 45-46.582 139.7422A14.9747 14.9747 0 0 1 415.3789 240H331v-15c0-8.2852-6.7148-15-15-15H196c-8.2852 0-15 6.7148-15 15v15H96.621a14.9747 14.9747 0 0 1-14.2265-10.2578L35.8125 90zM301 240v30h-90v-30zm181 165c0 8.2695-6.7305 15-15 15H45c-8.2695 0-15-6.7305-15-15V167.4336l23.9336 71.7969C60.0664 257.6367 77.2226 270 96.621 270H181v15c0 8.2852 6.7148 15 15 15h120c8.2852 0 15-6.7148 15-15v-15h84.379c19.3983 0 36.5546-12.3633 42.6874-30.7695L482 167.4335zm0 0"/></svg></span>
    <span class="text">Create New Portfolio</span>
@endsection

@section('content')
    <section class="form-section">
        {!! Form::open(['route'=>'portfolio.store', 'id'=>'form', 'enctype' => 'multipart/form-data']) !!}
        <div class="row">
            <div class="col-9">
                <div class="row">
                    {{-- Content --}}
                    <div class="col-12">
                        <div class="widget-block widget-item widget-style">
                            <div class="heading-widget">
                                <span class="widget-title">Portfolio Title</span>
                            </div>

                            <div class="widget-content widget-content-padding">
                                <div class="form-group">
                                    @if($errors->has('title'))
                                        <span class="message-show">{{ $errors->first('title') }}</span>
                                    @endif
                                    {!! Form::text('title',null,[ 'id'=>'title' , 'class'=>'field-style input-text', 'placeholder'=>'Enter Title', 'required']) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Portfolio --}}
                    <div class="col-12">
                        <div class="widget-block widget-item widget-style">
                            <div class="heading-widget">
                                <span class="widget-title">Portfolio Image List</span>
                            </div>

                            <div class="widget-content widget-content-padding widget-content-padding-side">
                                <div class="form-group">
                                    <div class="portfolio-items text-field-repeater">
                                        <div class="field-list row small-image" id="portfolio_items_list"></div>
                                        <div class="add-field center" id="addPortfolio">
                                            <span class="icon-plus"></span>Add Image
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
                        <span class="widget-title">Portfolio Options</span>
                    </div>

                    <div class="widget-content widget-content-padding widget-content-padding-side">
                        <button type="submit" class="submit-form-btn create-btn">Create Portfolio</button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </section>
@endsection


@section('footer')
    {{-- Add Portfolio --}}
    <script>
        jQuery(document).ready(function () {
            var j = 0;
            jQuery("#addPortfolio").click(function () {
                j += 1;
                jQuery("#portfolio_items_list").append("<div class='text-field col-12' id='field-portfolio-item-" + j + "'><div class='row align-items-center'><div class='col-2'><div class=\"thumbnail-image-upload\"><div><label for='thumbnail-image-portfolio-" + j + "' id='thumbnail-label-" + j + "' class=\"thumbnail-label no-text\"><img id='thumbnail-preview-text-" + j + "' src=\"{{ asset('public/assets/admin/img/base/icons/image.svg') }}\"></label><input required onchange=\"readURL(this)\" name=\"portfolio[][image]\" type=\"file\" class=\"thumbnail-image\" id='thumbnail-image-portfolio-" + j + "' accept=\"image/*\"></div></div></div><div class='col-10'><input placeholder='Portfolio Tag...' class='input-field' type=\"text\" name=\"portfolio[][name]\" id=\"portfolio_item\"> <span class='delete-row icon-close' onclick='delete_portfolio_item(" + j + ")'><img src='{{ asset('public/assets/admin/img/base/icons') }}/close.svg'></span></div></div>");
                return false;
            });

        });

        function delete_portfolio_item($id) {
            $('#field-portfolio-item-' + $id).remove();
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
