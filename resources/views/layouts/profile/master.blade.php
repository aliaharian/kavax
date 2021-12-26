<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <title>@yield('page-title') | UDAI</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('public/assets/site/images/base/') }}/udai.png">

    <link rel="stylesheet" href="{{ asset('public/assets/site/styles/pages/profile/profile.css') }}">

    {{-- Page Style --}}
    {{--    <link href="{{ asset('public/assets/site/styles/pages') }}/@yield('page-style')" type="text/css" rel="stylesheet">--}}

    {{-- Page Responsive Style --}}
    <link rel="stylesheet" href="{{ asset('public/assets/site/styles/responsive/base.min.css') }}">
    {{--    <link href="{{ asset('public/assets/site/styles/pages') }}/@yield('page-style-responsive')" type="text/css" rel="stylesheet">--}}

    <script src="{{ asset('public/assets/site/js/theme-libs.js') }}"></script>
    @yield('heading-lib')
</head>
<body class="dashboard-page @yield('body-class')">

<div class="row dashboard-row g-0">
    <div class="col-auto sidebar-col light-mode">
        @include('layouts.profile.extends.sidebar')
    </div>
    <div class="col content-col">
        @yield('content')
    </div>

    @yield('footer-lib')

    <script src="{{ asset('public/assets/site/js/footer.js') }}"></script>

</body>
</html>
