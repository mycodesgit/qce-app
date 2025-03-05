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

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row" style="padding-top: 15px;">
                <div class="col-lg-8 offset-lg-2 col-lg-offset-2 col-lg-center px-3">
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
                        <input type="hidden" name="prog" value="{{ $facdetail->first()->dept }}">
                        <input type="hidden" name="subjidrate" value="{{ request('id') }}">

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
                                                <input type="text" name="qcefacname" class="form-control required-input" placeholder="Name of Faculty" value="{{ request('qcefacname') }}" required readonly>
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
                                                <input type="text" name="name" class="form-control" placeholder="Academic Rank:" value="{{ $facdetail->first()->rank ?? '' }}" readonly>
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
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label>Name of Faculty:</label>
                                                    <input type="text" name="qcefacname" class="form-control required-input" placeholder="Name of Faculty" value="{{ request('qcefacname') }}" required readonly>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Academic Rank:</label>
                                                    <input type="text" name="name" class="form-control required-input" placeholder="Academic Rank:" value="{{ $facdetail->first()->rank }}" required readonly>
                                                </div>
                                                <div class="col-md-12">
                                                    <label>Subject:</label>
                                                    <input type="text" name="name" class="form-control required-input" placeholder="Academic Rank:" value="{{ $mysubjstarteval->first()->subSec }} | {{ $mysubjstarteval->first()->sub_name }} - {{ $mysubjstarteval->first()->sub_title }}" required readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="progress-section d-flex align-items-center justify-content-between mt-3">
                            <button type="button" class="btn btn-default" id="back-btn" onclick="prevCard(currentCard - 1)" style="display: none;">Back</button>
                            <button type="button" class="btn btn-primary" id="next-btn" onclick="nextCard(currentCard + 1)" style="display: none;">Next</button>
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
        
@endsection