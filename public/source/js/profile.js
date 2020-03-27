function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profile-img-tag').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#profile-img").change(function () {
    readURL(this);
});

$(document).ready(function () {
    function showMessage(id, title) {
        $(id).html(title);
        $(id).css("color", "red");
    }

    $("#update-profile").on('submit', function (event) {
        let id = $("#user").val();
        let nameEror = dateEror = infoEror = fileEror = nicknameEror = "";
        event.preventDefault();
        $.ajax({
            url: 'http://lsn.ntq.solutions/profile/' + id,
            method: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {

                $('#message').css('display', 'block');
                $('#message').html(data.message);
                $('#message').addClass(data.class_name);
                setTimeout(function () {
                    $('#message').css('display', 'none');
                }, 3000)

                if (data.src_img) {
                    $('#message').attr("src", "source/img/user/data.src_img");
                }
                $('.hide').css('display', 'none');
                location.reload();
            },
            error: function (data) {
                if (data.status === 422) {
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (key, value) {
                        if (value.name) nameEror += value.name[0];
                        if (value.date) dateEror += value.date[0];
                        if (value.skype) nicknameEror += value.skype[0];
                    })

                    showMessage("#name-error", nameEror);
                    showMessage("#date-error", dateEror);
                    showMessage("#info-error", infoEror);
                    showMessage("#nickname-error", nicknameEror);
                }
            }
        })
    })
});


