@extends('layouts.site.master')@section('page-title', '')@section('page-style', 'index/index.min.css')

@section('content')
    <!-- Intro Section -->
    <section class="intro-section">
        <div class="cover show-video" onclick="playVideo()">
            <video style="pointer-events: none" autoplay muted loop playsinline width="100%">
                <source src="{{ asset('public/assets/site/video/cover.mov') }}" type="video/mp4">
            </video>
        </div>
        <div class="video-play">
            <video style="pointer-events: none" muted playsinline width="100%" id="myVideo">
                <source src="{{ asset('public/assets/site/video/play.mov') }}" type="video/mp4">
            </video>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section center">
        <div class="container">
            <div class="section-heading">KAVAX SERVICES</div>
            <div class="row align-items-end justify-content-center service-list">
                <div class="col-md-4 col-sm-6 col-12">
                    <a href="#" class="item-inner">
						<span class="service-image">
                            <span class="static-img">
							    <img width="175" src="{{ asset('public/assets/site/images/base/services/digital-marketing.png') }}" alt="Digital Marketing">
                            </span>
                            <span class="animate-media digital-marketing">
							    <img width="175" src="{{ asset('public/assets/site/images/base/services/digital-marketing.gif') }}" alt="Digital Marketing">
                            </span>
						</span>
                        <span class="service-name">Digital Marketing</span>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <a href="#" class="item-inner">
						<span class="service-image">
                            <span class="static-img">
							    <img width="238" src="{{ asset('public/assets/site/images/base/services/mobile.png') }}" alt="App Development">
                            </span>
                            <span class="animate-media mobile">
							    <img width="238" src="{{ asset('public/assets/site/images/base/services/app-development-new.gif') }}" alt="Digital Marketing">
                            </span>
						</span>
                        <span class="service-name">App Development</span>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <a href="#" class="item-inner">
						<span class="service-image">
                            <span class="static-img">
							    <img width="195" src="{{ asset('public/assets/site/images/base/services/video.png') }}" alt="Video Marketing">
                            </span>
                            <span class="animate-media video">
                                <img width="238" src="{{ asset('public/assets/site/images/base/services/video-marketing.gif') }}" alt="Digital Marketing">
                            </span>
						</span>
                        <span class="service-name">Video Marketing</span>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <a href="#" class="item-inner">
						<span class="service-image">
                            <span class="static-img">
							    <img width="230" src="{{ asset('public/assets/site/images/base/services/content.png') }}" alt="Content">
                            </span>
                            <span class="animate-media content">
							    <img width="230" src="{{ asset('public/assets/site/images/base/services/content.gif') }}" alt="Content">
                            </span>
						</span>
                        <span class="service-name">Content</span>
                    </a>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <a href="#" class="item-inner">
						<span class="service-image">
                            <span class="static-img">
							    <img width="230" src="{{ asset('public/assets/site/images/base/services/website.png') }}" alt="Website Development">
                            </span>
                            <span class="animate-media website">
							    <img width="175" src="{{ asset('public/assets/site/images/base/services/website-development.gif') }}" alt="Digital Marketing">
                            </span>
						</span>
                        <span class="service-name">Website Development</span>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="section-galaxy-bg about-section">
        <div class="section-heading center">ABOUT KAVAX</div>

        <div class="section-inner">
            <div class="container">
                <div class="section-title center">A creative web design and branding agency based in London</div>
                <div class="row align-items-center">
                    <div class="col-md-6 col-12">
                        <div class="about-us-image">
                            <img src="{{ asset('public/assets/site/images/base/about-us-image-section.png') }}" alt="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.">
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="about-us-text">KavaX is a progressive and insightful design agency, technically and creatively skilled to translate your brand into its best digital self. Our design and development approach creates impactful, engaging brands and immersive digital experiences that bring you a return on creativity.</div>
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
    <!-- Video Controller -->
    <script>
        var video = document.getElementById("myVideo");

        $('.intro-section').click(function () {
            $(this).toggleClass('show-video');
            $('.intro-section .video-play').toggleClass('show-video');
            video.currentTime = 0;
            video.pause();
        });

        function playVideo() {
            setTimeout(function () {
                if (video.paused) {
                    video.play();
                } else {
                    video.pause();
                }
            }, 100);
        }
    </script>
@endsection
