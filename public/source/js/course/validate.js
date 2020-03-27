$(document).ready(function () {
    $("#errorCourse").hide();
    $("#errorDescription").hide();

    var errorCourse = false;
    var errorDescription = false;

    $("#course").focusout(function () {
        checkCourse();
    });
    $("#description").focusout(function () {
        checkDescription();
    });

    function checkCourse() {
        var Course = $("#course").val();
        if (Course == "") {
            $("#errorCourse").html("Tên Course không để trống !!");
            $("#errorCourse").show();
            errorCourse = true;
        } else if (Course.length > 64) {
            $("#errorCourse").html("Tên không quá 64 ký tự !!");
            $("#errorCourse").show();
            errorCourse = true;
        } else {
            $("#errorCourse").hide();
        }
    }

    function checkDescription() {
        var description = $("#description").val();
        if (description == "") {
            $("#errorDescription").html("Mô tả không để trống !!");
            $("#errorDescription").show();
            errorDescription = true;

        } else if (description.length > 500) {
            $("#errorDescription").html("Mô tả tối đa 500 ký tự");
            $("#errorDescription").show();
            errorDescription = true;
        } else {
            $("#errorDescription").hide();
        }
    }

    $("#createCourse").submit(function () {
        errorCourse = false;
        errorDescription = false;
        checkCourse();
        checkDescription();

        if (errorCourse == false && errorDescription == false) {
            return true;
        } else {
            return false;
        }
    })

    $('#add-course').click( function () {
        $(".modal").find('form').trigger('reset');
    });
});


