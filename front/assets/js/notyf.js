const errorSpan = document.getElementById('error');

const notyf = new Notyf({
    duration: 20000,
    position: {
        x: 'right',
        y: 'top'
    },
    dismissible: true
});

if (errorSpan) {
    notyf.error(errorSpan.innerHTML);
}