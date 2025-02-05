<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style>
		body {
			font-size: 13pt;
		}
		.radio-container {
			margin-top: 5px;
            display: flex;
            align-items: center; /* Aligns the radio button and label */
            gap: 5px; /* Adds some space between the radio button and text */
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
            font-size: 13pt;
        } 
        #table th {
            border: 1px solid #000;
            padding: 1px;
            font-weight: normal !important;
        }
        #table-inside {
            margin-top: 10px;
            font-family: Arial;
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #fff;
		}

		#table-inside td, #table-inside th {
		    border: 1px solid #fff;
		}
		#table-inside td {
		    font-family: monospace;
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
        .comment-lines hr {
	        border: none;
	        margin-top: 20px !important;
	        border-top: 1px solid #000;
	        margin: 10px 0;
	        width: 100%;
	    }

	    .comment-lines {
		    margin-top: 5px;
		}

		.line {
		    border-bottom: 1px solid black;
		    height: 20px; /* Adjust the height to match the lines in your image */
		    line-height: 20px;
		    padding-left: 5px;
		}

	</style>
</head>
<body>
	<div>
		<center>
			<p>Appendix A</p>
		</center>
	</div>

	<div style="margin-top: 20px">
		<center>
			<p>
				The QCE of the NBC No. 461<br>
				Instrument for Instruction/Teaching Effectiveness
			</p>
		</center>
	</div>

	<div>
		<p>Rating Period:__________________________ to _________________________________________</p>
		<p>Name of Faculty:________________________ Academic Rank: _____________________________</p>
		<p>Evaluators:</p>

		
		<div class="radio-container">
	        <input type="radio" id="self" style="margin-left: 180px;">
	        <label for="self">Self</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	        <input type="radio" id="peer" style="margin-left: 50px;">
	        <label for="peer">Peer</label>
	    </div>
		<div class="radio-container">
	        <input type="radio" id="student" style="margin-left: 180px;">
	        <label for="student">Student</label>
	        <input type="radio" id="supervisor" style="margin-left: 128px;">
	        <label for="supervisor">Supervisor</label>
	    </div>
	</div>

	<div style="margin-top: 30px">
		<p>Instruction: Please evaluate the faculty using the scale below. Encircle your rating.</p>
	</div>

	<div>
		<table id="table">
			<thead>
				<tr>
					<th width="10%">Scale</th>
					<th width="28%">Descriptive Rating</th>
					<th>Qualitative Description</th>
				</tr>
			</thead>
			<tbody>
				@foreach($inst as $datainst)
					<tr>
						<td style="padding-left: 7px;">{{ $datainst->inst_scale }}</td>
						<td><center>{{ $datainst->inst_descRating }}</center></td>
						<td>{{ $datainst->inst_qualDescription }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div style="margin-top: 30px">
		@php 
		    $no = 1; 
		    $lastCategory = $quest->groupBy('catName')->keys()->last(); // Get the last category name
		    $grandTotal = 0; // Initialize grand total outside the loop
		@endphp
		@foreach ($quest->groupBy('catName') as $catName => $questions)
		    @php 
		    	$no = 1; 
		    	$sectionTotal = 0;
		    @endphp 

		    <table id="table" border="1" style="border-collapse: collapse; width: 100%;">
		        <thead>
		            <tr>
		                <th style="font-weight: bold !important; text-align: left;">{{ $catName }}</th>
		                <th style="font-weight: bold !important; text-align: center;" colspan="5">Scale</th>
		            </tr>
		        </thead>
		        <tbody>
					@foreach($questions as $dataquest)
					    @php
					        $savedRatings = json_decode($facrated->first()->question_rate ?? '{}', true);
					        $savedRating = $savedRatings[$dataquest->id] ?? null;

					        // Total score for the current question
					        if ($savedRating) {
		                        $sectionTotal += $savedRating;
		                    }
					    @endphp
					    <tr>
					        <td>{{ $no++ }}. {{ $dataquest->questiontext }}</td>
					        @for ($i = 5; $i >= 1; $i--) 
					            <td style="text-align: center; width: 40px; margin-right: 2px; padding-top: 10px; vertical-align: middle;">
					                @if ($savedRating == $i)
					                    <img src="{{ public_path('template/img/rate/' . $i . '.png') }}" alt="{{ $i }}" width="20">
					                @else
					                    {{ $i }}
					                @endif
					            </td>
					        @endfor
					    </tr>
					@endforeach

					{{-- Total Score for Section --}}
					<tr>
						<td style="font-weight: bold; text-align: right;">Total Score:</td>
					    <td colspan="5" style="text-align: left; font-weight: bold; padding-left: 10px"> {{ $sectionTotal  }}</td>
					</tr>
					
					{{-- Grand Total Row (Only for Last Category) --}}
					@php
		                $grandTotal += $sectionTotal;
		            @endphp
					@if ($catName == $lastCategory)
					    <tr>
					    	<td style="font-weight: bold; text-align: right;">GRAND TOTAL:</td>
					        <td colspan="5" style="font-weight: bold; text-align: left; padding-left: 10px"> {{ $grandTotal }}</td>
					    </tr>
					@endif
		        </tbody>
		    </table>
		    <br>
		@endforeach
	</div>

	<div>
		<div>
		    <label style="font-weight: bold;">Comments:</label>
		    <div class="comment-lines">
		        @php
		            $comments = explode("\n", wordwrap($facrated->first()->qcecomments, 500, "\n", true));
		        @endphp
		        @for($i = 0; $i < 4; $i++)
		            <div class="line">
		                {{ isset($comments[$i]) ? $comments[$i] : '' }}
		            </div>
		        @endfor
		    </div>
		</div>
	</div>

	<div>
		<p>Signature of Evaluator &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:__________________________ </p>
		<p>Name of Evaluator &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:__________________________ </p>
		<p>Position of Evaluator &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:__________________________ </p>
		<p>Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:__________________________ </p>
</body>
</html>