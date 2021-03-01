$('.comment_button').click(() => {
    $('.container_comment').addClass('active')
})

$('#closeComment').click(() => {
    $('.container_comment').removeClass('active')
})

$('.like').click(() => {
    $.post('/front/functions/likeSwitch.php', { numArt: $('.like').data().numart })
        .done((data, text, jqxhr) => {
            let likes = $('.like span').html();
            if (jqxhr.responseText === 'notConnected') return window.location.href = '/connexion';
            $('.like span').html(jqxhr.responseText);
            (likes > jqxhr.responseText) ?
                notyf.error({ message: 'Article unliké !', duration: 2000 }) :
                notyf.success({ message: 'Article liké !', duration: 2000 });
        })
        .fail(jqxhr => {
            console.log(jqxhr.responseText);
        });
    $('.like').toggleClass('active')
});

$('#cookie-button').click(e => {
    let d = new Date();
    d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = "accepted=true;" + expires + ";path=/";
    notyf.success({ message: 'Cookies acceptés !', duration: 2000 });
});