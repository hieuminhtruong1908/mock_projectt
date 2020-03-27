$('#caption').click(function () {
    $("#name").html($(this).data().name);
    $("#joindate").html($(this).data().start_date);
    $("#email").html($(this).data().email);
    $("#nickname").html($(this).data().nickname);
    $("#info").html($(this).data().info);
    $("#groupjoined").html($(this).data().namegroup);
    var url = 'source/img/user/' + $(this).data().avatar;
    $("img#avatarcaption").attr('src', url);
})

$('#mentor').click(function () {
    $("#name").html($(this).data().name);
    $("#joindate").html($(this).data().start_date);
    $("#email").html($(this).data().email);
    $("#nickname").html($(this).data().nickname);
    $("#info").html($(this).data().info);
    $("#groupjoined").html($(this).data().namegroup);
    var url = 'source/img/user/' + $(this).data().avatar;
    $("img#avatarcaption").attr('src', url);
})

$('.member').click(function () {
    $("#name").html($(this).data().name);
    $("#joindate").html($(this).data().start_date);
    $("#email").html($(this).data().email);
    $("#nickname").html($(this).data().nickname);
    $("#info").html($(this).data().info);
    $("#groupjoined").html($(this).data().namegroup);
    var url = 'source/img/user/' + $(this).data().avatar;
    $("img#avatarcaption").attr('src', url);
})
