$('.comment_button').click(()=>{
   $('.container_comment').addClass('active')
})

$('#closeComment').click(()=>{
    $('.container_comment').removeClass('active')
})

$('.like').click(()=>{
    $('.like').toggleClass('active')
})