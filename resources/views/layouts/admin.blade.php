<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Template Styles -->
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/base/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <link rel="stylesheet" href="{{asset('assets/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('assets/admin/css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{\App\Models\Setting::find(1)->site_favicon}}" type="image/x-icon">
    <!-- Amsify Css -->
    @stack('style')
    @livewireStyles
</head>

<body>
    <div class="container-scroller">
        @include('layouts.inc.admin.navbar')
        <div class="container-fluid page-body-wrapper">
            @include('layouts.inc.admin.sidebar')
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                {{-- @include('layouts.inc.admin.footer') --}}
            </div>
        </div>
    </div>

    <!-- /.content -->







    <!-- plugins:js -->
    <script src="{{asset('assets/admin/vendors/base/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{asset('assets/admin/vendors/datatables.net/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{asset('assets/admin/js/off-canvas.js')}}"></script>
    <script src="{{asset('assets/admin/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('assets/admin/js/template.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{asset('assets/admin/js/dashboard.js')}}"></script>
    <script src="{{asset('assets/admin/js/data-table.js')}}"></script>
    <script src="{{asset('assets/admin/js/jquery.dataTables.js')}}"></script>
    <script src="{{asset('assets/admin/js/dataTables.bootstrap4.js')}}"></script>
    <!-- End custom js for this page-->
    <!-- Amsify JS-->

    <!-- ijaboViewer JS-->
    <script src="{{asset('assets/admin/js/jquery.ijaboViewer.min.js')}}"></script>
    @livewireScripts
    @stack('script')
</body>

</html>
