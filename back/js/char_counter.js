const inputs = document.querySelectorAll('input');
const textareas = document.querySelectorAll('textarea');

inputs.forEach(input => {
    let max_length = $(input).data('maxlength');
    let id = input.id;
    let span = $(`#${id}-span`);
    if (!max_length || !id || !span) return;
    span.html(`${$(input).val().length}/${max_length}`);
    $(input).on('keydown', () => {
        let length = $(input).val().length;
        span.html(`${length}/${max_length}`);
    });
});

textareas.forEach(textarea => {
    let max_length = $(textarea).data('maxlength');
    let id = textarea.id;
    let span = $(`#${id}-span`);
    if (!max_length || !id || !span) return;
    span.html(`${$(textarea).val().length}/${max_length}`);
    $(textarea).on('keydown', () => {
        let length = $(textarea).val().length;
        span.html(`${length}/${max_length}`);
    });
});