<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>CPSU OFES V.1.0</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free-V6/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('template/plugins/toastr/toastr.min.css') }}">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/qce-style.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/css/track-style.css') }}">
    <link rel="stylesheet" href="{{ asset('template/dist/css/upload-image.css') }}">
    <!-- Logo  -->
    <link rel="shortcut icon" type="" href="{{ asset('template/img/CPSU_L.png') }}">
    <style>
        .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active{
            background-color: #4c8968 !important ;
            color: white !important;
        }
        #alertImage {
            background: url('{{ asset('template/img/formheader.jpg') }}') no-repeat center center;
            background-size: cover;
            height: 100%;
            width: 100%;
            border-radius: 5px;
        }
        #cpsulogoImage {
            display: none; /* Default: Hidden */
        }

        @media (max-width: 768px) { 
            #cpsulogoImage {
                display: block !important; /* Ensure it's shown on mobile */
            }
        }

        .progress-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-radius: 20px !important;
        }
        .progress-container {
            display: flex;
            align-items: center;
            border-radius: 20px !important;
        }
        .progress-bar {
            transition: width 0.3s ease;
            border-radius: 20px !important;
        }

        .card-body label {
            font-weight: bold;
            display: block;
            margin-bottom: 0.5rem;
        }
        /* Container to align radio buttons and text */
        .radio-group {
            display: flex;
            gap: 20px; /* Space between radio options */
            margin-top: 15px;
        }

        /* Style the radio buttons */
        .radio-group input[type="radio"] {
            width: 22px;
            height: 22px;
            accent-color: black; /* Change selected radio button color */
            cursor: pointer;
            vertical-align: middle; /* Ensure alignment with text */
        }

        /* Style the links and keep alignment */
        .radio-group a {
            display: flex;
            align-items: center;
            gap: 2px; /* Space between radio and text */
            font-size: 1.2em;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none; /* Remove underline from links */
            color: black;
        }

        /* Ensure text and radio button are aligned */
        .radio-group a span {
            display: inline-block;
            margin-left: 5px;
        }

        /* Hide the default radio button */
        .radio-group input[type="radio"] {
            display: none;
        }

        /* Style for the custom radio button */
        .radio-group label {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 35px; /* Size of the radio button */
            height: 35px;
            border-radius: 50%;
            border: 2px solid #999; /* Default border */
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
            position: relative;
        }

        /* When radio is selected, change background color */
        .radio-group input[type="radio"]:checked + label {
            background-color: #28a745; /* Blue background */
            color: white; /* White text */
            border-color: #28a745;
        }

        /* Category Title */
        .category-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
            padding: 10px;
            border-bottom: 2px solid #ccc;
        }
        #table {
            margin-top: 10px;
            font-family: Arial;
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #000;
        }
        #table td {
            vertical-align: center !important;
            text-align: left;
            border: 1px solid #000;
            font-size: 9pt;
        } 
        #table th {
            border: 1px solid #000;
            padding: 1px;
            font-weight: normal !important;
        }
        .sticky-column {
          position: sticky;
          top: 50px;
          height: 5vh;
        }
        .scrolling-column {
          overflow-y: auto;
        }
        #evaluator {
            margin-top: 230px; /* Default for larger screens */
        }
        @media (max-width: 768px) { 
            #evaluator {
                margin-top: 335px !important;
            }
        }

    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">

    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-md navbar-light" style="background-color: #04401f">
            <div class="container-fluid">
                <a href="" class="" style="color: #fff;font-family: Courier;">
                    {{-- CPSU OFES V.1.0 --}}
                </a>

                <div class="" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars" style="color: #fff"></i></a>
                        </li>
                    </ul>
                </div>

                <div id="cpsulogoImage" style="z-index: 999">
                    <img src="{{ asset('template/img/cpsulogov4.png') }}" style="width:80px;" class="center-top">
                </div>

                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button" style="color: #fff">
                             
                        </a>
                    </li>
                </ul>
            </div>
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

        <div class="content-wrapper" style="background-color: #daf1ea !important">
            <div class="content">
                <div class="">
                    <div class="row" style="padding-top: 15px;">
                        <div class="col-lg-6 offset-lg-3 col-lg-offset-4 col-lg-center px-3">
                            <div class="card">
                                <div class="card-body" id="alertImage">
                                    
                                </div>
                            </div>
                            <div class="card card-secondary card-outline">
                                <div class="card-body text-center">
                                    <h1 class="text-success"><strong>Thank You!</strong></h1>
                                    <h3>Your <strong>Faculty Evaluation</strong> has been submitted successfully!</h3>
                                    <h5>Your feedback is valuable in improving the quality of education.</h5>
                                    <h5>You may return to the dashboard or close this window.</h5>
                                    
                                    <a href="{{ route('evalsubjfacStore') }}" class="btn btn-secondary form-control form-control-md mt-3">Go Back to Dashboard</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="main-footer text-sm text-center" style="background-color: #daf1ea; border-top: none;">
            <div class="float-right d-none d-sm-inline "></div>
            <i class="text-dark">CPSU OFES V.1.0: Maintained and Managed by Management Information System Office (MISO) under the Leadership of Dr. Aladino C. Moraca Copyright © 2025 CPSU, All Rights Reserved</i>
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

    <!-- jquery-validation -->
    <script src="{{ asset('template/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('template/plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('template/plugins/toastr/toastr.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('template/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Moment -->
    <script src="{{ asset('template/plugins/moment/moment.min.js') }}"></script>
</body>
</html>
   