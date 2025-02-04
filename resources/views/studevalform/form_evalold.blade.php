<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free-V6/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/qce-style.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('template/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Logo  -->
    <link rel="shortcut icon" type="" href="{{ asset('template/img/CPSU_L.png') }}">

    <style>
        #alertImage {
            background: url('{{ asset('template/img/formheader.jpg') }}') no-repeat center center;
            background-size: cover;
            height: 100%;
            width: 100%;
        }

        .form-control {
            border: none;
            border-bottom: 2px solid #ccc;
            border-radius: 0;
            box-shadow: none;
            width: 50%;
            outline: none;
            padding: 5px 0;
        }

        .form-control:focus {
            border-bottom-color: green;
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
            gap: 5px; /* Space between radio and text */
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
        .center-top {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

    </style>
</head>
<body class="hold-transition layout-top-nav layout-navbar-fixed text-sm">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light" style="background-color: #04401f">
            <div class="container-fluid">
                <div href="" class="" style="color: #fff;font-family: Courier;">
                    CPSU QCE V.1.0
                </div>

                <div class="" style="z-index: 999">
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
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container"></div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-lg-8 mx-auto">
                            <div class="alert alert-default alert-dismissible" id="alertImage">
                                <h1><br><br></h1>
                            </div>

                            @if(session('success'))
                                <div class="alert alert-success" style="font-size: 12pt;">
                                    <i class="fas fa-check"></i> {{ session('success') }}
                                </div>
                                @endif

                                @if(session('error'))
                                <div class="alert alert-danger" style="font-size: 12pt;">
                                    <i class="fas fa-exclamation-triangle"></i> {{ session('error') }}
                                </div>
                            @endif
                            <div class="card card-success card-outline card-tabs">
                                <div class="card-body">
                                    <h1></h1>
                                    <p>Please evaluate the following items by selecting the appropriate checkboxes according to the legend below:</p>
                                    <p><center><strong>(1) Poor &nbsp;&nbsp;&nbsp;&nbsp; (2) Fair  &nbsp;&nbsp;&nbsp;&nbsp;(3) Satisfactory &nbsp;&nbsp; &nbsp;&nbsp; (4) Very Satisfactory  &nbsp;&nbsp; &nbsp;&nbsp; (5) Outstanding</strong></center></p>
                                </div>
                            </div>

                            <form method="post" action="" onsubmit="return checkForm(this);">
                                @csrf

                                <input type="hidden" name="title_id" value="">

                                <div class="card">
                                    <div class="card-body">
                                        <label>Rating Period:</label>
                                        <input type="text" name="name" class="form-control" placeholder="Rating Period" required>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <label>Name of Faculty:</label>
                                        <input type="text" name="name" class="form-control" placeholder="Name of Faculty" required>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <label>Academic Rank:</label>
                                        <input type="text" name="name" class="form-control" placeholder="Academic Rank:" required>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <label>Evaluators:</label><br>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group clearfix">
                                                    <div class="icheck-success d-inline">
                                                        <input type="radio" id="radioPrimary1self" name="r1">
                                                        <label for="radioPrimary1self">
                                                            Self
                                                        </label>
                                                    </div>
                                                    <div class="icheck-success d-inline">
                                                        <input type="radio" id="radioPrimary2student" name="r1">
                                                        <label for="radioPrimary2student">
                                                            Student
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group clearfix">
                                                    <div class="icheck-success d-inline">
                                                        <input type="radio" id="radioPrimary1peer" name="r1">
                                                        <label for="radioPrimary1peer">
                                                            Peer
                                                        </label>
                                                    </div>
                                                    <div class="icheck-success d-inline">
                                                        <input type="radio" id="radioPrimary2supervisor" name="r1">
                                                        <label for="radioPrimary2supervisor">
                                                            Supervisor
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                @foreach($question as $dataformlinksquestions)
                                    <input type="hidden" name="question[]" value="{{ $dataformlinksquestions->id }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"> {{ $loop->iteration }}.) {{ $dataformlinksquestions->questiontext }}</h5>
                                            <p class="card-text mt-5"></p>
                                            <div class="radio-group">
                                                <a href="#" class="card-link text-dark">
                                                    <input type="radio" id="radio-1-{{ $loop->index }}" name="question_rate[{{ $loop->index }}][]" value="1" required>
                                                    <label for="radio-1-{{ $loop->index }}">1</label>
                                                </a>
                                                <a href="#" class="card-link text-dark">
                                                    <input type="radio" id="radio-2-{{ $loop->index }}" name="question_rate[{{ $loop->index }}][]" value="2" required>
                                                    <label for="radio-2-{{ $loop->index }}">2</label>
                                                </a>
                                                <a href="#" class="card-link text-dark">
                                                    <input type="radio" id="radio-3-{{ $loop->index }}" name="question_rate[{{ $loop->index }}][]" value="3" required>
                                                    <label for="radio-3-{{ $loop->index }}">3</label>
                                                </a>
                                                <a href="#" class="card-link text-dark">
                                                    <input type="radio" id="radio-4-{{ $loop->index }}" name="question_rate[{{ $loop->index }}][]" value="4" required>
                                                    <label for="radio-4-{{ $loop->index }}">4</label>
                                                </a>
                                                <a href="#" class="card-link text-dark">
                                                    <input type="radio" id="radio-5-{{ $loop->index }}" name="question_rate[{{ $loop->index }}][]" value="5" required>
                                                    <label for="radio-5-{{ $loop->index }}">5</label>
                                                </a>
                                                {{-- <a href="#" class="card-link text-dark"><input type="radio" name="question_rate[{{ $loop->index }}][]" value="1"> <span>1</span></a>
                                                <a href="#" class="card-link text-dark"><input type="radio" name="question_rate[{{ $loop->index }}][]" value="2"> <span>2</span></a>
                                                <a href="#" class="card-link text-dark"><input type="radio" name="question_rate[{{ $loop->index }}][]" value="3"> <span>3</span></a>
                                                <a href="#" class="card-link text-dark"><input type="radio" name="question_rate[{{ $loop->index }}][]" value="4"> <span>4</span></a>
                                                <a href="#" class="card-link text-dark"><input type="radio" name="question_rate[{{ $loop->index }}][]" value="5"> <span>5</span></a> --}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach     
                                
                                <div class="card">
                                    <div class="card-body">
                                        <p>Comments:</p>
                                        <input type="text" name="feedback" class="form-control" placeholder="Your Answer" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success btn-md"  onclick="this.disabled=true; this.form.submit();">
                                    <i class="fas fa-save"></i> Submit
                                </button>
                            </form>
                            <br><br><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <!-- <footer class="main-footer">
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
        </footer> -->
    </div>
    <!-- ./wrapper -->

    

    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('template/dist/js/qce.min.js') }}"></script>

    <script>
        function checkForm(form) {
            form.querySelector('button[type="submit"]').disabled = true;
            return true;
        }
    </script>
</body>
</html>
