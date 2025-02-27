<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@php
        $title         = 'Points';
        $title2        = 'FACULTY RATING';
        $fac_name      =  $fcs->first()->qcefacname;        
        $fac_pos       = $facDesignateId->designation, ' - ', $facDesignateId->college_name;
        $campus        = '';
        if (request('campus') === 'MC') {
            $campus = 'CPSU MAIN CAMPUS';
        } elseif (request('campus') === 'VC') {
            $campus = 'CPSU VICTORIAS CAMPUS';
        } elseif (request('campus') === 'SCC') {
            $campus = 'CPSU SAN CARLOS CAMPUS';
        } elseif (request('campus') === 'HC') {
            $campus = 'CPSU HINIGARAN CAMPUS';
        } elseif (request('campus') === 'MP') {
            $campus = 'CPSU MOISES PADILLA CAMPUS';
        } elseif (request('campus') === 'IC') {
            $campus = 'CPSU ILOG CAMPUS';
        } elseif (request('campus') === 'CA') {
            $campus = 'CPSU CANDONI CAMPUS';
        } elseif (request('campus') === 'CC') {
            $campus = 'CPSU CAUAYAN CAMPUS';
        } elseif (request('campus') === 'SC') {
            $campus = 'CPSU SIPALAY CAMPUS';
        } elseif (request('campus') === 'HinC') {
            $campus = 'CPSU HINOBAAN CAMPUS';
        }
        
        $dept          = $facId->dept;
        $rate_period   = 'February 2024 - June 2024';   
        $sem_range     = '2nd Semester';                   
        $sch_yr        = request('schlyear');
        $reviewer      = 'REVIEWER NAME';
        $reviewer_pos  = 'Reviewer Position';
        $date_signed   = 'July 1, 2024';
        $endorser      = 'FERNANDO D. ABELLO, Ph. D.';
        $endorser_pos  = 'Endorser Position';
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
    <div class="header">
		<center><img src="{{ public_path('template/img/allformheader/header.png') }}" width="55%" style="text-align: center !important;"></center>
	</div>

    <div>        
        <center style="margin-top: 15px; font-weight: bold;">Rating Period: {{ $rate_period }} ({{ $sem_range }})</center>
    </div>

    <div class="details" style="margin-top: 20px; margin-left: 25px;">
        <span style="display: inline-block; width: 210px; vertical-align: top;">Name of Faculty:</span>
        <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: center; border-bottom: 1px solid black; width: 250px;">
            <span style="font-weight: bold">{{ $fac_name }}</span>
        </div>
    </div>

    <div class="details" style="float: right; margin-top: -15px; margin-right: 55px;">
        <span style="display: inline-block; width: 50px; vertical-align: top;">Campus:</span>
        <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: center; border-bottom: 1px solid black; width: 235px;">
            <span style="font-weight: bold">{{ $campus }} - {{ $dept }}</span>
        </div>
    </div>

    <div class="details" style="margin-top: 5px; margin-left: 25px;">
        <span style="display: inline-block; width: 210px; vertical-align: top;">Present Rank or Position:</span>
        <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: center; border-bottom: 1px solid black; width: 250px;">
            <span style="font-weight: bold;">{{ $fac_pos }}</span>
        </div>
    </div>

	<div id="table1" class="table">
        @php
            $total_studentEval = $total_student_eval * 0.6 * 0.6;
            $total_supervisorEval = $supervisor_total * 0.4 * 0.6;
            $overalltotal_points = 0;
        @endphp
        <table border="1" width="94%" style="margin-bottom: 20px; margin-left: 20px; margin-right: 20px; border-collapse: collapse;">		
            <tr>
                <th rowspan="2" style="width: 20%">KRA 1 - INSTRUCTION</th>
                <th colspan="2">SY {{ $sch_yr }}</th>
                <th rowspan="2">AVERAGE RATING FOR THE WHOLE RATING PERIOD</th>
                <th rowspan="2">POINTS</th>
            </tr>
            <tr>
                <th style="height: 40px; text-align: center;">1st Sem Rating</th>
                <th style="height: 40px; text-align: center;">2nd Sem Rating</th>
            </tr>
            <tr>
                <td style="font-weight: bold;">1. FACULTY PERFORMANCE</td>
                <td style="font-weight: bold; width: 100%;" colspan="4"></td>
            </tr>
            <tr>
                <td style="font-weight: bold;">1.1 STUDENT EVAL'N. (60%)</td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;">{{ $total_student_eval }}</td>
                <td style="text-align: center;">{{ $total_student_eval }}</td>
                <td style="text-align: center;">{{ $total_studentEval }}</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>            
            </tr>
            <tr>
                <td style="font-weight: bold;">1.2 SUPERVISOR EVAL'N. (40%)</td>
                <td style="text-align: center;">&nbsp;</td>
                <td style="text-align: center;">{{ $supervisor_total }}</td>
                <td style="text-align: center;">{{ $supervisor_total }}</td>
                <td style="text-align: center;">{{ $total_supervisorEval }}</td>
            </tr>
            <tr>
                <td style="font-weight: bold; text-align: center;">TOTAL POINTS</td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;">{{ $overalltotal_points = $total_studentEval + $total_supervisorEval }}</td>
            </tr>            
        </table>
	</div>    

    <div class="details" style="margin-top: 30px; margin-left: 25px;">
        <span style="display: inline-block; width: 210px; vertical-align: top;">Reviewed and Discussed with:</span>
        <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: center; border-bottom: 1px solid black; width: 250px;">
            <span style="font-weight: bold">{{ $reviewer }}</span>
        </div>
    </div>

    <div class="details" style="margin-top: 5px; margin-left: 25px;">
        <span style="display: inline-block; width: 210px; vertical-align: top;">Position:</span>
        <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: center; border-bottom: 1px solid black; width: 250px;">
            <span>{{ $reviewer_pos }}</span>
        </div>
    </div>

    <div style="float: right; margin-top: -40px; margin-right: 55px;">
        <div class="details">
            <span style="display: inline-block; width: 210px; vertical-align: top;">Endorsed by:</span>
            <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: center; border-bottom: 1px solid black; width: 250px;">
                <span style="font-weight: bold">{{ $endorser }}</span>
            </div>
        </div>

        <div class="details" >
            <span style="display: inline-block; width: 210px; vertical-align: top;">Position:</span>
            <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: center; width: 250px;">
                <span>Vice President for Academic Affairs</span>
            </div>
            
        </div>
    </div> 

    <div class="details" style="margin-top: 5px; margin-left: 25px;">
        <span style="display: inline-block; width: 210px; vertical-align: top;">Date:</span>
        <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: center; border-bottom: 1px solid black; width: 250px;">
            <span>{{ $date_signed }}</span>
        </div>
    </div>

    <div class="details" style="margin-top: 30px; margin-left: 25px;">
        <span style="display: inline-block; width: 210px; vertical-align: top;">Conforme:</span>
        <div style="display: inline-block; margin-left: 20px; vertical-align: top; text-align: center; border-bottom: 1px solid black; width: 250px;">
            <span style="font-weight: bold">{{ $fac_name }}</span>
        </div>
        <div style="text-align: center; width: 250px; margin-left: 233px;">
            <span>Signature of Ratee</span>
        </div>
    </div>
	
    <div class="footer">
        <center><img src="{{ public_path('template/img/allformheader/footer.png') }}" width="55%" style="text-align: center !important;"></center>
    </div>
</body>
</html>