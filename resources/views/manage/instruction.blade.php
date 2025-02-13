@extends('layouts.masterlayouts')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Instruction</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item breadcrumbactive"><a href="{{ route('dash') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Instruction</li>
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
                            <form method="POST" action="{{ route('instructionCreate') }}" id="addInstruction">
                                @csrf

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label class="badge badge-secondary">Scale:</label>
                                            <input type="number" name="inst_scale" class="form-control form-control-sm" autofocus>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label class="badge badge-secondary">Descriptive Rating:</label>
                                            <input type="text" name="inst_descRating" class="form-control form-control-sm">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label class="badge badge-secondary">Qualitative Description:</label>
                                            <textarea class="form-control" rows="4" name="inst_qualDescription"></textarea>
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
                                <table id="instructionTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Scale</th>
                                            <th>Descriptive Rating</th>
                                            <th>Qualitative Description</th>
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

<div class="modal fade" id="editInstModal" tabindex="-1" role="dialog" aria-labelledby="editInstModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInstModalLabel">Edit Instruction Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editInstForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editInstId">
                    <div class="form-group">
                        <label for="editInstscale" class="badge badge-secondary">Scale:</label>
                        <input type="number" id="editInstscale" name="inst_scale" class="form-control form-control-sm" autofocus>
                    </div>
                    <div class="form-group">
                        <label for="editInstdescrating">Descriptive Rating:</label>
                        <input type="text" id="editInstdescrating" name="inst_descRating" class="form-control form-control-sm">
                    </div>
                    <div class="form-group">
                        <label for="editInstqualdesc">Descriptive Rating:</label>
                        <textarea class="form-control" rows="4" id="editInstqualdesc" name="inst_qualDescription"></textarea>
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
    var instructionReadRoute = "{{ route('getInstructionRead') }}";
    var instructionCreateRoute = "{{ route('instructionCreate') }}";
    var instructionUpdateRoute = "{{ route('instructionUpdate', ['id' => ':id']) }}";
    var instructionDeleteRoute = "{{ route('instructionDelete', ['id' => ':id']) }}";
</script>
        
@endsection