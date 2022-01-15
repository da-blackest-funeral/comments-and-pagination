$(document).ready(function () {
    $('.show').click(function () {
        $('#wrapper').load('/?page=' + $(this).attr('id'));
    });
});
