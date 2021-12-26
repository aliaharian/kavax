<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kavax | @yield('page-title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/assets/site/images/base/') }}/favicon.png">


    {{-- Page Style --}}
    <link rel="stylesheet" href="{{ asset('public/assets/site/styles/pages/base/style.min.css') }}">
    <link href="{{ asset('public/assets/site/styles/pages') }}/@yield('page-style')" type="text/css" rel="stylesheet">

    {{-- Page Responsive Style --}}
    <link rel="stylesheet" href="{{ asset('public/assets/site/styles/responsive/base.min.css') }}">
    {{--    <link href="{{ asset('public/assets/site/styles/pages') }}/@yield('page-style-responsive')" type="text/css" rel="stylesheet">--}}

    <script src="{{ asset('public/assets/site/js/theme-libs.js') }}"></script>
    @yield('heading-lib')
</head>
<body class="@yield('body-class')">

<!-- Page Header -->
<header class="page-header">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-lg col-auto">
                <div class="branding">
                    <a href="{{ url('/') }}">
                        <img width="107" src="{{ asset('public/assets/site/images/base/kavax.png') }}" alt="Kavax">
                    </a>
                </div>
                <nav class="main-navigation">
                    <ul>
                        <li class="@if (Request::is('/')) {{ 'active-menu' }}@endif"><a href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="@if (Request::is('about-us')) {{ 'active-menu' }}@endif">
                            <a href="{{ url('about-us') }}">About Us</a></li>
                        <li class="@if (Request::is('our-service') || Request::is('service*')) {{ 'active-menu' }}@endif">
                            <a href="{{ url('services/website-design-and-developing') }}">Our Services</a></li>
                        <li class="@if (Request::is('blog*')) {{ 'active-menu' }}@endif">
                            <a href="{{ url('blog') }}">Blog</a></li>
                        <li class="@if (Request::is('contact-us')) {{ 'active-menu' }}@endif">
                            <a href="{{ url('contact-us') }}">Contact Us</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-lg-auto col right">
                <div class="heading-btn"><a href="{{ url('services-request') }}">Start Your Project</a></div>
                @auth()
                    <div class="heading-btn"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a></div>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    {{--                    <div class="hading-btn"><a href="{{ url('register') }}">Login / Register</a></div>--}}
                @endauth

                <div class="heading-btn responsive-menu" onclick="show_modal('modal-menu')">
                    <span class="icon icon-menu"></span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Page -->
<main class="main-page">
    @yield('content')

    @yield('footer-section')
</main>


<footer class="footer-page">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm col-12">
                <div class="copyright-text">© 2021 KavaX. All Rights Reserved</div>
                <nav class="footer-nav">
                    <ul>
                        <li><a href="#">Website Maintenance</a></li>
                        <li><a href="{{ url('career') }}">Careers</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms and Conditions</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-sm-auto col-12 right">
                <div class="social-media">
                    <a href="#">
                        <span class="icon icon-whatsapp"></span>
                    </a> <a href="#">
                        <span class="icon icon-facebook"></span>
                    </a> <a href="#">
                        <span class="icon icon-youtube"></span>
                    </a> <a href="#">
                        <span class="icon icon-twitter"></span>
                    </a> <a href="#">
                        <span class="icon icon-linkedin"></span>
                    </a> <a href="#">
                        <span class="icon icon-instagram"></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!--<div class="search-btn" onclick="show_modal('modal-search')">-->
<!--	<span class="icon-search search-fn"></span>-->
<!--</div>-->

<!-- Search Modal -->
<div class="website-modal modal-search">
    <div class="modal-block-box search-modal-body">
        <div class="close-btn icon-close"></div>
        <div class="search-form">
            <form action="{{ url('/blog') }}">
                <input class="search-field" type="text" placeholder="Search..." name="s">
                <div class="submit-form">
                    <input type="submit" value="" class="search-submit">
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Menu Modal -->
<div class="website-modal modal-menu">
    <div class="modal-block-box">
        <div class="close-btn icon-close"></div>
        <div class="responsive-navigation">
            <div class="block-inner">
                <div class="branding-block center">
                    <a href="{{ url('/') }}">
                        <img width="150" src="{{ asset('public/assets/site/images/base/kavax.png') }}" alt="Kavax">
                    </a>
                    <div class="desc">A creative web design and branding agency based in London</div>
                </div>

                <nav class="main-navigation">
                    <ul>
                        <li class="@if (Request::is('/')) {{ 'active-menu' }}@endif"><a href="{{ url('/') }}">Home</a></li>
                        <li class="@if (Request::is('services-request')) {{ 'active-menu' }}@endif"><a href="{{ url('services-request') }}">Start Your Project</a></li>
                        <li class="@if (Request::is('about-us')) {{ 'active-menu' }}@endif">
                            <a href="{{ url('about-us') }}">About Us</a></li>
                        <li class="@if (Request::is('our-service') || Request::is('service*')) {{ 'active-menu' }}@endif">
                            <a href="{{ url('services/website-design-and-developing') }}">Our Services</a></li>
                        <li class="@if (Request::is('blog*')) {{ 'active-menu' }}@endif">
                            <a href="{{ url('blog') }}">Blog</a></li>
                        <li class="@if (Request::is('contact-us')) {{ 'active-menu' }}@endif">
                            <a href="{{ url('contact-us') }}">Contact Us</a></li>
                        @auth()
                            <li class="@if (Request::is('contact-us')) {{ 'active-menu' }}@endif"><a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a></li>
                        @else
                        @endauth
                    </ul>
                </nav>

                <div class="social-media center">
                    <div class="row">
                        <div class="col"><a href="#">
                                <span class="icon icon-whatsapp"></span>
                            </a>
                        </div>
                        <div class="col"><a href="#">
                                <span class="icon icon-facebook"></span>
                            </a>
                        </div>
                        <div class="col"><a href="#">
                                <span class="icon icon-youtube"></span>
                            </a>
                        </div>
                        <div class="col"><a href="#">
                                <span class="icon icon-twitter"></span>
                            </a>
                        </div>
                        <div class="col"><a href="#">
                                <span class="icon icon-linkedin"></span>
                            </a>
                        </div>
                        <div class="col"><a href="#">
                                <span class="icon icon-instagram"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@yield('footer-lib')

<script src="{{ asset('public/assets/site/js/footer.js') }}"></script>

</body>
</html>
