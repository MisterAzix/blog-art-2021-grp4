$('#ajax-numLang').on('change', e => {
    $.post('../article/selectLang.php', { numLang: $('#ajax-numLang').val() })
        .done((data, text, jqxhr) => {
            $('#ajax-container').empty().append(jqxhr.responseText)
            //console.log(jqxhr.responseText);
        })
        .fail(jqxhr => {
            console.log(jqxhr.responseText);
        });
});