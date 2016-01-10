<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.landing_partials.head')
</head>
<body>
<header class="start">
    @include('layouts.landing_partials.header')
</header>
@yield('content')
<div class="footer_padding"></div>
<footer>
    @include('layouts.landing_partials.footer')
</footer>
</body>
</html>