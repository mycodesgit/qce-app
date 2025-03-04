@extends('layouts.masterlayouts')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
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
                                
                                {{-- <a href="{{ route('evalsubjfacStore') }}" class="btn btn-secondary form-control form-control-md mt-3">Go Back to Dashboard</a> --}}
                                <h5 class="mt-3">Redirecting in <span id="countdown">5</span> seconds...</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let countdown = 6;
    let countdownElement = document.getElementById("countdown");

    function updateCountdown() {
        if (countdown > 0) {
            countdown--;
            countdownElement.textContent = countdown;
        } else {
            window.location.href = "{{ route('evalsubjfacStore') }}"; // Redirect after 5 seconds
        }
    }

    // Run countdown every second
    setInterval(updateCountdown, 1000);
</script>
        
@endsection