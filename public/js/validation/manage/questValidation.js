$(function () {
    $('#addQuestion').validate({
        rules: {
            catName_id: {
                required: true,
            },
            questiontext: {
                required: true,
            },
        },
        messages: {
            catName_id: {
                required: "Please Select Category",
            },
            questiontext: {
                required: "Please Enter Question",
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-md-12').append(error);        
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});