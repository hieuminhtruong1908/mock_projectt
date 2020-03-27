$.validator.addMethod("checkStartDate", function(value, element) {
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

$("#createEvent").validate({
    ignore: [],
    rules: {
        event: {
            required: true,
        },
        start_date: {
            required: true,
            checkStartDate: true
        },
        start_time: {
            required: true
        },

    },
    messages: {
        event: {
            required: "**Tên event không được để trống",
        },
        start_date: {
            required: "**Start Date không để trống",
            checkStartDate: "**Start date không là ngày trong quá khứ"
        },
        start_time: {
            required: "**Start Time không để trống"
        },
        speaker: {
            required: "**Speaker không để trống",
        },
        document: {
            required: "**Document link không để trống",
            url: "**Document phải là link URL"
        },
        description: {
            required: "**Mô tả không được để trống",
        },
    },
});

$("#createEvent").validate({
    onsubmit: false
});
