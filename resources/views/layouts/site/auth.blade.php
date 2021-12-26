<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kavax | @yield('page-title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('public/assets/site/styles/pages/base/style.min.css') }}">
    <link href="{{ asset('public/assets/site/styles/pages') }}/@yield('page-style')" type="text/css" rel="stylesheet">

    @yield('heading-lib')
</head>
<body class="auth-body">

<header class="auth-header center">
    <div class="branding">
        <a href="{{ url('/') }}"><img src="{{ asset('public/assets/site/images/base') }}/kavax-logo-241px.png" class="Kavax"></a>
    </div>
    <div class="page-title">@yield('page-title')</div>
</header>

<main class="main-page-auth">
    @yield('content')
</main>

@yield('footer-lib')

</body>
</html>
