<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@php
		$title = 'Summary of Evaluation for Instruction/Teaching Effectiveness';
		$title2 = 'SUMMARY';
		$fac_name = $fcs->qcefacname;
		$rate_period = $fcs->ratingfromto;
		$fac_pos = 'FACULTY POSITION';
		$studentRating = 4.5;
		$supervisorRating = 3.5;
		$overallMean = ($studentRating * 0.6) + ($supervisorRating * 0.4);
		$drafter = 'MARY GRACE NOREEN P. LEDUNA-JARANILLA, Ph. D.';
		$notary1 = 'GRENNY I. JUNGCO, Ph. D.';
		$notary2 = 'FERNANDO D. ABELLO, Ph. D.';

		$evaluations = [
			['evaluator' => 'Student', 'rating' => $studentRating, 'interpretation' => getInterpretation($studentRating)],
			['evaluator' => 'Supervisor', 'rating' => $supervisorRating, 'interpretation' => getInterpretation($supervisorRating)],
			['evaluator' => 'Overall Mean', 'rating' => number_format($overallMean, 1), 'interpretation' => getInterpretation($overallMean), 'bold' => true]
		];

		function getInterpretation($rating) {
			if ($rating >= 4.50 && $rating <= 5.00) {
				return 'Outstanding';
			} elseif ($rating >= 3.50 && $rating <= 4.49) {
				return 'Very Satisfactory';
			} elseif ($rating >= 2.50 && $rating <= 3.49) {
				return 'Satisfactory';
			} elseif ($rating >= 1.50 && $rating <= 2.49) {
				return 'Fair';
			} elseif ($rating >= 1.00 && $rating <= 1.49) {
				return 'Poor';
			} else {
				return 'Invalid Rating';
			}
		}
	@endphp
	<title>{{ $title2 }}</title>
	<style>
		body {
			font-family: Calibri, Arial, sans-serif !important;
		}
		.title {
			margin-top: 10px;
			margin-bottom: 10px;
			font-weight: bold;
			font-size: 12pt;
		}
		.details {			
			margin-left: 20px;
			text-align: left;
			font-size: 11pt;
		}
		#table1 {
			margin-top: 20px;
			font-size: 11pt;
		}
		.footer {
		    position: fixed; /* Change to absolute if needed */
		    bottom: 0;
		}
	</style>
</head>
<body>
	<div class="header" style="margin-top: -3px;">
		<center><img src="{{ public_path('template/img/allformheader/header-qa.png') }}" width="96%" style="text-align: center !important;"></center>
	</div>
	
	<div class="title">
		<center><u><h5>{{ strtoupper($title) }}</h5></u></center>
	</div>

	<div class="details">
		<span style="display: inline-block; width: 120px; vertical-align: top;">Name of Faculty:</span><b style="display: inline-block; vertical-align: top;">{{ $fac_name }}</b>
	</div>

	<div class="details">
		<span style="display: inline-block; width: 120px; vertical-align: top;">Rating Period:</span><b style="display: inline-block; vertical-align: top;">{{ $rate_period }}</b>
	</div>

	<div class="details">
		<span style="display: inline-block; width: 120px; vertical-align: top;">Academic Rank:</span><b style="display: inline-block; vertical-align: top;">{{ $fac_pos }}</b>
	</div>

	<div id="table1">
		@php
            $total_studentEval = $total_student_eval / 20 * 0.60;
            $total_supervisorEval = $supervisor_total / 20 * 0.40;
            $overallmean_points = 0;
        @endphp

		<table border="1" width="94%" style="margin-top: 20px; margin-bottom: 20px; margin-left: 20px; margin-right: 20px; border-collapse: collapse;">			
			<tr>
				<th style="height: 40px;">Evaluator</th>
				<th style="height: 40px;">Rating</th>
				<th style="height: 40px;">Interpretation</th>
			</tr>	
			{{-- @foreach ($evaluations as $evaluation)
				@php
					$style = isset($evaluation['bold']) && $evaluation['bold'] ? 'font-weight: bold;' : '';
				@endphp
				<tr style="{{ $style }}">
					<td style="height: 40px; padding-left: 10px;">{{ $evaluation['evaluator'] }}</td>
					<td style="height: 40px; text-align: center;">{{ $total_studentEval }}</td>
					<td style="height: 40px; text-align: center;">{{ getInterpretation(floatval(strip_tags($evaluation['rating']))) }}</td>
				</tr>
			@endforeach --}}
				<tr style="">
					<td style="height: 40px; padding-left: 10px;">Student</td>
					<td style="height: 40px; text-align: center;">{{ $total_student_eval }} ({{ number_format($total_studentEval, 2) }})</td>
					<td style="height: 40px; text-align: center;">{{ getInterpretation($total_studentEval) }}</td>
				</tr>
				<tr style="">
					<td style="height: 40px; padding-left: 10px;">Supervisor</td>
					<td style="height: 40px; text-align: center;">{{ $supervisor_total }} ({{ number_format($total_supervisorEval, 2) }})</td>
					<td style="height: 40px; text-align: center;"></td>
				</tr>
				<tr style="">
					<td style="height: 40px; padding-left: 10px;"><b>Overall Mean</b></td>
					<td style="height: 40px; text-align: center;">{{ number_format($overallmean_points =  $total_studentEval + $total_supervisorEval, 2) }}</td>
					<td style="height: 40px; text-align: center;"></td>
				</tr>
			</tr>
		</table>
	</div>

	<div class="prepared-block" style="text-align: right; margin-right: 20px;">
		<div style="text-align: left; display: inline-block; margin-top: 20px;">
			<div style="margin-bottom: 20px;">Prepared by:<br></div>
			<center><b>{{ $drafter }}</b><br></center>
			<center>Monitoring and Evaluation Coordinator</center>
		</div>
	</div>

	<div class="noted-block" style="text-align: left; margin-left: 25px; margin-right: 20px;">
		<div style="text-align: left; display: inline-block; margin-top: 20px;">
		<br><br>Noted by:<br><br><br>
			<b>{{ $notary1 }}</b><br>
			Quality Assurance Director<br><br><br><br>
			<b>{{ $notary2 }}</b><br>
			Vice President for Academic Affairs
		</div>
	</div>
	
	<div class="footer">
		<center><img src="{{ public_path('template/img/allformheader/footer.png') }}" width="95%" style="text-align: center !important;"></center>
		<div style="text-align: center !important; font-size: 8pt; margin-top: 10px; display: flex; justify-content: space-between; width: 100%;">
		<span>Doc Control Code: CPSU-F-QA-20</span>
		<span style="margin-left: 40px;">Effective Date: 09/12/2018</span>
		<span style="margin-left: 40px;">Page No.: <b>1</b> of <b>1</b></span>
		</div>
	</div>
</body>
</html>