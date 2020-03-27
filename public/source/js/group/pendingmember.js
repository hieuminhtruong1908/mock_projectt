
$(document).ready(function () {
    $('#leaved').change(function() {
        if ($(this).val() == idMember) {
            $.ajax({
                type:"GET",
                url : leaveURL,
                success : function(response) {
                   location.reload();
                },
            });
        }
    });
    var level ="Expert";
    $(".viewAll").click(function () {
        $('#pendingAuthor').val($(this).data().author);
        $('#pendingTitle').val($(this).data().title);
        $('#pendingStart').val($(this).data().start);
        $('#pendingEnd').val($(this).data().end);
        if ($(this).data().level == 0){
            level = "Beginer";
        }
        if ($(this).data().level == 1){
            level = "Intermediate";
        }
        $('#pendingLevel').val(level);
        CKEDITOR.instances['viewall'].setData(($(this).data().des));
    })
    $('#pills-pendingItem-tab').click(function () {
        $('#memberPending-tab').addClass('active');
        $('#memberPending').addClass('active show')
    });
});
