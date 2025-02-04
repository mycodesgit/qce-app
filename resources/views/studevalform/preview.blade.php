@extends('layouts.masterlayouts')

@section('body')

<style>
    #alertImage {
        background: url('{{ asset('template/img/formheader.jpg') }}') no-repeat center center;
        background-size: cover;
        height: 100%;
        width: 100%;
        border-radius: 5px;
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
</style>

<div class="content-wrapper" style="background-color: #daf1ea !important">
    <div class="content-header">
        <div class="container-fluid">
            
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="col-lg-6 offset-lg-3 col-lg-offset-4 col-lg-center px-3">
                <div class="card">
                    <div class="card-body" id="alertImage">
                        
                    </div>
                </div>

                <form method="post" action="" enctype="multipart/form-data" id="admissionApply">
                    @csrf
                    
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
                                            <input type="text" name="name" class="form-control required-input" placeholder="Rating Period" value="Februay - June" required>
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
                                            <input type="text" name="name" class="form-control required-input" placeholder="Name of Faculty" value="Faculty 1" required>
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
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title m-0">Personal Information</h5>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="">
                                    <label>Evaluators:</label><br>
                                    <div class="form-row">
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
                        </div>

                        @foreach ($question as $catName => $questions)
                            <div class="category-section">
                                <div class="card" style="">
                                    <div class="card-body">
                                        <h4 class="category-title">{{ $catName }}</h4>
                                    </div>
                                </div>
                                @foreach($questions as $dataformlinksquestions)
                                    <input type="hidden" name="question[]" value="{{ $dataformlinksquestions->id }}">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                {{ $loop->iteration }}.) {{ $dataformlinksquestions->questiontext }}
                                            </h5>
                                            <p class="card-text mt-5"></p>
                                            <div class="radio-group">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <a href="#" class="card-link text-dark">
                                                        <input type="radio" id="radio-{{ $i }}-{{ $dataformlinksquestions->id }}" name="question_rate[{{ $dataformlinksquestions->id }}]" value="{{ $i }}" required>
                                                        <label for="radio-{{ $i }}-{{ $dataformlinksquestions->id }}">{{ $i }}</label>
                                                    </a>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <div id="card-3" style="display: none;">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label>Comments:</label>
                                            <input type="text" name="feedback" class="form-control" placeholder="Your comments here">
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
        
@endsection