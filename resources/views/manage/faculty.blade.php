@extends('layouts.masterlayouts')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Faculty</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item breadcrumbactive"><a href="{{ route('dash') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Faculty</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fas fa-search"></i> Select Campus
                            </h5>
                        </div>
                        <div class="card-body">
                            {{-- <form method="GET" action="{{ route('facultyFilter') }}" id="enrollStud">
                                @csrf

                                <div class="form-group" style="">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label><span class="badge badge-secondary">Campus</span></label>
                                            <select class="form-control form-control-sm" name="campus" id="campus">
                                                <option disabled selected> --Select-- </option>
                                                <option value="MC">Main</option>
                                                <option value="VC">Victorias</option>
                                                <option value="SCC">San Carlos</option>
                                                <option value="HC">Hinigaran</option>
                                                <option value="MP">Moises Padilla</option>
                                                <option value="IC">Ilog</option>
                                                <option value="CA">Candoni</option>
                                                <option value="CC">Cauayan</option>
                                                <option value="SC">Sipalay</option>
                                                <option value="HinC">Hinobaan</option>
                                                <option value="VE">Valladolid</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="form-control form-control-sm btn btn-success btn-sm">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </form> --}}
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                    <a href="{{ route('facultyFilter', ['campus' => 'MC']) }}">
                                        <div class="small-box bg-info d-flex align-items-center justify-content-between pl-3 pr-3 pb-3 pt-3 card-curve" style="background-color: #00bc8c !important">
                                            <div class="text-left">
                                                <div class="inner">
                                                    <h3>Main</h3>
                                                    <p>Campus</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="icon">
                                                    <i class="fa fa-map"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <a href="{{ route('facultyFilter', ['campus' => 'VC']) }}">
                                        <div class="small-box bg-info d-flex align-items-center justify-content-between pl-3 pr-3 pb-3 pt-3 card-curve" style="background-color: #00bc8c !important">
                                            <div class="text-left">
                                                <div class="inner">
                                                    <h3>Victorias</h3>
                                                    <p>Campus</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="icon">
                                                    <i class="fa fa-map"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <a href="{{ route('facultyFilter', ['campus' => 'SCC']) }}">
                                        <div class="small-box bg-info d-flex align-items-center justify-content-between pl-3 pr-3 pb-3 pt-3 card-curve" style="background-color: #00bc8c !important">
                                            <div class="text-left">
                                                <div class="inner">
                                                    <h3>San Carlos</h3>
                                                    <p>Campus</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="icon">
                                                    <i class="fa fa-map"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <a href="{{ route('facultyFilter', ['campus' => 'HC']) }}">
                                        <div class="small-box bg-info d-flex align-items-center justify-content-between pl-3 pr-3 pb-3 pt-3 card-curve" style="background-color: #00bc8c !important">
                                            <div class="text-left">
                                                <div class="inner">
                                                    <h3>Hinigaran</h3>
                                                    <p>Campus</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="icon">
                                                    <i class="fa fa-map"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <a href="{{ route('facultyFilter', ['campus' => 'MP']) }}">
                                        <div class="small-box bg-info d-flex align-items-center justify-content-between pl-3 pr-3 pb-3 pt-3 card-curve" style="background-color: #00bc8c !important">
                                            <div class="text-left">
                                                <div class="inner">
                                                    <h3>Moises Padilla</h3>
                                                    <p>Campus</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="icon">
                                                    <i class="fa fa-map"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <a href="{{ route('facultyFilter', ['campus' => 'IC']) }}">
                                        <div class="small-box bg-info d-flex align-items-center justify-content-between pl-3 pr-3 pb-3 pt-3 card-curve" style="background-color: #00bc8c !important">
                                            <div class="text-left">
                                                <div class="inner">
                                                    <h3>Ilog</h3>
                                                    <p>Campus</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="icon">
                                                    <i class="fa fa-map"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <a href="{{ route('facultyFilter', ['campus' => 'CA']) }}">
                                        <div class="small-box bg-info d-flex align-items-center justify-content-between pl-3 pr-3 pb-3 pt-3 card-curve" style="background-color: #00bc8c !important">
                                            <div class="text-left">
                                                <div class="inner">
                                                    <h3>Candoni</h3>
                                                    <p>Campus</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="icon">
                                                    <i class="fa fa-map"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <a href="{{ route('facultyFilter', ['campus' => 'CC']) }}">
                                        <div class="small-box bg-info d-flex align-items-center justify-content-between pl-3 pr-3 pb-3 pt-3 card-curve" style="background-color: #00bc8c !important">
                                            <div class="text-left">
                                                <div class="inner">
                                                    <h3>Cauayan</h3>
                                                    <p>Campus</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="icon">
                                                    <i class="fa fa-map"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <a href="{{ route('facultyFilter', ['campus' => 'SP']) }}">
                                        <div class="small-box bg-info d-flex align-items-center justify-content-between pl-3 pr-3 pb-3 pt-3 card-curve" style="background-color: #00bc8c !important">
                                            <div class="text-left">
                                                <div class="inner">
                                                    <h3>Sipalay</h3>
                                                    <p>Campus</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="icon">
                                                    <i class="fa fa-map"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-6">
                                    <a href="{{ route('facultyFilter', ['campus' => 'HinC']) }}">
                                        <div class="small-box bg-info d-flex align-items-center justify-content-between pl-3 pr-3 pb-3 pt-3 card-curve" style="background-color: #00bc8c !important">
                                            <div class="text-left">
                                                <div class="inner">
                                                    <h3>Hinobaan</h3>
                                                    <p>Campus</p>
                                                </div>
                                            </div>
                                            <div class="text-right">
                                                <div class="icon">
                                                    <i class="fa fa-map"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
