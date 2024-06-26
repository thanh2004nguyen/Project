<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AdminLTE 3 | Starter</title>
    <base href="{{asset("/")}}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="admins/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="admins/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="admins/plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <link rel="stylesheet" href="{{ asset('css/chattle_admin.min.css') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>

    {{-- Statictical --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">





</head>

<body class="hold-transition sidebar-mini " style="overflow-y: scroll;">
    <div class="wrapper">

        <!-- Navbar -->
        @include('admin.mainHeader')
        <!-- /.navbar -->




        <!-- Main Sidebar Container -->

        @include('admin.mainSidebar')


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <!-- <aside class="control-sidebar control-sidebar-dark">
      Control sidebar content goes here -->
        <!-- <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
    </aside> -->
        <!-- /.control-sidebar -->

        <!-- Main Footer -->

        @include('admin.mainFooter')


    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->

    <!-- Bootstrap 4 -->
    <script src="admins/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="admins/dist/js/adminlte.min.js"></script>
    <script src="admins/dist/js/managetable.js"></script>
    <script src="admins/dist/js/handlemodalNotify.js"></script>
    <script src="admins/dist/js/updateProduct.js"></script>

    {{-- chat box --}}
    <script src="/js/pusher.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.2.min.js" integrity="sha256-2krYZKh//PcchRtd+H+VyyQoZ/e3EcrkxhM8ycwASPA=" crossorigin="anonymous"></script>
    <script src="/js/chattle_admin.js"></script>
    {{-- end chat box --}}


    {{-- statictical --}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    {{-- end --}}
    <script src="{{ asset('fontend/JS/paypalRefund.js') }}"></script>
    <script src="{{ asset('fontend/JS/handleAddCart.js') }}"></script>

    



</body>

</html>