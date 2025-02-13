@extends('layouts.masterlayouts')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item breadcrumbactive"><a href="{{ route('dash') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Category</li>
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
                            <form method="POST" action="{{ route('categoryCreate') }}" id="addCategory">
                                @csrf

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label class="badge badge-secondary">Category Name:</label>
                                            <input type="text" name="catName" class="form-control form-control-sm">
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
                                <table id="categoryTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
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

<div class="modal fade" id="editCatModal" tabindex="-1" role="dialog" aria-labelledby="editCatModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCatModalLabel">Edit Category Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editCatForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editCatId">
                    <div class="form-group">
                        <label for="editCatName">Category Name</label>
                        <input type="text" class="form-control" id="editCatName" name="catName">
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
    var categoryReadRoute = "{{ route('getcategoryRead') }}";
    var categoryCreateRoute = "{{ route('categoryCreate') }}";
    var categoryUpdateRoute = "{{ route('categoryUpdate', ['id' => ':id']) }}";
    var categoryDeleteRoute = "{{ route('categoryDelete', ['id' => ':id']) }}";
</script>
        
@endsection