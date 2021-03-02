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

$('.button-thumb').click(e => {
    $.post('/front/functions/likeSwitch.php', { numSeqCom: e.currentTarget.id.match(/\d+/)[0], numArt: $('.button-thumb').data().numart })
        .done((data, text, jqxhr) => {
            let likes = $(`#${e.currentTarget.id} span`).html();
            if (jqxhr.responseText === 'notConnected') return window.location.href = '/connexion';
            $(`#${e.currentTarget.id} span`).html(jqxhr.responseText);
            (likes > jqxhr.responseText) ?
                notyf.error({ message: 'Commentaire unliké !', duration: 2000 }) :
                notyf.success({ message: 'Commentaire liké !', duration: 2000 });
        })
        .fail(jqxhr => {
            console.log(jqxhr.responseText);
        });
    $(`#${e.currentTarget.id}`).toggleClass('active');
});

$('#cookie-button').click(e => {
    let d = new Date();
    d.setTime(d.getTime() + (365 * 24 * 60 * 60 * 1000));
    let expires = "expires=" + d.toUTCString();
    document.cookie = "accepted=true;" + expires + ";path=/";
    $('#cookie-button').parent().fadeOut();
    notyf.success({ message: 'Cookies acceptés !', duration: 2000 });
});