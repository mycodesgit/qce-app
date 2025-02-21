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
                            <div class="dropdown">
                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenu${row.fctyid}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-camera"></i> Photo
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu${row.fctyid}">
                                    <a class="dropdown-item btn-upload-photo" 
                                        href="#" 
                                        data-id="${row.fctyid}" 
                                        data-flname="${row.lname}" 
                                        data-ffname="${row.fname}" 
                                        data-fmname="${row.mname}" 
                                        data-fxname="${row.ext}" 
                                        data-adrname="${row.adrID}" 
                                        data-deptname="${row.dept}" 
                                        data-email="${row.email}">
                                        <i class="fas fa-upload"></i> Upload Photo
                                    </a>
                                    <a class="dropdown-item btn-view-photo" 
                                        href="#" 
                                        data-id="${row.fctyid}" 
                                        data-flname="${row.lname}" 
                                        data-ffname="${row.fname}" 
                                        data-fmname="${row.mname}" 
                                        data-photo="${row.profimage}">
                                        <i class="fas fa-eye"></i> View Photo
                                    </a>
                                    <a class="dropdown-item btn-update-photo" 
                                        href="#" 
                                        data-id="${row.fctyid}" 
                                        data-flname="${row.lname}" 
                                        data-ffname="${row.fname}" 
                                        data-fmname="${row.mname}" 
                                        data-fxname="${row.ext}" 
                                        data-adrname="${row.adrID}" 
                                        data-deptname="${row.dept}" 
                                        data-email="${row.email}">
                                        <i class="fas fa-edit"></i> Update Photo
                                    </a>
                                </div>
                            </div>`;
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