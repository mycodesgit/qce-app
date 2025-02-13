@extends('layouts.masterlayouts')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item breadcrumbactive"><a href="{{ route('dash') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-user">
                                    <i class="fas fa-user-plus"></i> Add New
                                </button>
                                @include('modal.useradd-modal')
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <table id="userlistTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th>Campus</th>
                                            <th>No. of Reset</th>
                                            <th width="10%">Actions</th>
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

<div class="modal fade" id="editSemesterModal" tabindex="-1" role="dialog" aria-labelledby="editSemesterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSemesterModalLabel">Edit Semester</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editSemesterForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editSemesterId">
                    <div class="form-group">
                        <label for="editSchlyearName">School Year</label>
                        <input type="text" class="form-control" id="editSchlyearName" name="qceschlyear">
                    </div>
                    <div class="form-group">
                        <label for="editSemesterName">Semester:</label>
                        <select class="form-control form-control-sm" name="qcesemester" id="editSemesterName">
                            <option disabled selected> --Select-- </option>
                            <option value="1">1st Semester</option>
                            <option value="2">2nd Semester</option>
                            <option value="3">Summer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editRatingfrom">Rating Period from:</label>
                        <input type="text" id="editRatingfrom" name="qceratingfrom" class="form-control form-control-sm" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');">
                    </div>
                    <div class="form-group">
                        <label for="editRatingto">Rating Period to:</label>
                        <input type="text" id="editRatingto" name="qceratingto" class="form-control form-control-sm" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');">
                    </div>
                    <div class="form-group">
                        <label for="editSemstat">Status:</label>
                        <select class="form-control form-control-sm" id="editSemstat" name="qcesemstat">
                            <option disabled selected> --Select-- </option>
                            <option value="1">Deactivate</option>
                            <option value="2">Activate</option>
                            <option value="3">Upcoming</option>
                            <option value="4">Current</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="edituserModal" tabindex="-1" role="dialog" aria-labelledby="edituserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edituserModalLabel">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="edituserForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="edituserId">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edituserfname"><span class="badge badge-secondary">First Name:</span></label>
                                <input type="text" class="form-control form-control-sm" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" placeholder="Enter First Name" id="edituserfname" name="fname">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="editusermname"><span class="badge badge-secondary">Middle Name:</span></label>
                                <input type="text" class="form-control form-control-sm" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" placeholder="Enter Middle Name" id="editusermname" name="mname">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edituserlname"><span class="badge badge-secondary">Last Name:</span></label>
                                <input type="text" class="form-control form-control-sm" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" placeholder="Enter Last Name" id="edituserlname" name="lname">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edituserext"><span class="badge badge-secondary">Ext.:</span></label>
                                <select class="form-control form-control-sm" name="ext" id="edituserext">
                                    <option value="">N/A</option>
                                    <option value="Jr." @if (old('ext') == "Jr.") {{ 'selected' }} @endif>Jr.</option>
                                    <option value="Sr." @if (old('ext') == "Sr.") {{ 'selected' }} @endif>Sr.</option>
                                    <option value="III" @if (old('ext') == "III") {{ 'selected' }} @endif>III</option>
                                    <option value="IV" @if (old('ext') == "IV") {{ 'selected' }} @endif>IV</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="form-group">
                                <label for="edituseremail"><span class="badge badge-secondary">Email:</span></label>
                                <input type="email" class="form-control form-control-sm" id="edituseremail" name="email">
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="editusercamp"><span class="badge badge-secondary">Campus:</span></label>
                                <select class="form-control form-control-sm" name="campus" id="editusercamp" required="">
                                    <option disabled selected>Select</option>
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
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edituserdept"><span class="badge badge-secondary">Department:</span></label>
                                <select class="form-control form-control-sm" name="dept" id="edituserdept">
                                    <option disabled selected>Select</option>
                                    <option value="CAS">College of Arts and Sciences</option>
                                    <option value="CCS">College of Computer Studies</option>
                                    <option value="COTED">College of Teacher Education</option>
                                    <option value="CCJE">College of Criminal Justice Education</option>
                                    <option value="COE">College of Engineering</option>
                                    <option value="CAF">College of Agriculture and Forestry</option>
                                    <option value="CBM">College of Business Management</option>
                                    <option value="Guidance Office">Guidance Office</option>
                                    <option value="Registrar Office">Registrar Office</option>
                                    <option value="Assessment Office">Assessment Office</option>
                                    <option value="Scholarship Office">Scholarship Office</option>
                                    <option value="Cashier Office">Cashier Office</option>
                                    <option value="Graduate School Registar">Graduate School Registar</option>
                                    <option value="MIS Office">MIS Office</option>
                                    <option value="OSSA">OSSA</option>
                                    <option value="QA">QA</option>
                                    <option value="TS">Training Services</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="edituserrole"><span class="badge badge-secondary">User Role:</span></label>
                                <select class="form-control form-control-sm" name="role" id="edituserrole">
                                    <option disabled selected>Level</option>
                                    <option value="0">Administrator</option>
                                    <option value="1">Administer QA</option>
                                    <option value="2">Administer QA Staff</option>
                                    <option value="3">Administer Result</option>
                                    <option value="4">Administer Result Staff</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var userReadRoute = "{{ route('getUserRead') }}";
    var userCreateRoute = "{{ route('userCreate') }}";
    var userUpdateRoute = "{{ route('userUpdate', ['id' => ':id']) }}";
    var userDeleteRoute = "{{ route('userDelete', ['id' => ':id']) }}";
</script>
        
@endsection