<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CPSU QCE | Dashboard</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free-V6/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/qce-style.css') }}">
    @if(request()->routeIs('previewStore'))
        <link rel="stylesheet" href="{{ asset('template/dist/css/track-style.css') }}">
    @endif
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('template/plugins/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- DataTables  -->
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Logo  -->
    <link rel="shortcut icon" type="" href="{{ asset('template/img/CPSU_L.png') }}">

    <style>
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active{
            background-color: #4c8968 !important ;
            color: white;
        }
        [class*="sidebar-dark-"] .nav-treeview>.nav-item>.nav-link.active, [class*="sidebar-dark-"] .nav-treeview>.nav-item>.nav-link.active:hover, [class*="sidebar-dark-"] .nav-treeview>.nav-item>.nav-link.active:focus {
            background-color: #4c8968 !important;
            color: white;
        }
        .nav-item{
            cursor: pointer !important;
        }
        .nav-link:hover{
            background-color: none !important;
        }
        .btn-primary{
            background-color: #1f5036 !important;
            border: #1f5036 !important;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="background-color: #1f5036;">
            
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars" style="color: #ffffff;"></i>
                    </a>
                </li>
                {{-- <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li> --}}
            </ul>
            @if(request()->routeIs('previewStore'))

            @else
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                            <i class="fas fa-expand-arrows-alt" style="color: #ffffff;"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                            <i class="fas fa-th-large" style="color: #ffffff;"></i>
                        </a>
                    </li>
                </ul>
            @endif
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: #222d32;">
            <a href="index3.html" class="brand-link" style="background-color: #1f5036;">
                <img src="{{ asset('template/img/CPSU_L.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Faculty QCE</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('template/img/user.png') }}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Admin Level</a>
                        <span style="font-size: 10pt; color: #ccc;">
                            <i class="fa fa-circle text-success" style="font-size: 8pt"></i> Administrator
                        </span>
                    </div>
                </div>

                @include('menu.sidebar')
                
            </div>
        </aside>

        @yield('body')
        
        <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <strong>Copyright &copy; 2014-2021</strong> All rights reserved.
        </footer>
        
    </div>
    

    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template/dist/js/qce.min.js') }}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('template/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script> 
    <script src="{{ asset('template/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('template/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('template/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('template/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- Moment -->
    <script src="{{ asset('template/plugins/moment/moment.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('template/plugins/chart.js/Chart.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('template/plugins/toastr/toastr.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('template/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- jquery-validation -->
    <script src="{{ asset('template/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jquery-validation/additional-methods.min.js') }}"></script>


    <!-- Ajax -->
    @if(request()->routeIs('instructionStore'))
        <script src="{{ asset('js/evalajax/instructionSerialize.js') }}"></script>
    @endif
    @if(request()->routeIs('categoryStore'))
        <script src="{{ asset('js/evalajax/categorySerialize.js') }}"></script>
    @endif
    @if(request()->routeIs('questionStore'))
        <script src="{{ asset('js/evalajax/questionSerialize.js') }}"></script>
    @endif
    @if(request()->routeIs('semesterStore'))
        <script src="{{ asset('js/evalajax/semesterSerialize.js') }}"></script>
    @endif
    @if(request()->routeIs('userStore'))
        <script src="{{ asset('js/evalajax/userSerialize.js') }}"></script>
    @endif

    <!-- Validation -->
    <script src="{{ asset('js/validation/manage/catValidation.js') }}"></script>
    <script src="{{ asset('js/validation/manage/questValidation.js') }}"></script>
    <script src="{{ asset('js/validation/manage/semesterValidation.js') }}"></script>

    <!-- Validation -->
    <script src="{{ asset('js/validation/evalstud/evalValidation.js') }}"></script>

    <script>
        $(document).ready(function () {
            function checkInputs() {
                let allFilled = true;
                $('.required-input').each(function () {
                    if ($(this).val().trim() === '') {
                        allFilled = false;
                        return false; // Break out of loop
                    }
                });
                $('#next-btn').prop('disabled', !allFilled);
            }
            
            $('.required-input').on('input', checkInputs);
            checkInputs(); // Initial check in case inputs have default values
        });
    </script>

</body>
</html>