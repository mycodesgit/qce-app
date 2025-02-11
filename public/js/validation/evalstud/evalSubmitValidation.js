$(document).ready(function () {
    $.validator.setDefaults({
        ignore: [] // Ensures hidden fields are not ignored
    });

    $('#evaluateFaculty').validate({
        rules: {
            // Ensures that each radio button group (question_rate[]) has a selection
            "question_rate[]": {
                required: function (element) {
                    return $('input[name="' + element.name + '"]:checked').length === 0;
                }
            }
        },
        messages: {
            "question_rate[]": {
                required: "Please select a score."
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');

            if (element.attr("type") === "radio") {
                // Append error below the radio group, not each button
                element.closest('.radio-group').append(error);
            } else {
                element.closest('.col-md-6, .col-md-12').append(error);
            }
        },
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        }
    });

    // ✅ Fix for unselectable radio buttons on form submission
    $("input[type='radio']").on("change", function () {
        let groupName = $(this).attr("name");
        $("input[name='" + groupName + "']").valid();
    });
});
