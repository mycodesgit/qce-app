@extends('layouts.masterlayouts')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Submissions Print</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item breadcrumbactive"><a href="{{ route('dash') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Submissions Print</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="" style="background-color: #d9dcdf; border-radius: 5px;">
                        <div class="">
                            <form method="GET" action="{{ route('subprint_searchresultStore') }}" id="enrollStud">
                                @csrf

                                <div class="form-group" style="padding: 10px">
                                    <div class="form-row">
                                        <div class="col-md-2">
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
                                            <label><span class="badge badge-secondary">School Year</span></label>
                                            <select class="form-control form-control-sm" name="schlyear" id="schlyear">
                                                @foreach($currsem as $datacurrsem)
                                                    <option value="{{ $datacurrsem->qceschlyear }}">{{ $datacurrsem->qceschlyear }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label><span class="badge badge-secondary">Semester</span></label>
                                            <select class="form-control form-control-sm" name="semester" id="semester">
                                                <option disabled selected>Select</option>
                                                <option value="1" @if (old('type') == 1) {{ 'selected' }} @endif>First Semester</option>
                                                <option value="2" @if (old('type') == 2) {{ 'selected' }} @endif>Second Semester</option>
                                                <option value="3" @if (old('type') == 3) {{ 'selected' }} @endif>Summer</option>
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label><span class="badge badge-secondary">Course</span></label>
                                            <select class="form-control form-control-sm select2bs4" name="progCod" id="progCod">
                                                <option disabled selected>Select a course</option>
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
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fas fa-print"></i> To be print
                            </h5>
                        </div>
                        <div class="card-body">
                            <table id="submitevalTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Faculty</th>
                                        <th>Campus</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card card-success">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fas fa-print"></i> Done print
                            </h5>
                        </div>
                        <div class="card-body">
                            <table id="doneprintTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Faculty</th>
                                        <th>Campus</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewEvalRatePDFModal" role="dialog" aria-labelledby="viewEvalRatePDFModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewEvalRatePDFModalLabel">Print PDF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="pdfIframe" src="" style="width: 100%; height: 500px;" frameborder="0" class="mt-3"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <form id="editInstForm">
                    <input type="text" name="id" id="viewEvalRatePDFId" hidden>
                    <button type="submit" class="btn btn-primary" id="btnDonePrint">Done Print</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var submissionReadRoute = "{{ route('getevalsubratelistRead') }}";
    var doneprintReadRoute = "{{ route('getevalsubrateprintedlistRead') }}";
    var studentevalsubPDFReadRoute = "{{ route('exportPrintEvalPDF') }}";
    var studentevalsubPDFprintUpdateReadRoute = "{{ route('updateStatprint') }}";
    var classenrollyrsecReadRoute = "{{ route('getCoursesyearsec') }}";
</script>
        
@endsection