@extends('layouts.site.master')
@section('page-title', $OtherPage->title)
@section('page-style', 'other-page/other-page.min.css')

@section('content')
    <!-- Intro Section -->
    <section class="intro-section">
        <div class="section-bg">
            <img class="shape" src="{{ asset('public/assets/site/images/base') }}/heading-bg-shape.png" alt="A young diverse team of digital experts">
            <img class="bg-img" src="@if($OtherPage->thumbnail && isset(\App\Model\Attachments::find($OtherPage->thumbnail)->path)) {{asset('storage/app/other-pages/thumbnail/full').'/'.\App\Model\Attachments::find($OtherPage->thumbnail)->path}} @else{{ asset('public/assets/site/images/base') }}/header-image/about-us.png @endif" alt="{{ $OtherPage->title }}">
        </div>

        <div class="content-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-7 col-sm-9 col-12">
                        <div class="breadcrumb-block">
                            <ul>
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li>{{ $OtherPage->title }}</li>
                            </ul>
                        </div>
                        <div class="title-heading">{{ $OtherPage->heading_text }}</div>
                        <div class="section-text">{{ $OtherPage->excerpt }}</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kavax Statistics -->
    <section class="statistic-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12 text-uppercase statics-col">
                    <div class="statistic-item">
                        <div class="title">Websites launched</div>
                        <div class="value-block">
                            <div class="icon">
                                <svg width="65" height="63" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M38.7 14.393a8.568 8.568 0 0 1 6.036-2.402c4.7.023 8.525 3.836 8.525 8.5a8.495 8.495 0 0 1-2.728 6.216 2.8 2.8 0 0 0-.918 2.043l.007 2.412c.006 1.865-1.034 3.573-2.847 4.467-.123.06-.25.113-.38.156-1.918.641-3.87.166-5.198-1.154a4.84 4.84 0 0 1-1.44-3.468l.006-2.418c0-.763-.32-1.495-.878-2.004a8.473 8.473 0 0 1-2.764-6.427 8.415 8.415 0 0 1 2.578-5.92zm7.684 18.46c.452-.45.7-1.048.699-1.684l-.004-1.16H42.3l-.003 1.161c-.003.91.508 1.742 1.396 2.174.048.023.099.044.15.062.937.32 1.893.091 2.542-.554zM44.69 14.508c-3.317 0-5.962 2.566-6.029 5.856a5.962 5.962 0 0 0 1.944 4.523 5.214 5.214 0 0 1 1.543 2.602h5.088a5.372 5.372 0 0 1 1.567-2.627 5.896 5.896 0 0 0 1.92-4.373c0-3.281-2.691-5.964-5.999-5.98l-.034-.001zm-1.256-5.677a.05.05 0 0 1-.012-.032V6.632c0-1.095 1.41-1.863 2.527-.619a.05.05 0 0 1 .012.033v2.168c0 1.094-1.41 1.863-2.527.618zm-9.522 2.75a1.252 1.252 0 0 1 0-1.78 1.277 1.277 0 0 1 1.796 0l1.55 1.537a.045.045 0 0 1 .014.029c.067 1.136-.632 1.705-1.33 1.705a1.27 1.27 0 0 1-.898-.37zM30.715 21.75c-1.104 0-1.88-1.398-.624-2.506a.05.05 0 0 1 .033-.013h2.186c1.104 0 1.88 1.398.624 2.506a.05.05 0 0 1-.033.013zm25.732-2.506a.05.05 0 0 1 .033-.013h2.185c1.104 0 1.88 1.398.624 2.506a.05.05 0 0 1-.033.013h-2.185c-1.104 0-1.88-1.398-.624-2.506zM53.674 9.8c.781-.774 2.326-.33 2.229 1.334a.048.048 0 0 1-.015.032l-1.55 1.537a1.272 1.272 0 0 1-.897.369c-.7 0-1.398-.57-1.331-1.705 0-.01.005-.02.012-.028zM41.971 49.184v4.683h8.092v8.666H14.951v-8.666h8.092v-4.683H0V0h26.793c1.104 0 1.88 1.398.623 2.506a.05.05 0 0 1-.031.012h-2.859l-3.008 3.554v4.402l3.39 4.004c.342.405.393.98.126 1.439l-3.47 5.962a1.273 1.273 0 0 1-1.32.611l-5.194-.91-3.845 2.204L9.1 29.522H2.54v9.401h59.934V2.518H38.221c-1.103 0-1.88-1.397-.625-2.505A.048.048 0 0 1 37.63 0h27.385v49.184zM2.54 13.518a5.807 5.807 0 0 0 2.2.434c3.18 0 5.766-2.565 5.766-5.717 0-3.152-2.586-5.717-5.766-5.717h-2.2zm0 13.486h4.782l1.654-4.512c.102-.278.3-.51.559-.66l4.644-2.663a1.28 1.28 0 0 1 .857-.15l4.773.837 2.581-4.435-3.115-3.68-.297-.22V5.154l2.233-2.637H10.709a8.167 8.167 0 0 1 2.337 5.717c0 4.54-3.726 8.235-8.306 8.235-.747 0-1.487-.1-2.2-.296zm14.95 29.381v3.63h30.033v-3.63zm21.941-2.518v-4.681H25.583v4.681zm23.043-7.2v-5.225H2.54v5.225zM32.507 0c.701 0 1.27.564 1.27 1.259s-.569 1.259-1.27 1.259c-.701 0-1.27-.564-1.27-1.26 0-.694.569-1.258 1.27-1.258z" fill="#616161"/>
                                </svg>
                            </div>
                            <div class="number count" data-count="300">0</div>
                        </div>
                    </div>
                    <div class="statistic-item">
                        <div class="title">Campaigns worked on</div>
                        <div class="value-block">
                            <div class="icon">
                                <svg width="59" height="66" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M51.471 50c3.783 0 6.86 3.05 6.86 6.8s-3.077 6.801-6.86 6.801c-3.782 0-6.86-3.05-6.86-6.8 0-1.82.726-3.474 1.904-4.696l-3.707-5.135a16.388 16.388 0 0 1-8.466 2.342c-4.181 0-8.001-1.562-10.899-4.127L15.56 52.68a7.934 7.934 0 0 1 1.448 4.574c0 4.427-3.634 8.03-8.1 8.03-4.466 0-8.099-3.603-8.099-8.03s3.633-8.029 8.1-8.029c1.834 0 3.527.609 4.887 1.632l7.883-7.495a16.088 16.088 0 0 1-3.669-9.026h-3.296c-.585 2.645-2.965 4.63-5.806 4.63-3.278 0-5.945-2.643-5.945-5.893S5.63 27.18 8.908 27.18c2.841 0 5.221 1.986 5.806 4.63h3.296a16.104 16.104 0 0 1 3.656-9.037l-7.87-7.483a8.102 8.102 0 0 1-4.888 1.632C4.442 16.92.81 13.319.81 8.89.81 4.465 4.443.864 8.91.864c4.465 0 8.099 3.601 8.098 8.029a7.936 7.936 0 0 1-1.447 4.573l7.87 7.484a16.473 16.473 0 0 1 4.694-2.904 1.278 1.278 0 0 1 1.662.689 1.26 1.26 0 0 1-.694 1.648c-5.214 2.122-8.583 7.104-8.583 12.691 0 3.917 1.666 7.456 4.333 9.957.119-2.905 1.743-5.538 4.304-7.098a5.817 5.817 0 0 1-.749-2.859c0-3.25 2.667-5.893 5.945-5.893 3.278 0 5.945 2.643 5.945 5.893a5.816 5.816 0 0 1-.749 2.859c2.561 1.56 4.185 4.193 4.305 7.098 2.665-2.501 4.331-6.04 4.331-9.957 0-5.587-3.369-10.569-8.582-12.69a1.26 1.26 0 0 1-.695-1.65 1.278 1.278 0 0 1 1.663-.688c.697.284 1.364.613 2.003.98l4.566-6.567a5.843 5.843 0 0 1-1.603-4.02c0-3.25 2.667-5.893 5.945-5.893 3.278 0 5.945 2.643 5.945 5.893s-2.667 5.894-5.945 5.894a5.953 5.953 0 0 1-2.246-.438l-4.561 6.56a16.13 16.13 0 0 1 6.058 12.619c0 4.98-2.273 9.442-5.844 12.424l3.708 5.136A6.865 6.865 0 0 1 51.47 50zM48.075 8.438c0 1.857 1.523 3.367 3.396 3.367s3.397-1.51 3.397-3.367c0-1.856-1.524-3.367-3.397-3.367-1.873 0-3.396 1.51-3.396 3.367zm-33.616.454c0-3.034-2.49-5.503-5.55-5.503-3.061 0-5.551 2.469-5.551 5.503 0 3.034 2.49 5.503 5.55 5.503 3.061 0 5.551-2.469 5.551-5.503zm-2.154 24.181c0-1.857-1.524-3.367-3.397-3.367-1.873 0-3.396 1.51-3.396 3.367s1.524 3.367 3.396 3.367c1.873 0 3.397-1.51 3.397-3.367zm2.154 24.181c0-3.034-2.49-5.503-5.55-5.503-3.061 0-5.551 2.469-5.551 5.503 0 3.034 2.49 5.503 5.55 5.503 3.061 0 5.551-2.469 5.551-5.503zm16.486-24.18c0 1.856 1.524 3.366 3.397 3.366 1.873 0 3.396-1.51 3.396-3.367s-1.523-3.367-3.396-3.367-3.397 1.51-3.397 3.367zM27.631 45.06a13.84 13.84 0 0 0 6.71 1.726c2.435 0 4.723-.628 6.712-1.726a5.85 5.85 0 0 0 .249-1.686c0-2.294-1.35-4.39-3.496-5.516a5.947 5.947 0 0 1-3.464 1.108 5.946 5.946 0 0 1-3.464-1.108c-2.145 1.125-3.495 3.222-3.495 5.516 0 .575.084 1.14.248 1.686zm23.84 16.015c2.378 0 4.312-1.918 4.312-4.275s-1.934-4.274-4.312-4.274c-2.377 0-4.311 1.918-4.311 4.274 0 2.357 1.934 4.275 4.311 4.275zm-17.13-44.24c.704 0 1.275.565 1.275 1.262 0 .698-.57 1.263-1.274 1.263a1.269 1.269 0 0 1-1.274-1.263c0-.697.57-1.263 1.274-1.263z" fill="#616161"/>
                                </svg>
                            </div>
                            <div class="number count" data-count="129">0</div>
                        </div>
                    </div>
                    <div id="counter" class="statistic-item">
                        <div class="title">Current Google rating</div>
                        <div class="value-block">
                            <div class="icon">
                                <svg width="65" height="54" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M65.014 53.57H0V.097h26.793c1.104 0 1.879 1.397.624 2.503a.05.05 0 0 1-.033.013H2.54v8.969h42.187l6.811-6.745c.363-.36.91-.468 1.384-.273.475.194.784.653.784 1.162v5.856h8.768V2.61H38.221c-1.104 0-1.88-1.396-.624-2.502a.05.05 0 0 1 .033-.013h27.384zm-16.59-34.98h3.592l4.538-4.494h-3.592zm-1.795-1.779 4.537-4.493V8.76l-4.537 4.493zm15.845 34.244v-36.96h-2.329l-7.077 7.01h-7.183l-2.023 2.004c3.423 4.02 4.715 9.877 2.125 15.845a13.32 13.32 0 0 1-6.872 6.9C25.99 51.594 13.304 39.032 19.1 26.032c1.363-3.06 3.865-5.486 6.967-6.807 6.026-2.565 11.94-1.285 16 2.105l2.023-2.003v-5.231H2.54v36.96zM38.436 28.483l-1.839 1.82c.782 1.375.881 3.18-.181 4.964a3.378 3.378 0 0 1-1.212 1.195c-4.554 2.628-9.276-2.05-6.62-6.56.291-.495.71-.91 1.208-1.2 1.801-1.05 3.622-.95 5.01-.177l1.838-1.82a7.236 7.236 0 0 0-4.133-1.29c-5.213 0-9.155 5.49-6.24 10.938a5.824 5.824 0 0 0 2.426 2.402c5.501 2.887 11.045-1.017 11.045-6.18a7.073 7.073 0 0 0-1.302-4.092zM33.96 30.93c-2.223-1.543-4.672.883-3.115 3.085.056.08.127.15.207.205 2.223 1.54 4.671-.883 3.116-3.085a.844.844 0 0 0-.208-.205zm-1.454-8.032c2.237 0 4.3.75 5.948 2.007l1.808-1.79c-3.39-2.732-8.272-3.717-13.232-1.549a11.025 11.025 0 0 0-5.678 5.67c-4.695 10.717 5.722 21.034 16.542 16.385A11.03 11.03 0 0 0 43.62 38c2.191-4.912 1.197-9.747-1.562-13.106l-1.808 1.79a9.566 9.566 0 0 1 2.027 5.892c0 6.822-7.167 12.019-14.437 8.592a8.445 8.445 0 0 1-4.01-3.971c-3.46-7.2 1.787-14.298 8.676-14.298zm0-22.803c.701 0 1.27.564 1.27 1.258 0 .694-.569 1.258-1.27 1.258-.701 0-1.27-.564-1.27-1.258 0-.694.569-1.258 1.27-1.258zM8.15 5.84c.7 0 1.27.563 1.27 1.257 0 .695-.57 1.258-1.27 1.258-.702 0-1.27-.563-1.27-1.258 0-.694.568-1.257 1.27-1.257zm5.079 0c.701 0 1.27.563 1.27 1.257 0 .695-.569 1.258-1.27 1.258-.702 0-1.27-.563-1.27-1.258 0-.694.568-1.257 1.27-1.257zm5.079 0c.701 0 1.27.563 1.27 1.257 0 .695-.569 1.258-1.27 1.258-.701 0-1.27-.563-1.27-1.258 0-.694.569-1.257 1.27-1.257z" fill="#616161"/>
                                </svg>
                            </div>
                            <div class="number">
                                <span class="count" data-count="100">0</span>
                                %
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="text-section">{!! $OtherPage->content_text !!}</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Team Section -->
    <section class="our-team-section center">
        <div class="container">
            <div class="section-heading base-color text-color">Meet the team</div>

            <div class="row">
                @if(json_decode($OtherPage->page_meta, true)['team'])
                    @foreach(json_decode($OtherPage->page_meta, true)['team'] as $item)
                        <div class="col-sm-4 col-12">
                            <div class="team-item">
                                <div class="item-inner">
                                    <div class="avatar">
                                        <img src="@if($item['image'] && isset(\App\Model\Attachments::find($item['image'])->path)) {{asset('storage/app/other-pages/team').'/'.\App\Model\Attachments::find($item['image'])->path}} @else{{ asset('public/assets/admin/img/base/icons/image.svg') }}@endif" alt="{{ $item['name'] }}">
                                    </div>
                                    <div class="name">{{ $item['name'] }}</div>
                                    <div class="job-position">{{ $item['job'] }}</div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section class="portfolio-section">
        <div class="section-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xl-auto col-8">
                        <a href="#" class="item-inner">
                            <span class="thumbnail"><img src="{{ asset('public/assets/site/images/example') }}/portfolio-1.png" alt="Portfolio 1"></span>
                        </a>
                    </div>
                    <div class="col-xl col-4">
                        <div class="row g-4">
                            <div class="col-12">
                                <a href="#" class="item-inner">
                                    <span class="thumbnail"><img src="{{ asset('public/assets/site/images/example') }}/portfolio-2.png" alt="Portfolio 1"></span>
                                </a>
                            </div>
                            <div class="col-12">
                                <a href="#" class="item-inner">
                                    <span class="thumbnail"><img src="{{ asset('public/assets/site/images/example') }}/portfolio-3.png" alt="Portfolio 1"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Your Project -->
    <section class="section-galaxy-bg request-section m-0">
        <div class="section-inner">
            <div class="container">
                <div class="section-title center">Ready to Skyrocket Your Business?</div>
                <div class="row center">
                    <div class="col-sm-6">
                        <div class="request-col">
                            <div class="title-item">Start your project</div>
                            <div class="cta-link"><a href="{{ url('services-request') }}">Submit your brief</a></div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="request-col">
                            <div class="title-item">We're hiring</div>
                            <div class="cta-link"><a href="{{ url('contact-us') }}">join the team</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer-section')
    @include('layouts.site.sections.review-client')
@endsection

@section('footer-lib')
    <!-- Counter -->
    <script>
        var a = 0;
        $(window).scroll(function () {
            var oTop = $('#counter').offset().top - window.innerHeight;
            if (a == 0 && $(window).scrollTop() > oTop) {
                $('.count').each(function () {
                    var $this = $(this),
                        countTo = $this.attr('data-count');
                    $({
                        countNum: $this.text()
                    }).animate({
                            countNum: countTo
                        },
                        {
                            duration: 2000,
                            easing: 'swing',
                            step: function () {
                                $this.text(Math.floor(this.countNum));
                            },
                            complete: function () {
                                $this.text(this.countNum);
                            }
                        });
                });
                a = 1;
            }
        });
    </script>
@endsection
