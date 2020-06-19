<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>{{$title}}</title>
    <meta name="description" content="A responsive bootstrap 4 admin dashboard template by hencework"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset("assets/admin_panel/dist/img/favicon.ico")}}">
    <link rel="icon" href="{{asset("assets/admin_panel/dist/img/favicon.ico")}}" type="image/x-icon">

    <!-- vector map CSS -->
    <link href={{asset("assets/admin_panel/vendors/vectormap/jquery-jvectormap-2.0.3.css")}} rel="stylesheet"
          type="text/css"/>

    <link href={{asset("assets/admin_panel/vendors/apexcharts/dist/apexcharts.html")}} rel="stylesheet"
          type="text/css"/>

    <!-- Toggles CSS -->
    <link href={{asset("assets/admin_panel/vendors/jquery-toggles/css/toggles.css")}} rel="stylesheet"
          type="text/css">

    <!-- Toaster CSS -->
    <link
        href={{asset("assets/admin_panel/vendors/jquery-toast-plugin/dist/jquery.toast.min.css")}} rel="stylesheet"
        type="text/css">

    <link href={{asset("assets/admin_panel/vendors/bootstrap/dist/css/bootstrap.min.css")}} rel="stylesheet"
          type="text/css">
    <link
        href={{asset("assets/admin_panel/vendors/owl.carousel/dist/assets/owl.carousel.min.css")}} rel="stylesheet"
        type="text/css">
    <link
        href={{asset("assets/admin_panel/vendors/owl.carousel/dist/assets/owl.theme.default.min.css")}} rel="stylesheet"
        type="text/css">

    <link href={{asset("assets/admin_panel/vendors/datatables.net-dt/css/jquery.dataTables.min.css")}} rel="stylesheet"
          type="text/css"/>
    <link
        href={{asset("assets/admin_panel/vendors/datatables.net-responsive-dt/css/responsive.dataTables.min.css")}} rel="stylesheet"
        type="text/css"/>

    <!-- Custom CSS -->
    <link href={{asset("assets/admin_panel/dist/css/style.css")}} rel="stylesheet" type="text/css">

    @yield("custom_css")
    @yield("product-css")
    @yield("user-css")
    @yield("discount-css")

</head>

<body>
<!-- Preloader-->
<div class="preloader-it">
    <div class="loader-pendulums"></div>
</div>
<!-- /Preloader -->

<!-- HK Wrapper -->
<div class="hk-wrapper hk-vertical-nav">
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-xl navbar-dark fixed-top hk-navbar">
        <a id="navbar_toggle_btn" class="navbar-toggle-btn nav-link-hover" href="javascript:void(0);">
            <span class="feather-icon"><i data-feather="menu"></i></span>
        </a>
        <a class="navbar-brand font-weight-900 text-white" style="font-size: 30px !important;"
           href="{{route("dashboard.show")}}">Gift Tracking
        </a>
        <ul class="navbar-nav hk-navbar-content">
            <li class="nav-item dropdown dropdown-authentication">
                <a class="nav-link dropdown-toggle no-caret" href="#" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <div class="media">
                        <div class="media-img-wrap">
                            <div class="avatar">
                                <img src={{asset("assets/admin_panel/dist/img/avatar12.jpg")}} alt="user"
                                     class="avatar-img rounded-circle">
                            </div>
                            <span class="badge badge-success badge-indicator"></span>
                        </div>
                        <div class="media-body">
                            <span>Sayla Zahan Surovi<i
                                    class="zmdi zmdi-chevron-down"></i></span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
                    <a class="dropdown-item" href="#">
                        <i class="dropdown-icon zmdi zmdi-portable-wifi-changes"></i>
                        <span>Change Password</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <i class="dropdown-icon zmdi zmdi-power"></i>
                        <span>Log out</span></a>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /Top Navbar -->

    <!-- Vertical Nav -->
    <nav class="hk-nav hk-nav-dark">
        <a href="javascript:void(0);" id="hk_nav_close" class="hk-nav-close"><span class="feather-icon"><i
                    data-feather="x"></i></span></a>
        <div class="nicescroll-bar">
            <div class="navbar-nav-wrap">
                <ul class="navbar-nav flex-column">

                    <li class="nav-item {{\Request::route()->getName() == 'dashboard.show' ? "active" : ""}}">
                        <a class="nav-link" href="{{route('dashboard.show')}}">
                            <span class="feather-icon"><i data-feather="activity"></i></span>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <hr class="nav-separator">

                    <li class="nav-item">
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse"
                           data-target="#product_manager">
                            <i class="fa fa-users"></i></span>
                            <span class="nav-link-text">Manage Products </span>
                        </a>
                        <ul id="product_manager"
                            class="nav flex-column collapse collapse-level-1 {{ Request::segment(2) == "product" ? "show" : "" }}">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item {{\Request::route()->getName() == "product.add.view" ? "active" : ""}}">
                                        <a class="nav-link"
                                           href="{{route('product.add.view')}}"><i class="fa fa-user-plus"></i>Add
                                            Product</a>
                                    </li>
                                    <li class="nav-item {{\Request::route()->getName() == "product.manage.view" ? "active" : ""}}">
                                        <a class="nav-link"
                                           href="{{route('product.manage.view')}}"><i class="fa fa-list-ul"></i>Product
                                            Lists</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    {{-- manage discounts--}}
                    <hr class="nav-separator">
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="javascript:void(0);" data-toggle="collapse"
                           data-target="#discount_manager">
                            <i class="fa fa-users"></i></span>
                            <span class="nav-link-text">Manage discounts</span>
                        </a>
                        <ul id="discount_manager"
                            class="nav flex-column collapse collapse-level-1 {{ Request::segment(2) == "discount" ? "show" : "" }}">
                            <li class="nav-item">
                                <ul class="nav flex-column">
                                    <li class="nav-item {{\Request::route()->getName() == "discount.add.view" ? "active" : ""}}">
                                        <a class="nav-link"
                                           href="{{route('discount.add.view')}}"><i
                                                class="fa fa-user-plus"></i>Add Discount</a>
                                    </li>
                                    <li class="nav-item {{\Request::route()->getName() == "discount.manage.view" ? "active" : ""}}">
                                        <a class="nav-link"
                                           href="{{route('discount.manage.view')}}"><i class="fa fa-list-ul"></i>Discount
                                            Lists</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div id="hk_nav_backdrop" class="hk-nav-backdrop"></div>
    <!-- /Vertical Nav -->

    <!-- Main Content -->
    <div class="hk-pg-wrapper">
    @yield("main_content")
    <!-- Footer -->
        <div class="hk-footer-wrap container">
            <footer class="footer">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <p>Pampered by<a href="https://hencework.com/" class="text-dark"
                                         target="_blank">Hencework</a> ©
                            2019</p>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <p class="d-inline-block">Follow us</p>
                        <a href="#"
                           class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span
                                class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
                        <a href="#"
                           class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span
                                class="btn-icon-wrap"><i class="fa fa-twitter"></i></span></a>
                        <a href="#"
                           class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span
                                class="btn-icon-wrap"><i class="fa fa-google-plus"></i></span></a>
                    </div>
                </div>
            </footer>
        </div>
        <!-- /Footer -->
    </div>
    <!-- /Main Content -->

