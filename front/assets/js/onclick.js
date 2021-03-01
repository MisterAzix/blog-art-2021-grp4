$('.comment_button').click(()=>{
   $('.container_comment').addClass('active')
})

$('#closeComment').click(()=>{
    $('.container_comment').removeClass('active')
})

$('.like').click(()=>{
    $.post('/front/functions/likeSwitch.php', { numArt: $('.like').data().numart })
        .done((data, text, jqxhr) => {
            $('.like span').html(jqxhr.responseText)
        })
        .fail(jqxhr => {
            console.log(jqxhr.responseText);
        });
    $('.like').toggleClass('active')
})