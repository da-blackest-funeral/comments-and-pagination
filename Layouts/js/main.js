$(document).ready(function () {
    $('.show').click(function () {
        $('#wrapper').load('http://192.168.56.10/?ajax=1&page=' + $(this).attr('id'));
    });
});