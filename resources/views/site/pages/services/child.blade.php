@extends('layouts.site.master')@section('page-title', $Services->title)@section('page-style', 'services/services.min.css')

@section('content')
    <!-- Intro Section -->
    <section class="intro-section">
        <div class="section-bg">
            <img class="shape" src="{{ asset('public/assets/site/images/base') }}/heading-bg-shape.png" alt="{{ $Services->title }}">
            <img class="bg-img" src="{{ asset('public/assets/site/images/base') }}/header-image/services-bg.png" alt="{{ $Services->title }}">
        </div>

        <div class="content-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-sm-8 col-12">
                        <div class="breadcrumb-block">
                            <ul>
                                <li><a href="{{ url('') }}">Home</a></li>
                                @if(isset($Services->parent_id))
                                    <li><a href="{{ $ParentService->slug }}">{{ $ParentService->title }}</a>
                                    </li>
                                @endif
                                <li>{{ $Services->title }}</li>
                            </ul>
                        </div>
                        <div class="title-heading">{{ json_decode($Services->service_meta, true)['heading_text'] }}</div>
                        <div class="section-text">{{ $Services->excerpt }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section services-main gradient-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="services-include">
                        <div class="heading base-color text-color text-uppercase">Services Include:</div>
                        <div class="services-list center">
                            <div class="row align-items-end justify-content-center">
                                @forelse(json_decode($Services->service_includes, true) as $item)
                                    <div class="col-sm-4 col-6">
                                        <div class="item-inner">
                                            <div class="icon">
                                                <img src="@if($item['icon'] && isset(\App\Model\Attachments::find($item['icon'])->path)) {{asset('storage/app/services/service-include').'/'.\App\Model\Attachments::find($item['icon'])->path}} @else{{ asset('public/assets/admin/img/base/icons/image.svg') }}@endif" alt="{{ $item['name'] }}">
                                            </div>
                                            <div class="service-name">{{ $item['name'] }}</div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>

                    <div class="services-include">
                        <div class="heading base-color text-color text-uppercase">Our Development Technologies:</div>
                        <div class="services-list center">
                            <div class="row align-items-end justify-content-center">
                                @forelse(json_decode($Services->technology_list, true) as $item)
                                    <div class="col-sm-4 col-6">
                                        <div class="item-inner">
                                            <div class="icon">
                                                <img src="@if($item['icon'] && isset(\App\Model\Attachments::find($item['icon'])->path)) {{asset('storage/app/services/technology').'/'.\App\Model\Attachments::find($item['icon'])->path}} @else{{ asset('public/assets/admin/img/base/icons/image.svg') }}@endif" alt="{{ $item['name'] }}">
                                            </div>
                                            <div class="service-name">{{ $item['name'] }}</div>
                                        </div>
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="service-content">
                        <div class="heading">{{ $Services->title }}</div>
                        <div class="content-text">
                            {!! $Services->content_text !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section class="portfolio-section colored-gradient">
        <div class="section-inner">
            <div class="container">
                <div class="heading text-uppercase center">Portfolio</div>

                <div class="gallery-block">
                    <div class="gallery">
                        <ul class="gallery-filter js-filter">
                            <li class="active"><a href="#" data-filter=".all">All</a></li>
                            @foreach($Grid as $key => $item)
                                <li class="text-capitalize">
                                    <a href="#" data-filter=".{{ preg_replace("/\s+/", "", $key) }}">{{ $key }}</a></li>
                            @endforeach
                        </ul>
                        <ul class="gallery-list js-gallery">
                            @foreach($Portfolio as $item)
                                <li class="gallery-item all {{ preg_replace("/\s+/", "", $item['name']) }}">
                                    <a href="#" data-original-width="800" data-original-height="1200"><img src="{{asset('storage/app/portfolio/thumbnail').'/'.\App\Model\Attachments::find($item['image'])->path}}" width="482" height="203" alt=""></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('footer-lib')
    <script src="{{ asset('public/assets/site/js') }}/isotope.pkgd.min.js"></script>

    <script>
        setTimeout(function (){
            (function ($) {
                var $gallery = $('.js-gallery');
                var $filter = $('.js-filter');
                var $isotope = $gallery.isotope();

                var filter = '.all';
                var items = [];
                var options = {
                    getThumbBoundsFn: function (index) {
                        var _img = $gallery.find(filter).eq(index).find('img')[0];
                        var _rect = _img.getBoundingClientRect();
                        var _scroll = window.pageYOffset || document.documentElement.scrollTop;
                        return {x: _rect.left, y: _rect.top + _scroll, w: _rect.width};
                    },
                };

                // Generate PID (Use for history)
                $gallery.find('.gallery-item').each(function (i, el) {
                    var index = i + 1; // Do this fo
                    var $link = $(el).find('a');
                    $link.attr('data-pid', index);
                });

                // Update Items on loaded
                updateItems(filter);

                // Bind click event to a tag for get index then open Gallery
                $gallery.on('click', 'a', function (event) {
                    event.preventDefault();

                    options.index = $(this).parent('.gallery-item').index(filter);
                    openGallery(items, options);
                });

                // Bind click event to a tag for filter gallery by isotope then update items object
                $filter.on('click', 'a', function (event) {
                    event.preventDefault();

                    filter = this.dataset.filter;
                    $isotope.isotope({
                        filter: filter
                    });
                    updateItems(filter);

                    $(this).parent('li').addClass('active').siblings().removeClass('active');
                });

                // Open image from hash
                if (window.location.hash) {
                    var hash = window.location.hash;
                    var params = hash.split('&');
                    var pid;
                    params.forEach(function (el, i) {
                        var param = el.split('=');
                        if (param[0] === 'pid') {
                            pid = param[1];
                        }
                    });
                    options.index = Number(pid - 1);
                    openGallery(items, options);
                }

                // Open gallery with items object and options
                function openGallery(items, options) {
                    var markup = $('.pswp').get(0);
                    var gallery = new PhotoSwipe(markup, PhotoSwipeUI_Default, items, options);
                    gallery.init();
                }

                // Update items object with filter select by class
                function updateItems(selector) {
                    items = [];
                    $gallery.find(selector).each(function (idx, el) {
                        var _link = $(el).find('a').get(0);
                        var source = _link.href;
                        var width = _link.dataset.originalWidth;
                        var height = _link.dataset.originalHeight;
                        var caption = _link.dataset.caption;
                        var pid = _link.dataset.pid;
                        var item = {
                            src: source,
                            w: width,
                            h: height,
                            title: caption,
                            msrc: source,
                            pid: pid,
                        }
                        items.push(item);
                    });
                }
            })(jQuery);
        },500)
    </script>
@endsection