</div>
<!-- /HK Wrapper -->

<!-- jQuery -->
<script src={{asset("assets/admin_panel/vendors/jquery/dist/jquery.min.js")}}></script>

<!-- Bootstrap Core JavaScript -->
<script src={{asset("assets/admin_panel/vendors/popper.js/dist/umd/popper.min.js")}}></script>
<script src={{asset("assets/admin_panel/vendors/bootstrap/dist/js/bootstrap.min.js")}}></script>

<!-- Slimscroll JavaScript -->
<script src={{asset("assets/admin_panel/dist/js/jquery.slimscroll.js")}}></script>

<!-- Fancy Dropdown JS -->
<script src={{asset("assets/admin_panel/dist/js/dropdown-bootstrap-extended.js")}}></script>

<!-- FeatherIcons JavaScript -->
<script src={{asset("assets/admin_panel/dist/js/feather.min.js")}}></script>

<!-- Toggles JavaScript -->
<script src={{asset("assets/admin_panel/vendors/jquery-toggles/toggles.min.js")}}></script>
<script src={{asset("assets/admin_panel/dist/js/toggle-data.js")}}></script>

<!-- Counter Animation JavaScript -->
<script src={{asset("assets/admin_panel/vendors/waypoints/lib/jquery.waypoints.min.js")}}></script>
<script src={{asset("assets/admin_panel/vendors/jquery.counterup/jquery.counterup.min.js")}}></script>

<!-- Morris Charts JavaScript -->
<script src={{asset("assets/admin_panel/vendors/raphael/raphael.min.js")}}></script>
<script src={{asset("assets/admin_panel/vendors/morris.js/morris.min.js")}}"../"></script>

<!-- EChartJS JavaScript -->
<script src={{asset("assets/admin_panel/vendors/echarts/dist/echarts-en.min.js")}}></script>

<!-- Sparkline JavaScript -->
<script src={{asset("assets/admin_panel/vendors/jquery.sparkline/dist/jquery.sparkline.min.js")}}></script>

<!-- Vector Maps JavaScript -->
<script src={{asset("assets/admin_panel/vendors/vectormap/jquery-jvectormap-2.0.3.min.js")}}></script>
<script src={{asset("assets/admin_panel/vendors/vectormap/jquery-jvectormap-world-mill-en.js")}}></script>
<script src={{asset("assets/admin_panel/dist/js/vectormap-data.js")}}></script>

<!-- Owl JavaScript -->
<script src={{asset("assets/admin_panel/vendors/owl.carousel/dist/owl.carousel.min.js")}}></script>

<!-- Toaster JS -->
<script src={{asset("assets/admin_panel/vendors/jquery-toast-plugin/dist/jquery.toast.min.js")}}></script>

<!-- Init JavaScript -->
<script src={{asset("assets/admin_panel/dist/js/init.js")}}></script>
<script src={{asset("assets/admin_panel/dist/js/dashboard-data.js")}}></script>
{{--<script>--}}
{{--    let time = new Date().getTime();--}}
{{--    $(document.body).bind("mousemove keypress", function (e) {--}}
{{--        time = new Date().getTime();--}}
{{--    });--}}

{{--    function refresh() {--}}
{{--        if (new Date().getTime() - time >= 300000)--}}
{{--            window.location.reload(true);--}}
{{--        else--}}
{{--            setTimeout(refresh, 1000);--}}
{{--    }--}}

{{--    setTimeout(refresh, 1000);--}}
{{--</script>--}}

<!-- ADD PO -->
@yield("product-js")
@yield('user-js')
@yield('discount-js')
@yield('manageDiscount-js')

</body>
</html>
