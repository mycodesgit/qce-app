toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right"
};
$(document).ready(function() {
    var dataTable = $('#facltyTable').DataTable({
        "ajax": {
            "url": facultyReadRoute,
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
                data: null, // This column doesn't map to a single field in your data source
                render: function(data, type, row) {
                    return `${row.lname}, ${row.fname} ${row.mname}`;
                }
            },
            {data: 'adrDesc'},
            {data: 'college_abbr'},
            {data: 'fcamp'},
            {
                data: 'fctyid',
                render: function(data, type, row) {
                    if (type === 'display') {
                        var dropdown = '<div class="d-inline-block">' +
                            '<a class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                            '<div class="dropdown-menu">' +
                            '<a href="#" class="dropdown-item btn-viewpdf" data-id="' + row.fctyid + '" data-flname="' + row.lname + '" data-ffname="' + row.fname + '" data-fmname="' + row.mname + '" data-fxname="' + row.ext + '" data-adrname="' + row.adrID + '" data-deptname="' + row.dept + '" data-email="' + row.email + '">' +
                            '<i class="fas fa-file-pdf"></i> View in PDF' +
                            '</a>' +
                            '<a href="#" class="dropdown-item btn-viewexcel" data-id="' + row.fctyid + '" data-flname="' + row.lname + '" data-ffname="' + row.fname + '" data-fmname="' + row.mname + '" data-fxname="' + row.ext + '" data-adrname="' + row.adrID + '" data-deptname="' + row.dept + '" data-email="' + row.email + '">' +
                            '<i class="fas fa-file-excel"></i> Export in Excel' +
                            '</a>' +
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
            $(row).attr('id', 'tr-' + data.fctyid); 
        }
    });
    $(document).on('facAdded', function() {
        dataTable.ajax.reload();
    });
});

