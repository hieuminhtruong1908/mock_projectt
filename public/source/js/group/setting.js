$("#change-name").validate({
    rules: {
        name: {
            required: true,
            maxlength: 64
        },

    },
    messages: {
        name: {
            required: "**Tên Group không được để trống,",
        },
    },
 });

$("#change-name").validate({
    onsubmit: false
});

$("#change-description").validate({
    rules: {
        descr: {
            required: true,
            maxlength: 255
        },

    },
    messages: {
        descr: {
            required: "**Mô tả  không được để trống,",
            maxlength: "**Mô tả không được quá 255 kí tự",
        },
    },
});

$("#change-description").validate({
    onsubmit: false
});




$("#change-avatar").validate({
    rules: {
        avatar: {
            required: true,
            extension: "jpg|png|jpeg|",
        },

    },
    messages: {
        avatar: {
            required: "Bạn cần chọn ảnh để cập nhật",
            extension: "Chỉ cho phép file với định dạng jpg,jpeg,png hoặc gif",
        },
    },
});

$("#change-avatar").validate({
    onsubmit: false
});


$("#change-cover").validate({
    rules: {
        changecover: {
            required: true,
            extension: "jpg|png|jpeg|",
        },

    },
    messages: {
        changecover: {
            required: "Bạn cần chọn ảnh để cập nhật",
            extension: "Chỉ cho phép file với định dạng jpg,jpeg,png hoặc gif",
        },
    },
});

$("#change-cover").validate({
    onsubmit: false
});





function readURLAvatar(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img-change-avatar').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

function readURLCoverr(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#changecover').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


$("#input-cover").change(function(){
   readURLCoverr(this);
});


$("#avata").change(function(){
    readURLAvatar(this);
});
