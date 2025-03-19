@extends('layouts.masterlayouts')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active breadcrumbactive">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info d-flex align-items-center justify-content-between pl-3 pr-3 pb-3 pt-3 card-curve" style="background-color: #00bc8c !important">
                        <div class="text-left">
                            <div class="inner">
                                <h3>{{ $enrlstudcountfirst }}</h3>
                                <p>1st Stud Enrolled this Sem</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info d-flex align-items-center justify-content-between pl-3 pr-3 pb-3 pt-3 card-curve" style="background-color: #89c9b6 !important">
                        <div class="text-left">
                            <div class="inner">
                                <h3>{{ $enrlstudcountsecond }}</h3>
                                <p>2nd Stud Enrolled this Sem</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info d-flex align-items-center justify-content-between pl-3 pr-3 pb-3 pt-3 card-curve" style="background-color: #9dcda8 !important">
                        <div class="text-left">
                            <div class="inner">
                                <h3>{{ $enrlstudcountthird }}</h3>
                                <p>3rd Stud Enrolled this Sem</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info d-flex align-items-center justify-content-between pl-3 pr-3 pb-3 pt-3 card-curve" style="background-color: #008b51 !important">
                        <div class="text-left">
                            <div class="inner">
                                <h3>{{ $enrlstudcountfourth }}</h3>
                                <p>4th Stud Enrolled this Sem</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="icon">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fas fa-chart-simple"></i> Evaluated Degree Programs and Sections
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="overflow-x: auto; white-space: nowrap;">
                                <canvas id="degreeeval-chart" style="height: 330px; min-height: 330px; width: 1200px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fas fa-chart-simple"></i> Evaluated Faculty
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="overflow-x: auto; white-space: nowrap;">
                                <canvas id="facultyeval-chart" style="height: 330px; min-height: 330px; width: 1200px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        
<script>
    var evalcountchartReadRoute = "{{ route('getEvalData') }}";
    var evalcountfacchartReadRoute = "{{ route('getEvalFacData') }}";
</script>

@endsection