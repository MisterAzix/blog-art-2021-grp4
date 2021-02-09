let text_max = 200;
$('#count_message').html('0 / ' + text_max);

$('textarea').keyup(function () {
    let text_length = $('textarea').val().length;
    let text_remaining = text_max - text_length;

    $('#count_message').html(text_length + ' / ' + text_max);
});