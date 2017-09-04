var FormValidation = function () {

    var Forms = function (rules, messages) {
        // http://docs.jquery.com/Plugins/Validation

        var forms = $('.formPost');
        var errors = $('.alert-danger', forms);
        var successs = $('.alert-success', forms);

        forms.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "", // validate all fields including form hidden input
            rules: rules,
            messages: messages,

            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.parent(".input-group").size() > 0) {
                    error.insertAfter(element.parent(".input-group"));

                } else if (element.attr("data-error-container")) {
                    error.appendTo(element.attr("data-error-container"));

                } else if (element.parents('.radio-list').size() > 0) {
                    error.appendTo(element.parents('.radio-list').attr("data-error-container"));

                } else if (element.parents('.radio-inline').size() > 0) {
                    error.appendTo(element.parents('.radio-inline').attr("data-error-container"));

                } else if (element.parents('.checkbox-list').size() > 0) {
                    error.appendTo(element.parents('.checkbox-list').attr("data-error-container"));

                } else if (element.parents('.checkbox-inline').size() > 0) {
                    error.appendTo(element.parents('.checkbox-inline').attr("data-error-container"));

                } else {
                    error.insertAfter(element); // for other inputs, just perform default behavior
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                successs.hide();
                errors.show();
                App.scrollTo(errors, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                     .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                successs.show();
                errors.hide();
                // form[0].submit(); // submit the form
                if(postStatus){
                    form.submit();
                } else {
                    $('#check_password').modal();
                }
            }
        });
    }

    return {
        //main function to initiate the module
        init: function (rules, messages) {
            Forms(rules, messages);
        }
    };
}();

jQuery.validator.addMethod("fileCheck", function(value, element) {
    if($(element).val() =='' && $(element).parent().parent().find("[class='fileinput-filename']").html() ==''){
        return false;
    }
    return true;
});