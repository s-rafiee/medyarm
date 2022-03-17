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
        <link rel="shortcut icon" href="{{ asset('panel/images/favicon.png') }}"/>
        <script src="{{ asset('js/jquery-2.1.3.min.js') }}" type="text/javascript"></script>
        @yield('header')
    </head>
    <body>
        @yield('content')
    </body>
</html>
