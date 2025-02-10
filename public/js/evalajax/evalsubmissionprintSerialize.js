toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right"
};
$(document).ready(function() {

    var urlParams = new URLSearchParams(window.location.search);
    var schlyear = urlParams.get('schlyear') || ''; 
    var semester = urlParams.get('semester') || '';
    var campus = urlParams.get('campus') || ''; 
    var progCod = urlParams.get('progCod') || ''; 

    var dataTable = $('#submitevalTable').DataTable({
        "ajax": {
            "url": submissionReadRoute,
            "type": "GET",
            "data": { 
                "schlyear": schlyear,
                "semester": semester,
                "campus": campus,
                "progCod": progCod
            }
        },
        destroy: true,
        info: true,
        responsive: true,
        lengthChange: true,
        searching: true,
        paging: true,
        "columns": [
            {data: 'evaluatorname'},
            {data: 'qcefacname'},
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
            {
                data: 'id',
                render: function(data, type, row) {
                    if (type === 'display') {
                        var dropdown = '<div class="d-inline-block">' +
                            '<a class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                            '<div class="dropdown-menu">' +
                            '<a href="#" class="dropdown-item btn-viewpdf" data-id="' + row.id + '" data-flname="' + row.lname + '" data-ffname="' + row.fname + '" data-fmname="' + row.mname + '" data-fxname="' + row.ext + '" data-adrname="' + row.adrID + '" data-deptname="' + row.dept + '" data-email="' + row.email + '">' +
                            '<i class="fas fa-file-pdf"></i> View in PDF' +
                            '</a>' +
                            '<a href="#" class="dropdown-item btn-viewexcel" data-id="' + row.id + '" data-flname="' + row.lname + '" data-ffname="' + row.fname + '" data-fmname="' + row.mname + '" data-fxname="' + row.ext + '" data-adrname="' + row.adrID + '" data-deptname="' + row.dept + '" data-email="' + row.email + '">' +
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
    // setInterval(function () {
    //     dataTable.ajax.reload(null, false);
    // }, 3000);
});

$(document).ready(function() {

    var urlParams = new URLSearchParams(window.location.search);
    var schlyear = urlParams.get('schlyear') || ''; 
    var semester = urlParams.get('semester') || '';
    var campus = urlParams.get('campus') || ''; 
    //var progCod = urlParams.get('progCod') || '';

    var dataTable = $('#doneprintTable').DataTable({
        "ajax": {
            "url": doneprintReadRoute,
            "type": "GET",
            "data": { 
                "schlyear": schlyear,
                "semester": semester,
                "campus": campus,
                //"progCod": progCod
            }
        },
        destroy: true,
        info: true,
        responsive: true,
        lengthChange: true,
        searching: true,
        paging: true,
        "columns": [
            {data: 'evaluatorname'},
            {data: 'qcefacname'},
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
            {
                data: 'id',
                render: function(data, type, row) {
                    if (type === 'display') {
                        var dropdown = '<div class="d-inline-block">' +
                            '<a class="btn btn-primary btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                            '<div class="dropdown-menu">' +
                            '<a href="#" class="dropdown-item btn-viewpdf" data-id="' + row.id + '" data-flname="' + row.lname + '" data-ffname="' + row.fname + '" data-fmname="' + row.mname + '" data-fxname="' + row.ext + '" data-adrname="' + row.adrID + '" data-deptname="' + row.dept + '" data-email="' + row.email + '">' +
                            '<i class="fas fa-file-pdf"></i> View in PDF' +
                            '</a>' +
                            '<a href="#" class="dropdown-item btn-viewexcel" data-id="' + row.id + '" data-flname="' + row.lname + '" data-ffname="' + row.fname + '" data-fmname="' + row.mname + '" data-fxname="' + row.ext + '" data-adrname="' + row.adrID + '" data-deptname="' + row.dept + '" data-email="' + row.email + '">' +
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
    setInterval(function () {
        dataTable.ajax.reload(null, false);
    }, 3000);
});

