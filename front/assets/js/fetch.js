// Barre de recherche
$(document).ready(function() {
    $('#fetchval').keyup(function() {
        var value = $(this).val()
        if(value.length >= 2) {
            $.ajax({
                url: '/front/functions/fetch.php',
                type: 'POST',
                data: 'request=' + value,
                beforeSend: function() {
                    $('#suggestion_container').show()
                    $('#suggestion_container').html('<p>Recherche en cours ...</p>')
                },
                success: function(data) {
                    $('#suggestion_container').html(data)
                }
            })
        } else {
            $.ajax({
                url: '/front/functions/fetch.php',
                type: 'POST',
                data: 'request=' + '',
                beforeSend: function() {
                    $('#suggestion_container').hide()
                    $('#suggestion_container').html('')
                },
                success: function(data) {
                    $('#suggestion_container').html('')
                }
            })
        }
    });

    $('.comment_input').on('submit', function(e) {
        e.preventDefault();
        let $form = $(this);
        let input = $form.find('.input');
        $.post('/front/functions/sendComment.php', $form.serialize())
        .done((data, text, jqxhr) => {
            if (jqxhr.responseText === 'notConnected') return window.location.href = '/connexion';
            if (jqxhr.responseText === 'cannotPost') return notyf.error({ message: 'Impossible de poster le commentaire !', duration: 2000 });
            let comment = $(jqxhr.responseText).hide();
            $('#comment-body').prepend(comment);
            comment.slideDown();
            input.val('');
            notyf.success({ message: 'Commentaire posté !', duration: 2000 });
        })
        .fail(jqxhr => {
            console.log(jqxhr.responseText);
        });
    })
})