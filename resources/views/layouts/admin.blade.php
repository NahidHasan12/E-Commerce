<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>@yield('title')</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('admin') }}/css/font-face.css" rel="stylesheet" media="all">
    <link href="{{ asset('admin') }}/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="{{ asset('admin') }}/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="{{ asset('admin') }}/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin') }}/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('admin') }}/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="{{ asset('admin') }}/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="{{ asset('admin') }}/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="{{ asset('admin') }}/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="{{ asset('admin') }}/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="{{ asset('admin') }}/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="{{ asset('admin') }}/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="{{ asset('admin') }}/vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">

    <!-- DataTables CSS-->
 <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" rel="stylesheet">

     <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin') }}/css/login.css">
    <link href="{{ asset('admin') }}/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        @guest()

        @else
        @include('layouts.admin_lay_inc.desktop_menu')
        <!-- END MENU SIDEBAR-->
        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            @include('layouts.admin_lay_inc.header')
            @include('layouts.admin_lay_inc.mobile_menu')



            @endguest
            <!-- END HEADER DESKTOP-->
            @yield('admin_content')

            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('admin') }}/vendor/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin') }}/vendor/bootstrap-4.1/popper.min.js"></script>
    <script src="{{ asset('admin') }}/vendor/bootstrap-4.1/bootstrap.min.js"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('admin') }}/vendor/slick/slick.min.js">
    </script>
    <script src="{{ asset('admin') }}/vendor/wow/wow.min.js"></script>
    <script src="{{ asset('admin') }}/vendor/animsition/animsition.min.js"></script>
    <script src="{{ asset('admin') }}/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
    </script>
    <script src="{{ asset('admin') }}/vendor/counter-up/jquery.waypoints.min.js"></script>
    <script src="{{ asset('admin') }}/vendor/counter-up/jquery.counterup.min.js">
    </script>
    <script src="{{ asset('admin') }}/vendor/circle-progress/circle-progress.min.js"></script>
    <script src="{{ asset('admin') }}/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="{{ asset('admin') }}/vendor/chartjs/Chart.bundle.min.js"></script>
    <script src="{{ asset('admin') }}/vendor/select2/select2.min.js">
    </script>
    <script src="{{ asset('admin') }}/vendor/vector-map/jquery.vmap.js"></script>
    <script src="{{ asset('admin') }}/vendor/vector-map/jquery.vmap.min.js"></script>
    <script src="{{ asset('admin') }}/vendor/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="{{ asset('admin') }}/vendor/vector-map/jquery.vmap.world.js"></script>

    <!-- Main JS-->
    <script src="{{ asset('admin') }}/js/main.js"></script>

    <!-- Sweetalert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      {{-- =================== Datatables Script ================== --}}
     <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
     <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

      @stack('scripts')


        <script>

            // Swal.fire({
            // title: 'Are you sure?',
            // text: "You won't be able to revert this!",
            // icon: 'warning',
            // showCancelButton: true,
            // confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            // confirmButtonText: 'Yes, delete it!'
            // }).then((result) => {
            // if (result.isConfirmed) {
            //     Swal.fire(
            //     'Deleted!',
            //     'Your file has been deleted.',
            //     'success'
            //     )
            // }
            // })
        </script>

        <script>

           // const Toast = Swal.mixin({
           // toast: true,
           // position: 'top-end',
           // showConfirmButton: false,
           // timer: 3000,
           // timerProgressBar: true,
           // didOpen: (toast) => {
           //     toast.addEventListener('mouseenter', Swal.stopTimer)
            //    toast.addEventListener('mouseleave', Swal.resumeTimer)
            //}
            //})

            //Toast.fire({
            //icon: 'success',
            //title: 'Signed in successfully'
            //})
        </script>


</body>

</html>
<!-- end document-->
