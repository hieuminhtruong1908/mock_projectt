var currentDate, startDate, endDate;

$.validator.addMethod("checkStartDate", function(value, element) {
    var current = new Date();
    var monthCurrent = current.getMonth()+1;
    var dayCurrent = current.getDate();
    var inputStart = new Date(value);
    var monthStart = inputStart.getMonth()+1;
    var dayStart = inputStart.getDate();

    currentDate = current.getFullYear() + '/' +
        (monthCurrent<10 ? '0' : '') + monthCurrent + '/' +
        (dayCurrent<10 ? '0' : '') + dayCurrent;

    startDate = inputStart.getFullYear() + '/' +
        (monthStart < 10 ? '0' : '') + monthStart + '/' +
        (dayStart < 10 ? '0' : '') + dayStart;

    if (startDate >= currentDate)
        return true;
    return false;
});

$.validator.addMethod("checkEndDate", function(value, element) {
    var endDate = new Date(value);
    var monthEnd = endDate.getMonth()+1;
    var dayEnd = endDate.getDate();

    endDate = endDate.getFullYear() + '/' +
        (monthEnd < 10 ? '0' : '') + monthEnd + '/' +
        (dayEnd < 10 ? '0' : '') + dayEnd;

    if (endDate > startDate && endDate > currentDate)
        return true;
    return false;
})

$("#createContent").validate({
    ignore: [],
    rules: {
        content: {
            required: true,
            maxlength: 64
        },
        start: {
            required: true,
            checkStartDate: true
        },
        end: {
            required: true,
            checkEndDate: true
        },
        document: {
            required: true,
        },
        description: {
            required: true,
        },
    },
    messages: {
        content: {
            required: "**Tên Group không được để trống",
            maxlength: "**Tên Group tối đa 64 ký tự"
        },
        start: {
            required: "**Start Date không để trống",
            checkStartDate: "**Start date không là ngày trong quá khứ"
        },
        end: {
            required: "**end Date không để trống",
            checkEndDate: "*End date phải lớn hơn Start Date và không là ngày quá khứ"
        },
        document: {
            required: "**document không để trống",
        },
        description: {
            required: "**Mô tả không được để trống",
        },
    },
});

$("#createContent").validate({
    onsubmit: false
});
