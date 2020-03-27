$(document).ready(function () {
    var url = "";
    $(".takeattendance").click(function () {
        $("#content-title").html($(this).data().title);
        $("#id-content").val($(this).data().id);
        member = $(this).data().memberatt;
        var array = $.map(member, function (value, index) {
            return [value];
        });
        att = $(this).data().attendance;
        $.each(array, function (key, val) {
            $("#note" + val.id).val(att[key]['note']);
            if (att[key].status == 1) {
                $("#member" + val.id).prop('checked', true);
            }

        });
    });
    $("#submit").click(function () {
        url = urlAttendance + $("#id-content").val();
        $("#takeattendance").attr('action', url);
        $("#takeattendance").submit();
    })

});
