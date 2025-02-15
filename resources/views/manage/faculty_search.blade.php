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
                    <div class="" style="background-color: #d9dcdf; border-radius: 5px;">
                        <div class="">
                            <form method="GET" action="{{ route('facultyFilter') }}" id="enrollStud">
                                @csrf

                                <div class="form-group" style="padding: 10px">
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
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                <i class="fas fa-list"></i> List
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="">
                                <table id="facltyTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Salutation</th>
                                            <th>College</th>
                                            <th>Campus</th>
                                            <th>Image</th>
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

<div class="modal fade" id="editFacultyModal" role="dialog" aria-labelledby="editFacultyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editFundModalLabel">Upload Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editFacultyForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="text" name="facidprof" id="editFacultyId">

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-3">
                                <label for="editLastname">Lastname</label>
                                <input type="text" class="form-control form-control-sm" id="editLastname" name="lname" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="editFirstname">Firstname</label>
                                <input type="text" class="form-control form-control-sm" id="editFirstname" name="fname" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="editMiddlename">Middlename</label>
                                <input type="text" class="form-control form-control-sm" id="editMiddlename" name="mname" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" readonly>
                            </div>
                            <div class="col-md-3">
                                <label for="editExtname">Ext</label>
                                <input type="number" class="form-control form-control-sm" id="editExtname" name="ext" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="editImage" class="font-weight-bold">Upload Image</label>
                                    <div id="dropZone" class="file-drop-zone" 
                                        style="border: 2px dashed #47b656; border-radius: 10px; padding: 40px; text-align: center; cursor: pointer; position: relative;">
                                        <input type="file" class="custom-file-input" id="editImage" name="profimage" accept=".png, .jpg" 
                                            onchange="previewImage(event)" style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;">
                                        <div class="file-upload-content">
                                            <div class="upload-icon" style="font-size: 3em; color: #47b656;">
                                                <i class="fas fa-cloud-upload-alt"></i>
                                            </div>
                                            <p class="upload-text" style="margin: 10px 0; color: #47b656;">Browse Files to upload</p>
                                        </div>
                                    </div>
                                    <div class="file-info mt-2" style="text-align: center; color: #555;">
                                        <i class="fas fa-file"></i> <span id="fileNameDisplay">No selected file -</span>
                                        <button type="button" class="btn btn-sm btn-outline-danger btn-sm ml-2" onclick="clearFile()">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="imagePreview" class="font-weight-bold">Image Preview</label>
                                    <div class="image-preview-container" style="position: relative; width: 100%; height: 200px; border: 1px solid #ddd; border-radius: 5px; overflow: hidden;">
                                        <img id="imagePreview" src="#" alt="Image Preview" style="display: none; width: 100%; height: 100%; object-fit: cover;"/>
                                        <div class="image-preview-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); color: #fff; display: flex; align-items: center; justify-content: center; font-size: 1.2em;">
                                            No Image
                                        </div>
                                    </div>
                                </div>
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
    var facultyReadRoute = "{{ route('getfacultylistRead') }}";
    var facultyUploadRoute = "{{ route('facultyUploadImage') }}";
    var photoStorage = "{{ asset('storage/') }}";
    var photoStoragedef = "{{ asset('template/img/user.png') }}";
</script>

<script>
    // Preview image when file is selected
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('imagePreview');
            const overlay = document.querySelector('.image-preview-overlay');
            output.src = reader.result;
            output.style.display = 'block';
            overlay.style.display = 'none';

            const fileName = event.target.files[0].name;
            document.getElementById('fileNameDisplay').innerText = fileName;
        };
        if (event.target.files.length > 0) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }

    // Clear the selected file
    function clearFile() {
        document.getElementById('editImage').value = '';
        document.getElementById('imagePreview').style.display = 'none';
        document.querySelector('.image-preview-overlay').style.display = 'flex';
        document.getElementById('fileNameDisplay').innerText = 'No selected file -';
    }

    // Drag and Drop functionality
    const dropZone = document.getElementById('dropZone');
    dropZone.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropZone.style.backgroundColor = '#f0f8ff';
    });

    dropZone.addEventListener('dragleave', (event) => {
        event.preventDefault();
        dropZone.style.backgroundColor = 'white';
    });

    dropZone.addEventListener('drop', (event) => {
        event.preventDefault();
        dropZone.style.backgroundColor = 'white';
        const files = event.dataTransfer.files;
        if (files.length > 0) {
            document.getElementById('editImage').files = files;
            previewImage({ target: document.getElementById('editImage') });
        }
    });
</script>



@endsection
