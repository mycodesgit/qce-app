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
    <link rel="stylesheet" href="{{ asset('template/dist/css/custom.css') }}">
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
            background-color: #1f5036 !important ;
            color: white;
        }
        [class*="sidebar-dark-"] .nav-treeview>.nav-item>.nav-link.active, [class*="sidebar-dark-"] .nav-treeview>.nav-item>.nav-link.active:hover, [class*="sidebar-dark-"] .nav-treeview>.nav-item>.nav-link.active:focus {
            background-color: #1f5036 !important;
            color: white;
        }
        .breadcrumbactive{
            color: #32ac71 !important;
            font-weight: bold;
        }
        .breadcrumbactive a{
            color: #32ac71 !important;
            font-weight: bold;
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
        .folder-icon {
            transition: transform 0.3s ease-in-out, color 0.3s ease-in-out;
        }

        .folder-icon:hover {
            transform: scale(1.1);  /* Enlarge the icon on hover */
            color: #000;  /* Change color when hovered */
        }
        .content-wrapper {
            background-color: #f4f6f9 !important;
        }
        .table-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .page-item.active .page-link {
            z-index: 3;
            color: #fff !important;
            background-color: #ffc107 !important;
            border-color: #ffc107 !important;
        }

        .page-link {
            position: relative;
            display: block;
            padding: 0.5rem 0.75rem;
            margin-left: -1px;
            line-height: 1.25;
            color: #1f5036 !important;
            background-color: #fff;
            border: 1px solid #dee2e6;
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
                        <a class="nav-link" href="{{ route('logout') }}" role="button">
                            <i class="fas fa-power-off" style="color: #ffffff;"></i>
                        </a>
                    </li>
                </ul>
            @endif
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
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
                        <a href="#" class="d-block">
                            @auth('web')
                                @if(in_array(Auth::guard('web')->user()->role, [0, 1, 2, 3, 4]))
                                    {{ Auth::guard('web')->user()->fname }} {{ Auth::guard('web')->user()->lname }}
                                @endif
                            @endauth

                            @auth('kioskstudent')
                                @if(Auth::guard('kioskstudent')->user()->role == 'Student')
                                    {{ Auth::guard('kioskstudent')->user()->studid }} {{ Auth::guard('kioskstudent')->user()->lname }}
                                @endif
                            @endauth
                        </a>
                        <span style="font-size: 10pt; color: #ccc;">
                            <i class="fa fa-circle text-success" style="font-size: 8pt"></i>
                            @php
                                $roles = [
                                    0 => 'Administrator',
                                    1 => 'Administer QA',
                                    2 => 'Administer QA Staff',
                                    3 => 'Administer Result',
                                    4 => 'Administer Result Staff',
                                ];
                            @endphp
                            @auth('web')
                                @if(in_array(Auth::guard('web')->user()->role, array_keys($roles)))
                                    {{ $roles[Auth::guard('web')->user()->role] }}
                                @endif
                            @endauth
                            @auth('kioskstudent')
                                @if(Auth::guard('kioskstudent')->user()->role == 'Student')
                                    {{ Auth::guard('kioskstudent')->user()->role }}
                                @endif
                            @endauth
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
    <!-- Select2 -->
    <script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>

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
    @if(request()->routeIs('facultyFilter'))
        <script src="{{ asset('js/evalajax/facultySerialize.js') }}"></script>
    @endif
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
    @if(request()->routeIs('subprintStore'))
        <script src="{{ asset('js/evalajax/getclassenrollSerialize.js') }}"></script>
    @endif
    @if(request()->routeIs('subprint_searchresultStore'))
        <script src="{{ asset('js/evalajax/evalsubmissionprintSerialize.js') }}"></script>
    @endif

    <!-- Validation -->
    <script src="{{ asset('js/validation/manage/catValidation.js') }}"></script>
    <script src="{{ asset('js/validation/manage/questValidation.js') }}"></script>
    <script src="{{ asset('js/validation/manage/semesterValidation.js') }}"></script>
    @if(request()->routeIs('previewStore'))
        <script src="{{ asset('js/validation/evalstud/evalValidation.js') }}"></script>
        <script src="{{ asset('js/validation/evalstud/evalSubmitValidation.js') }}"></script>
    @endif

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
    <script>
        $(document).ready(function() {
            @if(session('error'))
                toastr.error("{{ session('error') }}", "Error", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-bottom-left",
                    timeOut: 5000
                });
            @endif

            @if(session('success'))
                toastr.success("{{ session('success') }}", "Success", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-bottom-left",
                    timeOut: 10000
                });
            @endif
        });

        $(function () {

          $('.select2').select2();

          //Initialize Select2 Elements
          $('.select2bs4').select2({
              theme: 'bootstrap4',
              height: '100'
          })
      });
    </script>

</body>
</html>
