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
                        <li class="breadcrumb-item"><a href="{{ route('dash') }}">Dashboard</a></li>
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
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fas fa-search"></i> Search
                            </h5>
                        </div>
                        <div class="card-body">
                            <form method="GET" action="" id="enrollStud">
                                @csrf   

                                <div class="form-group" style="padding: 10px">
                                    <div class="form-row">
                                        <div class="col-md-3">
                                            <label><span class="badge badge-secondary">School Year</span></label>
                                            <select class="form-control form-control-sm" name="schlyear">
                                                @foreach($currsem as $datacurrsem)
                                                    <option value="{{ $datacurrsem->qceschlyear }}">{{ $datacurrsem->qceschlyear }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-3">
                                            <label><span class="badge badge-secondary">Semester</span></label>
                                            <select class="form-control form-control-sm" name="semester">
                                                <option disabled selected>Select</option>
                                                <option value="1" @if (old('type') == 1) {{ 'selected' }} @endif>First Semester</option>
                                                <option value="2" @if (old('type') == 2) {{ 'selected' }} @endif>Second Semester</option>
                                                <option value="3" @if (old('type') == 3) {{ 'selected' }} @endif>Summer</option>
                                            </select>
                                        </div>

                                        <div class="col-md-2">
                                            <label><span class="badge badge-secondary">Campus</span></label>
                                            <select class="form-control form-control-sm" name="campus">
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

                                        <div class="col-md-3">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="form-control form-control-sm btn btn-success btn-sm">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div>
                                <div class="page-header" style="border-bottom: 1px solid #04401f;">
                                </div> 
                            </div>

                            <div style="padding: 25px">
                                <table id="facltyTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Salutation</th>
                                            <th>College</th>
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
</div>

<script>
    var facultyReadRoute = "{{ route('getfacultylistRead') }}";
</script>
        
@endsection