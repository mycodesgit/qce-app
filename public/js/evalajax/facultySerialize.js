toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-bottom-left"
};
$(document).ready(function() {
    var urlParams = new URLSearchParams(window.location.search);
    var campus = urlParams.get('campus') || ''; 

    var dataTable = $('#facltyTable').DataTable({
        "ajax": {
            "url": facultyReadRoute,
            "type": "GET",
            "data": { 
                "campus": campus,
            }
        },
        destroy: true,
        info: true,
        responsive: true,
        lengthChange: true,
        searching: true,
        paging: true,
        "columns": [
            {
                data: null, // This column doesn't map to a single field in your data source
                render: function(data, type, row) {
                    return `${row.lname}, ${row.fname} ${row.mname}`;
                }
            },
            {data: 'adrDesc'},
            {data: 'college_abbr'},
            {data: 'fcamp'},
            {
                data: 'profimage',
                render: function(data, type, row) {
                    // Define the default image URL outside the condition
                    let imageUrldef = `${photoStoragedef}`;
            
                    if (data) {
                        // Construct the image URL correctly
                        let imageUrl = `${photoStorage}/${data}`;
                        return `
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <img alt="Avatar" class="table-avatar" src="${imageUrl}" width="50" height="50">
                                </li>
                            </ul>`;
                    } else {
                        // Use the default image URL when no profile image exists
                        return `
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <img alt="Avatar" class="table-avatar" src="${imageUrldef}" width="50" height="50">
                                </li>
                            </ul>`;
                    }
                }
            },                       
            {
                data: 'fcamp',
                render: function(data, type, row) {
                    if (type === 'display') {
                        return `
                            <button class="btn btn-primary btn-sm btn-facultyedit"
                                data-id="${row.fctyid}"  
                                data-flname="${row.lname}" 
                                data-ffname="${row.fname}" 
                                data-fmname="${row.mname}" 
                                data-fxname="${row.ext}" 
                                data-adrname="${row.adrID}" 
                                data-deptname="${row.dept}" 
                                data-email="${row.email}" 
                                title="View Photo">
                                <i class="fas fa-eye"></i>
                            </button>`;
                    } else {
                        return data;
                    }
                }
            }
        ],
        "createdRow": function (row, data, index) {
            $(row).attr('id', 'tr-' + data.fctyid); 
        }
    });
    $(document).on('facAdded', function() {
        dataTable.ajax.reload();
    });
});

$(document).on('click', '.btn-facultyedit', function() {
    var id = $(this).data('id');
    var lName = $(this).data('flname');
    var fName = $(this).data('ffname');
    var mName = $(this).data('fmname');
    var exName = $(this).data('fxname');
    var salName = $(this).data('adrname');
    var deptName = $(this).data('deptname');
    var email = $(this).data('email');

    $('#editFacultyId').val(id);
    $('#editLastname').val(lName);
    $('#editFirstname').val(fName);
    $('#editMiddlename').val(mName);
    $('#editExtname').val(exName);
    $('#editSalutation').val(salName);
    $('#college_room').val(deptName);
    $('#editEmail').val(email);

    $('#editFacultyModal').modal('show');
});

$('#editFacultyForm').submit(function(event) {
    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: facultyUploadRoute,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.success) {
                toastr.success(response.message);
                $('#editFacultyModal').modal('hide');
            } else {
                toastr.error(response.message);
            }
        },
        error: function(xhr) {
            var errorMessage = xhr.responseText ? JSON.parse(xhr.responseText).message : 'An error occurred';
            toastr.error(errorMessage);
        }
    });
});


