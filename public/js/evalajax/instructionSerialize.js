toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-bottom-left"
};
$(document).ready(function() {
    $('#addInstruction').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            url: instructionCreateRoute,
            type: "POST",
            data: formData,
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                    console.log(response);
                    $(document).trigger('instructionAdded');
                    $('input[name="inst_scale"]').val('');
                    $('input[name="inst_descRating"]').val('');
                    $('textarea[name="inst_qualDescription"]').val('');
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

    var dataTable = $('#instructionTable').DataTable({
        "ajax": {
            "url": instructionReadRoute,
            "type": "GET",
        },
        destroy: true,
        info: true,
        responsive: true,
        lengthChange: true,
        searching: true,
        paging: true,
        order: [[0, 'desc']],
        "columns": [
            {data: 'inst_scale'},
            {data: 'inst_descRating'},
            {data: 'inst_qualDescription'},
            {
                data: 'id',
                render: function(data, type, row) {
                    if (type === 'display') {
                        var dropdown = '<div class="d-inline-block">' +
                            '<a class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                            '<div class="dropdown-menu">' +
                            '<a href="#" class="dropdown-item btn-instedit" data-id="' + row.id + '" data-scale="' + row.inst_scale + '" data-descrating="' + row.inst_descRating + '" data-qualdesc="' + row.inst_qualDescription + '">' +
                            '<i class="fas fa-pen"></i> Edit' +
                            '</a>' +
                            '<button type="button" value="' + data + '" class="dropdown-item inst-delete">' +
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
    $(document).on('instructionAdded', function() {
        dataTable.ajax.reload();
    });
});

$(document).on('click', '.btn-instedit', function() {
    var id = $(this).data('id');
    var scaleName = $(this).data('scale');
    var descratingName = $(this).data('descrating');
    var qualdescName = $(this).data('qualdesc');
    
    $('#editInstId').val(id);
    $('#editInstscale').val(scaleName);
    $('#editInstdescrating').val(descratingName);
    $('#editInstqualdesc').val(qualdescName);
    $('#editInstModal').modal('show');
});

$('#editInstForm').submit(function(event) {
    event.preventDefault();
    var formData = $(this).serialize();

    $.ajax({
        url: instructionUpdateRoute,
        type: "POST",
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.success) {
                toastr.success(response.message);
                $('#editInstModal').modal('hide');
                $(document).trigger('instructionAdded');
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

$(document).on('click', '.inst-delete', function(e) {
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
                url: instructionDeleteRoute.replace(':id', id),
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
