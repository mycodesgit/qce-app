toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-bottom-left"
};
$(document).ready(function() {
    $('#addUser').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: userCreateRoute,
            type: "POST",
            data: formData,
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    console.log(response);
                    $(document).trigger('userAdded');
                    $('#modal-user').modal('hide');
                } else {
                    toastr.error(response.message);
                    console.log(response);
                }
            },
            error: function(xhr, status, error, message) {
                var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
                toastr.error(errorMessage);
            }
        });
    });

    var dataTable = $('#userlistTable').DataTable({
        "ajax": {
            "url": userReadRoute,
            "type": "GET",
        },
        destroy: true,
        info: true,
        responsive: true,
        lengthChange: true,
        searching: true,
        paging: true,
        "columns": [
            {
                data: null,
                render: function(data, type, row) {
                    var firstname = data.fname;
                    var middleInitial = data.mname ? data.mname.substr(0, 1) + '.' : '';
                    var lastNameWithExt = data.lname;

                    // Check if ext exists and is not 'N/A' or null
                    if (data.ext && data.ext !== 'N/A' && data.ext !== null) {
                        lastNameWithExt += ' ' + data.ext;
                    }

                    return firstname + ' ' + middleInitial + ' ' + lastNameWithExt;
                }
            },
            {
                data: 'role',
                render: function(data, type, row) {
                    if (data == 0) {
                        return '<span class="badge badge-warning">Administrator</span>';
                    } else if (data == 1) {
                        return '<span class="badge badge-info" style="color: #2b2b2b">Administer QA</span>';
                    } else if (data == 2) {
                        return '<span class="badge badge-secondary" style="color: #eee">Administer QA Staff</span>';
                    } else if (data == 3) {
                        return 'Administer Result';
                    } else if (data == 4) {
                        return 'Administer Result Staff';
                    } else {
                        return data;
                    }
                }
            },
            {data: 'email'},
            {
                data: 'campus',
                render: function(data, type, row) {
                    if (data == 'MC') {
                        return 'Main';
                    } else if (data == 'VC') {
                        return 'Victorias';
                    } else if (data == 'SCC') {
                        return 'San Carlos';
                    } else {
                        return data;
                    }
                }
            },
            {data: 'resetcount'},
            {
                data: 'id',
                render: function(data, type, row) {
                    if (type === 'display') {
                        var dropdown = '<div class="d-inline-block">' +
                            '<a class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                            '<div class="dropdown-menu">' +
                            '<a href="#" class="dropdown-item btn-semesteredit" data-id="' + row.id + '" data-schlyear="' + row.qceschlyear + '" data-semester="' + row.qcesemester + '" data-qceratingfrom="' + row.qceratingfrom + '" data-qceratingto="' + row.qceratingto + '" data-qcesemstat="' + row.qcesemstat + '">' +
                            '<i class="fas fa-pen"></i> Edit' +
                            '</a>' +
                            '<button type="button" value="' + data + '" class="dropdown-item semester-delete">' +
                            '<i class="fas fa-trash"></i> Delete' +
                            '</button>' +
                            '</div>' +
                            '</div>';
                        return dropdown;
                    } else {
                        return data;
                    }
                },
            },
        ],
        "createdRow": function (row, data, index) {
            $(row).attr('id', 'tr-' + data.id); 
        }
    });
    $(document).on('userAdded', function() {
        dataTable.ajax.reload();
    });
});

$(document).on('click', '.btn-semesteredit', function() {
    var id = $(this).data('id');
    var schlyear = $(this).data('schlyear');
    var semester = $(this).data('semester');
    var ratingFrom = $(this).data('qceratingfrom');
    var ratingTo = $(this).data('qceratingto');
    var semstat = $(this).data('qcesemstat');

    $('#editSemesterId').val(id);
    $('#editSchlyearName').val(schlyear);
    $('#editSemesterName').val(semester);
    $('#editRatingfrom').val(ratingFrom);
    $('#editRatingto').val(ratingTo);
    $('#editSemstat').val(semstat);
    
    $('#editSemesterModal').modal('show');
});

$('#editSemesterForm').submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
        url: semesterUpdateRoute,
        type: "POST",
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.success) {
                toastr.success(response.message);
                $('#editSemesterModal').modal('hide');
                $(document).trigger('semesterAdded');
            } else {
                toastr.error(response.message);
            }
        },
        error: function(xhr, status, error, message) {
            var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
            toastr.error(errorMessage);
        }
    });
});

$(document).on('click', '.semester-delete', function(e) {
    var id = $(this).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to recover this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: semesterDeleteRoute.replace(':id', id),
                success: function(response) {
                    $("#tr-" + id).delay(1000).fadeOut();
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Successfully Deleted!',
                        icon: 'warning',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    if(response.success) {
                        toastr.success(response.message);
                        console.log(response);
                    }
                }
            });
        }
    })
});
