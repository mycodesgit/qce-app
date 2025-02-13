@extends('layouts.masterlayouts')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Semester</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item breadcrumbactive"><a href="{{ route('dash') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Semester</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fas fa-plus"></i> Add New
                            </h5>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('semesterCreate') }}" id="addSemester">
                                @csrf

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label class="badge badge-secondary">School Year:</label>
                                            <input type="text" name="qceschlyear" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label class="badge badge-secondary">Semester:</label>
                                            <select class="form-control form-control-sm" name="qcesemester">
                                                <option disabled selected> --Select-- </option>
                                                <option value="1">1st Semester</option>
                                                <option value="2">2nd Semester</option>
                                                <option value="3">Summer</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <label class="badge badge-secondary">Rating Period from:</label>
                                            <input type="text" name="qceratingfrom" class="form-control form-control-sm" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="badge badge-secondary">Rating Period to:</label>
                                            <input type="text" name="qceratingto" class="form-control form-control-sm" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-save"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>   
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-9">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fas fa-list"></i> List
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <table id="schlyearsemesterTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>School Year</th>
                                            <th>Semester</th>
                                            <th>Rating Period</th>
                                            <th>Status</th>
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
    var semesterReadRoute = "{{ route('getSemesterRead') }}";
    var semesterCreateRoute = "{{ route('semesterCreate') }}";
    var semesterUpdateRoute = "{{ route('semesterUpdate', ['id' => ':id']) }}";
    var semesterDeleteRoute = "{{ route('semesterDelete', ['id' => ':id']) }}";
</script>
        
@endsection