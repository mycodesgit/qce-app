@extends('layouts.masterlayouts')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item breadcrumbactive"><a href="{{ route('dash') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <form method="post" action="{{ route('toggleEval') }}" id="">
                        @csrf

                        <div class="alert alert-secondary alert-dismissible">
                            <div class="form-group mt-3">
                                <div class="form-row">
                                    <div class="col-8">
                                        <div class="icheck-success">
                                            <input type="checkbox" id="evalset" name="statuseval" data-url="{{ route('toggleEval') }}" {{ $setevalmode->statuseval === 'On' ? 'checked' : '' }}>
                                            <label for="evalset">
                                                <h3 style="margin-top: -5px">Faculty Evaluation Status</h3>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h5><i class="icon fas fa-exclamation-triangle text-warning"></i>Note!</h5>
                            <span class="text-warning text-bold">Check the checkbox if you want start Faculty Evaluation</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('evalset').addEventListener('change', function () {
        let isChecked = this.checked;
        let url = this.dataset.url;

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value
            },
            body: JSON.stringify({ statuseval: isChecked })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                //alert(data.message); // Optional: Show a confirmation alert
                Swal.fire({
                    icon: 'success',
                    title: 'Online Faculty Evaluation System',
                    text: data.message,
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    text: 'An error occurred!',
                });
            }
        })
        .catch(error => console.error('Error:', error));
    });

    
</script>
        
@endsection