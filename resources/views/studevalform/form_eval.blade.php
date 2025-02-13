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

                            <form method="post" action="{{ route('facevalrateformCreate') }}"  id="evaluateFaculty">
                                @csrf

                                <input type="hidden" name="campus" value="{{ Auth::guard('kioskstudent')->user()->student->campus }}">
                                <input type="hidden" name="qceschlyearsemID" value="{{ $currsem->first()->id }}">
                                <input type="hidden" name="schlyear" value="{{ $currsem->first()->qceschlyear }}">
                                <input type="hidden" name="semester" value="{{ $currsem->first()->qcesemester }}">
                                <input type="hidden" name="qcefacID" value="{{ request('qcefacID') }}">
                                <input type="hidden" name="evaluatorname" value="{{ Auth::guard('kioskstudent')->user()->student->fname }} {{ Auth::guard('kioskstudent')->user()->student->lname }}">
                                <input type="hidden" name="evaluatorID" value="{{ Auth::guard('kioskstudent')->user()->id }}">
                                <input type="hidden" name="studidno" value="{{ Auth::guard('kioskstudent')->user()->student->stud_id }}">

                                <div id="card-1">
                                    <p>
                                        @if(Session::has('success'))
                                            <div class="alert alert-success" id="alert">{{ Session::get('success')}} {{ Session::get('admission_id')}}</div>
                                        @elseif (Session::has('fail'))
                                            <div class="alert alert-danger" id="alert">{{Session::get('fail')}}</div>
                                        @endif
                                    </p>
                                    <div class="card card-secondary card-outline text-center">
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <center>
                                                    <h6><strong>Appendix A</strong></h6>
                                                    <h6>
                                                        <strong>The QCE of the NBC No. 461<br>Instrument for Instruction/Teaching Effectiveness</strong>
                                                    </h6>
                                                </center>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <label>Rating Period:</label>
                                                        <input type="text" name="ratingfromto" class="form-control required-input" placeholder="Rating Period" value="{{ $currsem->first()->qceratingfrom }} - {{ $currsem->first()->qceratingto }}" required readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <label>Name of Faculty:</label>
                                                        <input type="text" name="qcefacname" class="form-control required-input" placeholder="Name of Faculty" value="{{ request('qcefacname') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <label>Academic Rank:</label>
                                                        <input type="text" name="name" class="form-control required-input" placeholder="Academic Rank:" value="Instructor I" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="card-2" style="display: none;">

                                    <div class="sticky-column" style="z-index: 999">
                                        <div class="card">
                                            <div class="card-body">
                                                <label>Instruction: Please evaluate the faculty using the scale below. Encircle your rating.</label>
                                                <table id="table">
                                                    <thead>
                                                        <tr>
                                                            <th width="10%"><strong>Scale</strong></th>
                                                            <th width="28%"><strong>Descriptive Rating</strong></th>
                                                            <th><strong>Qualitative Description</strong></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($inst as $datainst)
                                                            <tr>
                                                                <td style="padding-left: 7px; font-weight: bold;">{{ $datainst->inst_scale }}</td>
                                                                <td style="font-weight: bold;"><center>{{ $datainst->inst_descRating }}</center></td>
                                                                <td>{{ $datainst->inst_qualDescription }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="evaluator" class="card" style="">
                                        <div class="card-body">
                                            <div class="">
                                                <label>Evaluators:</label><br>
                                                <div class="form-row">
                                                    <div class="col-md-6">
                                                        <div class="form-group clearfix">
                                                            @if(Auth::guard('kioskstudent')->user()->role == 'Faculty')
                                                                <div class="icheck-success d-inline">
                                                                    <input type="radio" id="radioPrimary1self" value="Self" name="qceevaluator" @if(Auth::guard('kioskstudent')->user()->role == 'Faculty') checked @endif>
                                                                    <label for="radioPrimary1self">
                                                                        Self
                                                                    </label>
                                                                </div>
                                                            @endif

                                                            @if(Auth::guard('kioskstudent')->user()->role == 'Student')
                                                                <div class="icheck-success d-inline">
                                                                    <input type="radio" id="radioPrimary2student" value="Student" name="qceevaluator" @if(Auth::guard('kioskstudent')->user()->role == 'Student') checked @endif>
                                                                    <label for="radioPrimary2student">
                                                                        Student
                                                                    </label>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @foreach ($question as $catName => $questions)
                                        <div class="category-section">
                                            <div class="card" style="">
                                                <div class="card-body">
                                                    <h4 class="category-title">{{ $catName }}</h4>
                                                </div>
                                            </div>
                                            @foreach($questions as $dataformlinksquestions)
                                                <input type="hidden" class="required-input" name="question[]" value="{{ $dataformlinksquestions->id }}">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title text-bold">
                                                            {{ $loop->iteration }}.) {{ $dataformlinksquestions->questiontext }}
                                                        </h5>
                                                        <p class="card-text mt-5"></p>
                                                        <div class="radio-group" style="margin-top: 5px">
                                                            @for ($i = 5; $i >= 1; $i--)
                                                                <a href="#" class="card-link text-dark">
                                                                    <input type="radio" class="required-input" id="radio-{{ $i }}-{{ $dataformlinksquestions->id }}" name="question_rate[{{ $dataformlinksquestions->id }}]" value="{{ $i }}" required>
                                                                    <label for="radio-{{ $i }}-{{ $dataformlinksquestions->id }}">{{ $i }}</label>
                                                                </a>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="form-row">
                                                    <div class="col-md-12">
                                                        <label>Comments:</label>
                                                        <textarea class="form-control" rows="4" placeholder="Your comments here" name="qcecomments"></textarea>
                                                        <span style="font-size: 10pt; font-weight: normal; font-style: italic; color: red">Optional</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="progress-section d-flex align-items-center justify-content-between mt-3">
                                    <button type="button" class="btn btn-default" id="back-btn" onclick="prevCard(currentCard - 1)" style="display: none;">Back</button>
                                    <button type="button" class="btn btn-primary" id="next-btn" onclick="nextCard(currentCard + 1)" style="display: none;" disabled>Next</button>
                                    {{-- <button type="button" class="btn btn-info" id="ok-btn">OK</button> --}}
                                    <button type="submit" class="btn btn-primary" id="submit-btn" style="display: none;">Submit</button>

                                    <div class="progress-container d-flex align-items-center">
                                        <div class="progress" style="width: 60%; margin-right: 10px; background-color: gray; border-radius: 20px;">
                                            <div id="progress-bar" class="progress-bar bg-primary" role="progressbar" style="width: 0%;" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span id="progress-text">Page 1 of <span id="total-pages"></span></span>
                                    </div>

                                    <a href="#" onclick="clearForm()" class="btn btn-default" style="color: #5e5df0; text-decoration: underline;">Clear form</a>
                                </div>
                                <br><br>
                            </form>
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

    <!-- Validation -->
    <script src="{{ asset('js/validation/evalstud/evalValidation.js') }}"></script>
    <script src="{{ asset('js/validation/evalstud/evalSubmitValidation.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function toggleAlertImage() {
                const alertImage = document.getElementById("cpsulogoImage");
                if (!alertImage) return; // Prevents errors if element is missing

                if (window.innerWidth <= 768) {
                    alertImage.style.display = "block"; // Show on mobile
                } else {
                    alertImage.style.display = "none"; // Hide on larger screens
                }
            }

            toggleAlertImage(); // Run on page load
            window.addEventListener("resize", toggleAlertImage); // Run on window resize
        });

    </script>
</body>
</html>
   