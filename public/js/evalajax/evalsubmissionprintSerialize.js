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
    var progCodRaw = urlParams.get('progCod') || '';

    // Convert `+` into spaces (URL decoding issue)
    progCodRaw = progCodRaw.replace(/\+/g, ' ');

    // Split at the first space (since + is now a space)
    var progCodParts = progCodRaw.split(' ');

    // Extract parts
    var progCod = progCodParts.slice(0, -1).join(' '); // Everything before last part
    var section = progCodParts.slice(-1)[0] || ''; // Last part

    // Display separately in the console
    // console.log("ProgCod:", progCod);   // CAS-LHD-001
    // console.log("Section:", section);

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
                            '<a href="#" class="dropdown-item btn-viewpdf" data-id="' + row.id + '" data-program="' + row.progCod + '" data-year="' + row.studYear + '" data-section="' + row.studSec + '" data-schlyear="' + row.schlyear + '" data-semester="' + row.semester + '" data-campus="' + row.campus + '" data-studidno="' + row.studidno + '">' +
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

$(document).ready(function() {

    var urlParams = new URLSearchParams(window.location.search);
    var schlyear = urlParams.get('schlyear') || ''; 
    var semester = urlParams.get('semester') || '';
    var campus = urlParams.get('campus') || ''; 
    var progCod = urlParams.get('progCod') || '';

    var dataTable = $('#doneprintTable').DataTable({
        "ajax": {
            "url": doneprintReadRoute,
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
    setInterval(function () {
        dataTable.ajax.reload(null, false);
    }, 3000);
});


$(document).ready(function() {
    $('#submitevalTable').on('click', '.btn-viewpdf', function() {
        var programCode = $(this).data('program');
        var studYear = $(this).data('year');  // Possible issue: data attribute mismatch
        var studSec = $(this).data('section'); // Possible issue: missing data attribute
        var schlyear = $(this).data('schlyear');
        var semester = $(this).data('semester');
        var campus = $(this).data('campus');  // Ensure this is included
        var studidno = $(this).data('studidno');

        // Debugging: Log all extracted values
        console.log('Program Code:', programCode);
        console.log('Class Year:', studYear);
        console.log('Class Section:', studSec);
        console.log('School Year:', schlyear);
        console.log('Semester:', semester);
        console.log('Campus:', campus);
        console.log('Student ID:', studidno);

        // Check if any value is undefined
        if (!programCode || !studYear || !studSec || !schlyear || !semester || !campus) {
            alert("Missing required data. Check your button attributes.");
            return;
        }

        var pdfUrl = studentevalsubPDFReadRoute + 
                     "?progCod=" + programCode + 
                     "&studYear=" + studYear + 
                     "&studSec=" + studSec + 
                     "&schlyear=" + schlyear + 
                     "&semester=" + semester +
                     "&campus=" + campus +
                     "&studidno=" + studidno;

        //console.log("PDF URL:", pdfUrl); // Debugging URL

        $.ajax({
            url: pdfUrl,
            method: 'GET',
            success: function(response) {
                //console.log("PDF Response:", response);
                $('#pdfIframe').attr('src', pdfUrl);
                $('#viewEvalRatePDFModal').modal('show');
            },
            error: function(xhr) {
                //console.log("PDF Request Error:", xhr.responseText);
                alert('An error occurred while fetching the enrollment.');
            }
        });
    });
});

