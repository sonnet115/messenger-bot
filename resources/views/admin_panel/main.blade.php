<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Dashboard 1 | Adminox - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/admin/images/favicon.ico">

    <!-- C3 Chart css -->
    <link href="{{asset('assets/admin/libs/c3/c3.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- App css -->
    <link href="{{asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" id="bootstrap-stylesheet" />
    <link href="{{asset('assets/admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/admin/css/app.min.css')}}" rel="stylesheet" type="text/css"  id="app-stylesheet" />
</head>

<body>

<!-- Begin page -->
<div id="wrapper">


    <!-- Topbar Start -->
    <div class="navbar-custom">
        <ul class="list-unstyled topnav-menu float-right mb-0">

            <li class="dropdown notification-list dropdown d-none d-lg-inline-block ml-2">
                <a class="nav-link dropdown-toggle mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img href="{{asset('assets/admin/images/flags/us.jpg')}}" alt="lang-image" height="12">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img href="{{asset('assets/admin/images/flags/germany.jpg')}}" alt="lang-image" class="mr-1" height="12"> <span
                            class="align-middle">German</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img href="{{asset('assets/admin/images/flags/italy.jpg')}}" alt="lang-image" class="mr-1" height="12"> <span
                            class="align-middle">Italian</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img href="{{asset('assets/admin/images/flags/spain.jpg')}}" alt="lang-image" class="mr-1" height="12"> <span
                            class="align-middle">Spanish</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <img href="{{asset('assets/admin/images/flags/russia.jpg')}}" alt="lang-image" class="mr-1" height="12"> <span
                            class="align-middle">Russian</span>
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle  waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <i class="dripicons-bell noti-icon"></i>
                    <span class="badge badge-pink rounded-circle noti-icon-badge">4</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-lg">

                    <div class="dropdown-header noti-title">
                        <h5 class="text-overflow m-0"><span class="float-right">
                                    <span class="badge badge-danger float-right">5</span>
                                    </span>Notification</h5>
                    </div>

                    <div class="slimscroll noti-scroll">

                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-success"><i class="mdi mdi-comment-account-outline"></i></div>
                            <p class="notify-details">Robert S. Taylor commented on Admin<small class="text-muted">1 min ago</small></p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-primary">
                                <i class="mdi mdi-settings-outline"></i>
                            </div>
                            <p class="notify-details">New settings
                                <small class="text-muted">There are new settings available</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-warning">
                                <i class="mdi mdi-bell-outline"></i>
                            </div>
                            <p class="notify-details">Updates
                                <small class="text-muted">There are 2 new updates available</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon">
                                <img href="{{asset('assets/admin/images/users/avatar-4.jpg')}}" class="img-fluid rounded-circle" alt="" /> </div>
                            <p class="notify-details">Karen Robinson</p>
                            <p class="text-muted mb-0 user-msg">
                                <small>Wow ! this admin looks good and awesome design</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-danger">
                                <i class="mdi mdi-account-plus"></i>
                            </div>
                            <p class="notify-details">New user
                                <small class="text-muted">You have 10 unread messages</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-info">
                                <i class="mdi mdi-comment-account-outline"></i>
                            </div>
                            <p class="notify-details">Caleb Flakelar commented on Admin
                                <small class="text-muted">4 days ago</small>
                            </p>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item notify-item">
                            <div class="notify-icon bg-secondary">
                                <i class="mdi mdi-heart"></i>
                            </div>
                            <p class="notify-details">Carlos Crouch liked
                                <b>Admin</b>
                                <small class="text-muted">13 days ago</small>
                            </p>
                        </a>
                    </div>

                    <!-- All-->
                    <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item notify-all">
                        View all
                        <i class="fi-arrow-right"></i>
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img href="{{asset('assets/admin/images/users/avatar-1.jpg')}}" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ml-1">
                                Maxine K  <i class="mdi mdi-chevron-down"></i>
                            </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Welcome !</h6>
                    </div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user"></i>
                        <span>Profile</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </li>

            <li class="dropdown notification-list">
                <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                    <i class="fe-settings noti-icon"></i>
                </a>
            </li>


        </ul>

        <!-- LOGO -->
        <div class="logo-box">
            <a href="index.html" class="logo text-center">
                        <span class="logo-lg">
                            <img href="{{asset('assets/admin/images/logo-light.png')}}" alt="" height="25">
                            <!-- <span class="logo-lg-text-light">UBold</span> -->
                        </span>
                <span class="logo-sm">
                            <!-- <span class="logo-sm-text-dark">U</span> -->
                            <img href="{{asset('assets/admin/images/logo-sm.png')}}" alt="" height="28">
                        </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li class="d-none d-sm-block">
                <form class="app-search">
                    <div class="app-search-box">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <div class="input-group-append">
                                <button class="btn" type="submit">
                                    <i class="fe-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </li>

        </ul>
    </div>
    <!-- end Topbar -->


    <!-- ========== Left Sidebar Start ========== -->
    <div class="left-side-menu">

        <div class="slimscroll-menu">

            <!--- Sidemenu -->
            <div id="sidebar-menu">

                <ul class="metismenu" id="side-menu">

                    <li class="menu-title">Navigation</li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-airplay"></i>
                            <span> Dashboard </span>
                        </a>

                    </li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-file-plus"></i>
                            <span> User </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="page-starter.html">Add User</a></li>
                            <li><a href="page-login.html">Manage User</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-file-plus"></i>
                            <span> Role </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="page-starter.html">Add Role</a></li>
                            <li><a href="page-login.html">Manage Role</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-file-plus"></i>
                            <span> Product </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="page-starter.html">Add Product</a></li>
                            <li><a href="page-login.html">Update product</a></li>
                            <li><a href="page-login.html">Delete product</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-file-plus"></i>
                            <span>Manage Orders </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="page-starter.html"></a></li>
                            <li><a href="page-login.html">Process order</a></li>
                            <li><a href="page-login.html">Cancel order</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);">
                            <i class="fe-file-plus"></i>
                            <span>Pre-orders </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul class="nav-second-level" aria-expanded="false">
                            <li><a href="page-starter.html"></a></li>
                            <li><a href="page-login.html">Add pre-order</a></li>
                            <li><a href="page-login.html">Manage Pre-order</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
            <!-- End Sidebar -->

            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        @yield('body-content')
        <!-- end content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        2017 - 2019 &copy; Adminox theme by <a href="#">Coderthemes</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

</div>

<!-- Vendor js -->
<script src="{{asset('assets/admin/js/vendor.min.js')}}"></script>

<!--C3 Chart-->
<script src="{{asset('assets/admin/libs/d3/d3.min.js')}}"></script>
<script src="{{asset('assets/admin/libs/c3/c3.min.js')}}"></script>

<script src="{{asset('assets/admin/libs/echarts/echarts.min.js')}}"></script>

<script src="{{asset('assets/admin/js/pages/dashboard.init.js')}}"></script>

<!-- App js -->
<script src="{{asset('assets/admin/js/app.min.js')}}"></script>

</body>

<!-- Mirrored from coderthemes.com/adminox/layouts/vertical/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 31 May 2020 18:30:45 GMT -->
</html>
