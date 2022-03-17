<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ trans('messages.AppName') }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('panel/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('panel/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('panel/images/favicon.png') }}" />
</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        @yield('content')
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{ asset('panel/vendors/base/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="{{ asset('panel/js/off-canvas.js') }}"></script>
<script src="{{ asset('panel/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('panel/js/template.js') }}"></script>
<!-- endinject -->
</body>

</html>
