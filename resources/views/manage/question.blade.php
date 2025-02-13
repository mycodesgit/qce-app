@extends('layouts.masterlayouts')

@section('body')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Questions</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item breadcrumbactive"><a href="{{ route('dash') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Questions</li>
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
                            <form method="POST" action="{{ route('questionCreate') }}" id="addQuestion">
                                @csrf

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label class="badge badge-secondary">Belongs to Category:</label>
                                            <select class="form-control form-control-sm" name="catName_id">
                                                <option disabled selected> --Select-- </option>
                                                @foreach($qcecat as $dataqcecat)
                                                    <option value="{{ $dataqcecat->id }}">{{ $dataqcecat->catName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label class="badge badge-secondary">Question:</label>
                                            <textarea class="form-control" rows="4" name="questiontext"></textarea>
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
                                <table id="questTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Question</th>
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

<div class="modal fade" id="editQuestModal" tabindex="-1" role="dialog" aria-labelledby="editQuestModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editQuestModalLabel">Edit Category Name</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editQuestForm">
                <div class="modal-body">
                    <input type="hidden" name="id" id="editQuestId">
                    <div class="form-group">
                        <label for="editQuestcatName" class="badge badge-secondary">Belongs to Category:</label>
                        <select class="form-control form-control-sm" id="editQuestcatName" name="catName_id">
                            @foreach($qcecat as $dataqcecat)
                                <option value="{{ $dataqcecat->id }}">{{ $dataqcecat->catName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editQuestName">Question</label>
                        <textarea class="form-control" rows="4" id="editQuestName" name="questiontext"></textarea>
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
    var questionReadRoute = "{{ route('getQuestionRead') }}";
    var questionCreateRoute = "{{ route('questionCreate') }}";
    var questionUpdateRoute = "{{ route('questionUpdate', ['id' => ':id']) }}";
    var questionDeleteRoute = "{{ route('questionDelete', ['id' => ':id']) }}";
</script>
        
@endsection