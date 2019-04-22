<!DOCTYPE html>
<html lang="en">
<!-- header -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ trans('label.title') }}</title>
    <!-- Custom fonts for this template-->
    <link href="{{ asset('bower_components/mvo1/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="{{ asset('bower_components/mvo1/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{ asset('bower_components/mvo1/css/sb-admin.css') }}" rel="stylesheet">
    {{-- Style custom css --}}
    <link href="{{ asset('bower_components/mvo1/css/stylecustom.css') }}" rel="stylesheet">
    <link href="{{ asset('custom-css/custom.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <!--Header-->
    @include('backend.layouts.header')
    <!--Navbar-->
    @include('backend.layouts.navbar')
    <!--Content-->
    @yield('content')
    <!--Footer-->
    @include('backend.layouts.footer')
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('bower_components/mvo1/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/mvo1/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('bower_components/mvo1/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Page level plugin JavaScript-->
    <script src="{{ asset('bower_components/mvo1/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('bower_components/mvo1/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('bower_components/mvo1/vendor/datatables/dataTables.bootstrap4.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('bower_components/mvo1/js/sb-admin.min.js') }}"></script>
    <!-- Demo scripts for this page-->
    <script src="{{ asset('bower_components/mvo1/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('bower_components/mvo1/js/demo/chart-area-demo.js') }}"></script>
    <!-- App scripts -->
    @stack('scripts')
</body>
</html>
