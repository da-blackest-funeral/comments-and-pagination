$(document).ready(function () {
    $('.show').click(function () {
        $('#wrapper').load('http://192.168.56.10?page=' + $(this).attr('id'));
    });
});