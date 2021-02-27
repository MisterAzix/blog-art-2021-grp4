$(".boutonSearch").click(function() {
    if ($('.inputSearch').is(':visible')) {
        $('.inputSearch').fadeOut()

        $('.searchIcon').show()
        $('.crossIcon').hide()

        if($(this).hasClass('mobileBouton')) {
            setTimeout(() => {
                $('.logoMobile').show()
            }, 500)
        }

        setTimeout(() => {
            $('#fetchval').val('')
            $('#suggestion_container a').remove()
            $('#suggestion_container p').remove()
            $('#suggestion_container').hide()
        }, 500);
    } else {
        $('.inputSearch').fadeIn()
        
        $('.crossIcon').show()
        $('.searchIcon').hide()

        if($(this).hasClass('mobileBouton')) {
            $('.logoMobile').hide()
        }
    }
})