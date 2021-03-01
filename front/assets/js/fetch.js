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
    })
})