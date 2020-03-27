$(document).ready(function () {

    var level = "Expert";
    $(".contentAttendance").click(function () {
        $('#contentAuthor').val($(this).data().author);
        $('#contentTitle').val($(this).data().title);
        $('#contentStart').val($(this).data().start);
        $('#contentEnd').val($(this).data().end);
        if ($(this).data().level == 0) {
            level = "Beginer";
        }
        if ($(this).data().level == 1) {
            level = "Intermediate";
        }
        $('#contentLevel').val(level);
        CKEDITOR.instances['contentAtt'].setData(($(this).data().des));
    })
});

$(document).ready(function () {
    $(".content-att").click(function () {
        $("#content-title-att").html($(this).data().title);
        member = $(this).data().memberatt;
        var array = $.map(member, function (value, index) {
            return [value];
        });
        att = $(this).data().attendance;
        $.each(array, function (key, val) {
            $("#note-" + val.id).val(att[key]['note']);
            if (att[key].status == 1) {
                $("#member-" + val.id).prop('checked', true);
            }

        });
    });
});

