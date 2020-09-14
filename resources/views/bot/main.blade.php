<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form | Shop Name</title>
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/bot/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/bot/css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/bot/css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/bot/css/iofrm-theme24.css">
    <link rel="stylesheet" type="text/css" href="{{env("APP_URL")}}assets/bot/css/custom.css">
    @yield('check-out-css')
</head>
<body style="overflow-x: hidden">
<div class="spinner-wrapper">
    <div class="sk-circle">
        <div class="sk-circle1 sk-child"></div>
        <div class="sk-circle2 sk-child"></div>
        <div class="sk-circle3 sk-child"></div>
        <div class="sk-circle4 sk-child"></div>
        <div class="sk-circle5 sk-child"></div>
        <div class="sk-circle6 sk-child"></div>
        <div class="sk-circle7 sk-child"></div>
        <div class="sk-circle8 sk-child"></div>
        <div class="sk-circle9 sk-child"></div>
        <div class="sk-circle10 sk-child"></div>
        <div class="sk-circle11 sk-child"></div>
        <div class="sk-circle12 sk-child"></div>
    </div>
</div>

@yield('main-content')

<script src="{{env("APP_URL")}}assets/bot/js/jquery.min.js"></script>
<script src="{{env("APP_URL")}}assets/bot/js/popper.min.js"></script>
<script src="{{env("APP_URL")}}assets/bot/js/bootstrap.min.js"></script>
<script>
    const preloaderFadeOutTime = 500;

    function hidePreloader() {
        let preloader = $('.spinner-wrapper');
        preloader.fadeOut(preloaderFadeOutTime);
    }
</script>

@yield('check-out-js')
@yield('track-order-js')
@yield('product-search-js')

</body>
</html>
