<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Kavax | @yield('page-title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('resources/views/layouts') }}/favicon-admin.svg">

    {{-- Library --}}
    <script src="{{ asset('public/assets/admin') }}/js/jquery.min.js"></script>
    <script src="{{ asset('public/assets/admin') }}/js/bootstrap.min.js"></script>

    {{-- Notifier --}}
    <link href="{{ asset('public/assets/admin') }}/css/notifi/style.css" rel="stylesheet" type="text/css">
    <script src="{{ asset('public/assets/admin') }}/css/notifi/index.var.js"></script>

    {{-- Web Admin --}}
    <link href="{{ asset('public/assets/admin') }}/css/admin-style.min.css" rel="stylesheet" type="text/css">
    <script src="{{ asset('public/assets/admin') }}/js/admin.js"></script>

    {{-- Library Storage --}}
    @yield('lib')
</head>
<body>
<main class="main-admin">
    <div class="row no-gutters">
        <aside class="col-2 sidebar-col">
            <div class="sidebar">
                <div class="sidebar CustomScrollbar">
                    @include('layouts.admin.dashboard.section.sidebar')
                    @yield('sidebar')
                </div>
                <span class="version">Rocket CMS - v{{ env('APP_VERSION') }} <img style="margin-right: 2px" width="12px" src="{{ asset('public/assets/admin/img/base/icons/rocket.svg') }}"></span>
                <span class="update">Last Update: {{ env('APP_LAST_VERSION') }}</span>
            </div>
        </aside>

        <article class="col-10 content-page">
            <div class="heading-content-section">
                <div class="heading-inner">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h2 class="title-page">@yield('title-page')</h2>
                        </div>
                        <div class="col-3 right head-btn-col">
                            <div class="header-btn profile-btn">
                                <div class="icon">
                                    <i class="zmdi zmdi-account-o"></i>
                                </div>

                                <div class="menu-drop-down-header">
                                    <ul>
                                        <li>
                                            <a href="{{ Url('dashboard/users'. '/' . auth()->user()->id) . '/edit' }}">
                                                <i class="zmdi zmdi-account-box-o"></i>
                                                <span class="text">My Profile</span> </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="zmdi zmdi-power"></i> <span class="text">Sign Out</span> </a>
                                        </li>
                                    </ul>
                                </div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
{{--                            @if (auth()->user()->role == "super_admin")--}}
{{--                                <div class="header-btn notification-btn">--}}
{{--                                    <div class="icon">--}}
{{--                                        <a href="{{ Url('dashboard/notify') }}">--}}
{{--                                            <i class="zmdi zmdi-notifications-none  notification-icon "></i>--}}
{{--                                            <span class="badge-icon-header light-mode">3</span> </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}
{{--                            <div class="header-btn notification-btn">--}}
{{--                                <div class="icon">--}}
{{--                                    <a href="{{ Url('dashboard/support') }}">--}}
{{--                                        <i style="font-size: 20px; height: 22px" class="zmdi zmdi-headset-mic"></i>--}}
{{--                                        <span class="badge-icon-header badge-icon-default light-mode">3</span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="header-btn wallet-btn">--}}
{{--                                <div class="icon">--}}
{{--                                    <a href="{{ Url('dashboard/payments') }}">--}}
{{--                                        <i class="zmdi zmdi-card"></i><span class="badge-icon-header badge-icon-green light-mode">5</span>--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="header-btn wallet-btn">
                                <div class="icon">
                                    <a target="_blank" href="{{ Url('/') }}"><i class="zmdi zmdi-wallpaper"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content-page">
                @yield('content')
            </div>
        </article>
    </div>
</main>

@yield('footer')

<script src="{{ asset('public/assets/admin') }}/js/footer.js"></script>

@php
    $msg = \Session::get('notification')
@endphp
<script>
    var options = {
        position: "bottom-left",
        durations: {
            global: 10000,
            success: null,
            info: null,
            tip: null,
            warning: null,
            alert: null
        },
        labels: {
            success: '',
            alert: '',
            warning: '',
            info: '',
            tip: '',
        },
        icons: {
            prefix: '',
            suffix: '',
            success: '',
            alert: '',
            warning: '',
            info: '',
            tip: '',
        }
    };
    var notifier = new AWN(options);
</script>

@if($msg)
    @php $msg_icon = ''; @endphp
    @if($msg['class'] == 'success')
        @php $msg_icon = 'check' @endphp
    @elseif($msg['class'] == 'alert')
        @php $msg_icon = 'alert-circle-o' @endphp
    @elseif($msg['class'] == 'warning')
        @php $msg_icon = 'alert-triangle' @endphp
    @elseif($msg['class'] == 'info')
        @php $msg_icon = 'info-outline' @endphp
    @elseif($msg['class'] == 'tip')
        @php $msg_icon = 'help"' @endphp
    @endif
    <script>
        notifier.{{ $msg['class'] }}('{{ $msg['message'] }}<span class="awn-toast-icon"><i class="zmdi zmdi-{{ $msg_icon }}"></i></span>');
    </script>
@endif

</body>
</html>
