<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free-5.6.3-web/css/all.min.css') }}">
    <!-- Nano Scroller -->
    {{-- <link rel="stylesheet" href="{{ asset('plugins/nanoScroller/nanoscroller.css') }}"> --}}
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="{{ asset('plugins/datetime/css/bootstrap-datetimepicker.min.css') }}"> --}}
    @yield('plugin-css')
    <script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script>
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css?ver:1.1') }}">

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <!-- <style type="text/css">
        a,h1,h2,h3,h4,h5,h6,span,p,strong,select,b,i,input,textarea,li,label,td,th,button,radio,checkbox,div{
            text-transform: uppercase;
        }
    </style> -->
    <style>
    div.dataTables_paginate {
        float: left !important;
        margin: 0;
    }
    div.dataTables_info{
        display: none !important;
    }

    </style>
    
    @yield('style')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('alertify::alertify')
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        @include('includes.header')
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
    @include('includes.left-sidebar')
    <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        @include('includes.footer')
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        @include('includes.right-aside')
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

{{-- select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
{{-- <script src="https://cdn.rawgit.com/alertifyjs/alertify.js/v1.0.10/dist/js/alertify.js"></script> --}}

{{-- <script src="{{ asset('plugins/datetime/js/bootstrap-datetimepicker.min.js') }}"></script> --}}
<!-- Nano Scroller -->
{{-- <script src="{{ asset('plugins/nanoScroller/jquery.nanoscroller.min.js') }}"></script> --}}
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="{{ asset('js/dataTables.responsive.min.js') }}">
</script>
@yield('plugin')

@yield('script')

<script>
    $(document).ready(function () {
    //    $('.table').DataTable({
    //        'scrollX':true,
    //        dom: 'frtp',
    //        'order': [[0,'desc']],
    //        buttons: [
    //         'copy', 'csv', 'excel', 'pdf', 'print'
    //     ]
    //    });
    //    $('.datatable').DataTable({
    //        'scrollX':true,
    //        responsive:true,
    //        dom: 'Bfrtip',
    //        'order': [[0,'desc']],
    //        buttons: [
    //         'copy', 'csv', 'excel', 'pdf', 'print'
    //     ]
    //    }); 
    });
    $(document).ready(function () {
       $('.select2').select2({ width: '75%' }); 
    });
</script>

</body>
</html>
