$(document).ready(function() {
    $('#campus').change(function() {
        var campus = $('#campus').val();
        if (schlyear && semester) {
            $.ajax({
                url: getfacltyReadRoute,
                type: 'GET',
                data: {
                    campus: campus
                },
                success: function(data) {
                    $('#faclty').empty();
                    $('#faclty').append('<option disabled selected>Select a Faculty</option>');
                    $.each(data, function(key, value) {
                        $('#faclty').append('<option value="' + value.id + '">' + value.lname + ', ' + value.fname + '</option>');
                    });
                }
            });
        }
    });
});