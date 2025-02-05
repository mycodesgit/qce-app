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
                        <li class="breadcrumb-item"><a href="{{ route('dash') }}">Dashboard</a></li>
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

<script>
    var userReadRoute = "{{ route('getUserRead') }}";
    var userCreateRoute = "{{ route('userCreate') }}";
    var semesterUpdateRoute = "{{ route('semesterUpdate', ['id' => ':id']) }}";
    var semesterDeleteRoute = "{{ route('semesterDelete', ['id' => ':id']) }}";
</script>
        
@endsection