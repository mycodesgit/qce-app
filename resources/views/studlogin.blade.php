<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>CPSU OFES V.1.0 - Login</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/bootstrap.min.css') }}" crossorigin="anonymous">
    <!-- Login Design -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/login-style.css') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free-v6/css/all.min.css')}}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('template/plugins/toastr/toastr.min.css') }}">
    <!-- Logo -->
    <link rel="shortcut icon" type="" href="{{ asset('template/img/CPSU_L.png') }}">

</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #04401f;">
                {{-- <div id="particles-js"></div> --}}
                <div class="featured-image mb-3">
                    <center><img src="{{ asset('template/img/cpsulogov4.png') }}" class="img-fluid" id="" style="width: 100px; padding-top: 0px;"></center>
                    <p class="text-white" style="font-family: 'Courier New', Courier, monospace; font-weight: 600; font-size: 1.5em !important">CPSU OFES</p>
                </div>
                <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Online Faculty Evaluation System</br></small>
                {{-- <center><img src="{{ asset('template/img/cpsulogov4.png') }}" class="img-fluid" id="cpsulogoleftsideImage" style="width: 80%; padding-top: 0px;"></center> --}}
            </div> 
        
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    @php 
                        use App\Models\EvaluationDB\QCEsetting;
                        $setevalmode = QCEsetting::first();
                    @endphp

                    <div class="header-text mb-4 text-center">
                        <img src="{{ asset('template/img/cpsulogov4.png') }}" style="width:100px; margin-top: -250px" id="cpsulogoImage">
                        <h2>Hi, Cenphilian</h2>
                        @if($setevalmode->statuseval === 'Off')
                            <p>just wait</p>
                        @else
                            <p>Sign in to start session</p>
                        @endif
                    </div>

                    @if($setevalmode->statuseval === 'Off')
                        <form>
                            @csrf
                            <div class="input-group mb-3">
                                <h1>Faculty Evaluation is not yet Started</h1>
                            </div>
                            <br><br><br>
                        </form>
                    @else
                        <form action="{{ route('empstudlogin') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="studid" class="form-control form-control-lg bg-light fs-6" placeholder="Student ID number" id="studentIdInput" autofocus>
                            </div>
                            <div class="input-group mb-1">
                                <input type="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" id="studentPassInput">
                            </div>
                            <div class="input-group mb-5 d-flex justify-content-between">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="formCheck" onclick="myFunction()">
                                    <label for="formCheck" class="form-check-label text-secondary"><small>Show Password</small></label>
                                </div>
                                <div class="forgot">
                                    {{-- <small><a href="#">Forgot Password?</a></small> --}}
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <button class="btn btn-lg btn-success w-100 fs-6">Login</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div> 
            <span style="font-size: 9pt; text-align: center; margin-top: 10px;">Maintained and Managed by Management Information System Office (MISO) under the Leadership of Dr. Aladino C. Moraca.</span>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Moment -->
    <script src="{{ asset('template/plugins/moment/moment.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('template/plugins/toastr/toastr.min.js') }}"></script>
    {{-- <script src="{{ asset('particles/particles.js') }}"></script>
    <script src="{{ asset('particles/app.js') }}"></script> --}}
    <!-- Context -->
    <script src="{{ asset('js/basic/contextmenu.js') }}"></script>
    

    <script>
        $(document).ready(function() {
            @if(session('error'))
                toastr.error("{{ session('error') }}", "Error", {
                    closeButton: false,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 10000
                });
            @endif

            @if(session('success'))
                toastr.success("{{ session('success') }}", "Success", {
                    closeButton: false,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 10000
                });
            @endif
        });

        function myFunction() {
            var x = document.getElementById("studentPassInput");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>

</body>
</html>