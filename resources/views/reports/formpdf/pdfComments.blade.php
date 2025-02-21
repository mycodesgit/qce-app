<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@php
		$fac_name = $facsum->first()->qcefacname;
		$rate_period = $facsum->first()->ratingfromto;		
		$sem_range = 'Second Semester';
		$sch_yr = $facsum->first()->schlyear;	
		$title = 'Comments';
		$title2 = 'FACULTY EVALUATION COMMENTS';
		$drafter = 'MARY GRACE NOREEN P. LEDUNA-JARANILLA, Ph. D.';
		$notary1 = 'GRENNY I. JUNGCO, Ph. D.';
		$notary2 = 'FERNANDO D. ABELLO, Ph. D.';
	@endphp
	<title>{{ $title2 }}</title>
	<style>
		body {
			font-family: Arial, sans-serif !important;
		}
		.title {
			margin-top: 10px;
			font-weight: bold;
			font-size: 12pt;
		}
		.details {			
			margin-left: 20px;
			text-align: left;
			font-size: 11pt;
		}
		.table {
			margin-top: 10px;
			font-size: 10pt;
		}
		.footer {
		    position: fixed; /* Change to absolute if needed */
		    bottom: 0;
		}
	</style>
</head>
<body>
	<div class="header">
		<center><img src="{{ public_path('template/img/allformheader/header-me.png') }}" width="95%" style="text-align: center !important;"></center>
	</div>

	<div class="details" style="margin-top: 20px;">
		<span style="display: inline-block; width: 120px; vertical-align: top;">Name of Faculty:</span><b style="display: inline-block; vertical-align: top;">{{ $fac_name }}</b>
	</div>

	<div class="details">
		<span style="display: inline-block; width: 120px; vertical-align: top; font-weight: normal;">Rating Period:</span><b style="display: inline-block; vertical-align: top; font-weight: normal">{{ $rate_period }}</b>
	</div>

	<div class="details">
		<span style="display: inline-block; width: 120px; vertical-align: top; font-weight: normal;"></span><b style="display: inline-block; vertical-align: top; font-weight: normal">{{ $sem_range }}, S.Y. {{ $sch_yr }}</b>
	</div>

	<div class="title">
		<center><h4>{{ $title }}</h4></center>
	</div>

	<b style="font-weight: bold; margin-left: 20px; font-size: 11pt;">Students:</b>

	<div id="table1" class="table">
		<table border="1" width="94%" style="margin-bottom: 20px; margin-left: 20px; margin-right: 20px; border-collapse: collapse;">		
			@php
			$evaluations = ['1. Student evaluation', '2. Student evaluation', '3. Student evaluation'];
			@endphp
			@foreach ($evaluations as $evaluation)
				<tr>
					<td style="padding-left: 10px;">{{ $evaluation }}</td>
				</tr>
			@endforeach
		</table>
	</div>    

	<b style="font-weight: bold; margin-left: 20px; font-size: 11pt;">Supervisor:</b>
	
	<div id="table2" class="table">
		<table border="1" width="94%" style="margin-bottom: 20px; margin-left: 20px; margin-right: 20px; border-collapse: collapse;">		
			<tr>
				<td style="height: 20px; padding-left: 10px;"> 1. Supervisor evaluation</td>
			</tr>
		</table>
	</div>    

	<div class="prepared-block" style="text-align: left; margin-left: 25px; margin-right: 20px;">
		<div style="text-align: left; display: inline-block; margin-top: 20px;">
			<div style="margin-bottom: 20px;">Prepared by:<br></div>
			<b>{{ $drafter }}</b><br>
			Monitoring and Evaluation Coordinator
		</div>
	</div>

	<div class="noted-block" style="text-align: left; margin-left: 25px; margin-right: 20px;">
		<div style="text-align: left; display: inline-block; margin-top: 20px;">
		<br><br>Noted by:<br><br><br>
			<b>{{ $notary1 }}</b><br>
			Quality Assurance Director<br><br><br>
			<b>{{ $notary2 }}</b><br>
			Vice President for Academic Affairs
		</div>
	</div>
	
	<div class="footer">
		<center><img src="{{ public_path('template/img/allformheader/footer.png') }}" width="95%" style="text-align: center !important;"></center>
	</div>
</body>
</html>