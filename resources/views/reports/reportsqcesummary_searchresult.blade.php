@extends('layouts.masterlayouts')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Summary of Evaluation</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item breadcrumbactive"><a href="{{ route('dash') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Summary of Evaluation</li>
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
                            <form method="GET" action="{{ route('summaryEvalFilter') }}" id="enrollStud">
                                @csrf

                                <div class="form-group" style="padding: 10px">
                                    <div class="form-row">
                                        <div class="col-md-2">
                                            <label><span class="badge badge-secondary">Campus</span></label>
                                            <select class="form-control form-control-md" name="campus" id="campus">
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
                                            <label><span class="badge badge-secondary">School Year</span></label>
                                            <select class="form-control form-control-md" name="schlyear" id="schlyear">
                                                @foreach($currsem as $datacurrsem)
                                                    <option value="{{ $datacurrsem->qceschlyear }}">{{ $datacurrsem->qceschlyear }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label><span class="badge badge-secondary">Semester</span></label>
                                            <select class="form-control form-control-md" name="semester" id="semester">
                                                <option disabled selected>Select</option>
                                                <option value="1" @if (old('type') == 1) {{ 'selected' }} @endif>First Semester</option>
                                                <option value="2" @if (old('type') == 2) {{ 'selected' }} @endif>Second Semester</option>
                                                <option value="3" @if (old('type') == 3) {{ 'selected' }} @endif>Summer</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label><span class="badge badge-secondary">Faculty</span></label>
                                            <select class="form-control form-control-md select2bs4" name="faclty" id="faclty">
                                                <option disabled selected>Select a Faculty</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="form-control form-control-sm btn btn-success btn-sm">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                                    <li class="nav-item ml-1">
                                        <a class="nav-link active text-dark text-bold" 
                                            id="custom-tabs-one-tab" 
                                            data-toggle="pill" 
                                            href="#custom-tabs-one" 
                                            role="tab" 
                                            aria-controls="custom-tabs-one" 
                                            aria-selected="true">
                                                Summary of Evaluation
                                        </a>
                                    </li>
                                    <li class="nav-item ml-1">
                                        <a class="nav-link text-dark text-bold" 
                                            id="custom-tabs-two-tab" 
                                            data-toggle="pill" 
                                            href="#custom-tabs-two" 
                                            role="tab" 
                                            aria-controls="custom-tabs-two" 
                                            aria-selected="false">
                                                Monitoring and Evaluation
                                        </a>
                                    </li>
                                    <li class="nav-item ml-1">
                                        <a class="nav-link text-dark text-bold" 
                                            id="custom-tabs-three-tab" 
                                            data-toggle="pill" 
                                            href="#custom-tabs-three" 
                                            role="tab" 
                                            aria-controls="custom-tabs-three" 
                                            aria-selected="false">
                                                Rating Points
                                        </a>
                                    </li>
                                    <li class="nav-item ml-1">
                                        <a class="nav-link text-dark text-bold" 
                                            id="custom-tabs-four-tab" 
                                            data-toggle="pill" 
                                            href="#custom-tabs-four" 
                                            role="tab" 
                                            aria-controls="custom-tabs-four" 
                                            aria-selected="false">
                                                Summary Sheets
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-one" role="tabpanel" aria-labelledby="custom-tabs-one-tab">
                                    <iframe id="pdfIframe" src="{{ route('gensummaryevalPDF', ['campus' => request('campus'), 'schlyear' => request('schlyear'), 'semester' => request('semester'), 'faclty' => request('faclty')]) }}"
                                            style="width: 100%; height: 500px;" 
                                            frameborder="0" 
                                            class="mt-3">
                                    </iframe>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-two" role="tabpanel" aria-labelledby="custom-tabs-two-tab">
                                    <iframe id="pdfIframe" src="{{ route('gencommentsevalPDF', ['campus' => request('campus'), 'schlyear' => request('schlyear'), 'semester' => request('semester'), 'faclty' => request('faclty')]) }}"
                                        style="width: 100%; height: 500px;" 
                                        frameborder="0" 
                                        class="mt-3">
                                    </iframe>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-three" role="tabpanel" aria-labelledby="custom-tabs-three-tab">
                                    <iframe id="pdfIframe" src="{{ route('genpointsevalPDF', ['campus' => request('campus'), 'schlyear' => request('schlyear'), 'semester' => request('semester'), 'faclty' => request('faclty')]) }}"
                                        style="width: 100%; height: 500px;" 
                                        frameborder="0" 
                                        class="mt-3">
                                    </iframe>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four" role="tabpanel" aria-labelledby="custom-tabs-four-tab">
                                    <iframe id="pdfIframe" src="{{ route('gensumsheetevalPDF', ['campus' => request('campus'), 'schlyear' => request('schlyear'), 'semester' => request('semester'), 'faclty' => request('faclty')]) }}"
                                        style="width: 100%; height: 500px;" 
                                        frameborder="0" 
                                        class="mt-3">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var getfacltyReadRoute = "{{ route('getFacultycamp') }}";
</script>

@endsection
