$(".boutonSearch").click(function() {
    if ($('#inputSearch').is(':visible')) {
        $('#inputSearch').fadeOut()

        $('#searchIcon').show()
        $('#crossIcon').hide()
    } else {
        $('#inputSearch').fadeIn()
        
        $('#crossIcon').show()
        $('#searchIcon').hide()
    }
})