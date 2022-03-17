<?php
/**
 * Created by PhpStorm.
 * User: saman
 * Date: 3/23/2019
 * Time: 1:26 AM
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Ahangam | Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('panel/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('panel/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('panel/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('panel/images/favicon.png') }}" />
    <script src="{{ asset('js/jquery-2.1.3.min.js') }}" type="text/javascript"></script>
    @yield('header')
</head>
<body>
<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="navbar-brand-wrapper d-flex justify-content-center">
            <div class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
                <a class="navbar-brand brand-logo" href="{{ url('/dashboard') }}"><img src="/panel/images/logo.svg" alt="logo"/></a>
                <a class="navbar-brand brand-logo-mini" href="{{ url('/dashboard') }}"><img src="/panel/images/logo-mini.svg" alt="logo"/></a>
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-sort-variant"></span>
                </button>
            </div>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                        <img src="{{ auth::user()->image }}" alt="profile"/>
                        <span class="nav-profile-name">{{ auth::user()->name }} {{ auth::user()->family }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="{{ url('/dashboard/users/edit/'.Auth::user()->id) }}">
                            <i class="mdi mdi-account text-primary"></i>
                            Edit Profile
                        </a>
                        <a class="dropdown-item" href="{{ url('/dashboard/logout') }}">
                            <i class="mdi mdi-logout text-primary"></i>
                            Logout
                        </a>
                    </div>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('dashboard/') }}/">
                        <i class="mdi mdi-home menu-icon"></i>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#skills" aria-expanded="false" aria-controls="skills">
                        <i class="mdi mdi-code-tags menu-icon"></i>
                        <span class="menu-title">Skills</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="skills">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ url('dashboard/skills') }}"> All Skills </a></li>
                            <li class="nav-item"> <a class="nav-link" href="/dashboard/skills/create"> Create New Skills </a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#courses" aria-expanded="false" aria-controls="courses">
                        <i class="mdi mdi-tag-text-outline menu-icon"></i>
                        <span class="menu-title">Courses</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="courses">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ url('dashboard/courses') }}"> All Courses </a></li>
                            <li class="nav-item"> <a class="nav-link" href="/dashboard/courses/create"> Create New Courses </a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#lessons" aria-expanded="false" aria-controls="lessons">
                        <i class="mdi mdi-pencil menu-icon"></i>
                        <span class="menu-title">Lessons</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="lessons">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ url('dashboard/lessons') }}"> All Lessons </a></li>
                            <li class="nav-item"> <a class="nav-link" href="/dashboard/lessons/create"> Create New Lessons </a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#blogs" aria-expanded="false" aria-controls="blogs">
                        <i class="mdi mdi-web menu-icon"></i>
                        <span class="menu-title">Blog</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="blogs">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ url('dashboard/blogs') }}"> All Posts </a></li>
                            <li class="nav-item"> <a class="nav-link" href="/dashboard/blogs/create"> Create New Post </a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('dashboard/cats') }}">
                        <i class="mdi mdi-tag-multiple menu-icon"></i>
                        <span class="menu-title">Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#pages" aria-expanded="false" aria-controls="pages">
                        <i class="mdi mdi-file menu-icon"></i>
                        <span class="menu-title">Pages</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="pages">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ url('dashboard/pages') }}"> All Pages </a></li>
                            <li class="nav-item"> <a class="nav-link" href="/dashboard/pages/create"> Create New Page </a></li>
                        </ul>
                    </div>
                </li>
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="{{ url('dashboard/comments') }}">--}}
                        {{--<i class="mdi mdi-comment-multiple-outline menu-icon"></i>--}}
                        {{--<span class="menu-title">Comments</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
                        <i class="mdi mdi-account menu-icon"></i>
                        <span class="menu-title">Users</span>
                        <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="users">
                        <ul class="nav flex-column sub-menu">
                            <li class="nav-item"> <a class="nav-link" href="{{ url('dashboard/users') }}"> All Users </a></li>
                            <li class="nav-item"> <a class="nav-link" href="/dashboard/users/create"> Create New User </a></li>
                        </ul>
                    </div>
                </li>
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="{{ url('/dashboard/settings') }}">--}}
                        {{--<i class="mdi mdi-settings-outline menu-icon"></i>--}}
                        {{--<span class="menu-title">Setting</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/dashboard/medias') }}">
                        <i class="mdi mdi-image-filter menu-icon"></i>
                        <span class="menu-title">Media</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/dashboard/logout') }}">
                        <i class="mdi mdi-logout-variant menu-icon"></i>
                        <span class="menu-title">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    @yield('content')
                </div>
                <div class="modal fade" id="modal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        </div>
                    </div>
                </div>
                <script>
                    function modal_show(title,body,footer=''){
                        var content = '<div class="modal-header"><h4 class="modal-title">'+title+'</h4><button type="button" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body">'+body+'</div>';
                        if(footer!='') {
                            content += '<div class="modal-footer">'+footer+'</div>';
                        }
                        $('.modal-content').html(content);
                        $("#modal").modal();
                    }
                </script>
            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2019-{{ date("y") }} . All rights reserved.</span>
                </div>
            </footer>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<!-- plugins:js -->
<script src="{{ asset('panel/vendors/base/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="{{ asset('panel/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('panel/vendors/datatables.net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('panelvendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{ asset('panel/js/off-canvas.js') }}"></script>
<script src="{{ asset('panel/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('panel/js/template.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
{{--<script src="{{ asset('panel/js/dashboard.js') }}"></script>--}}
<script src="{{ asset('panel/js/data-table.js') }}"></script>
<script src="{{ asset('panel/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('panel/js/dataTables.bootstrap4.js') }}"></script>
<!-- End custom js for this page-->
@yield('footer')
</body>

</html>



