$.validator.addMethod("checkDate", function(value, element) {
    var current = new Date();
    var month = current.getMonth()+1;
    var day = current.getDate();
    var input = new Date(value);
    var monthInput = input.getMonth()+1;
    var dayInput = input.getDate();

    var currentDate = current.getFullYear() + '/' +
    (month < 10 ? '0' : '') + month + '/' +
    (day < 10 ? '0' : '') + day;

    var inputDate = input.getFullYear() + '/' +
    (monthInput < 10 ? '0' : '') + monthInput + '/' +
    (dayInput < 10 ? '0' : '') + dayInput;

    if (inputDate >= currentDate)
        return true;
    return false;
});

$("#createGroup").validate({
    rules: {
        group: {
            required: true,
            maxlength: 64
        },
        description: {
            required: true,
            maxlength: 255
        },
        start: {
            required: true,
            checkDate: true
        },
    },
    messages: {
        group: {
            required: "**Tên Group không được để trống",
            maxlength: "**Tên Group tối đa 64 ký tự"
        },
        description: {
            required: "**Mô tả không được để trống",
            maxlength: "**Mô tả tối đa 255 ký tự"
        },
        start: {
            required: "**Date không để trống",
            checkDate: "**Ngày tạo group phải lớn hơn ngày quá khứ"
        },
    },
});

$("#createGroup").validate({
    onsubmit: false
});
