const errorSpan = document.getElementById('error');

const notyf = new Notyf({
    duration: 5000,
    position: {
        x: 'right',
        y: 'top'
    }
});

if (errorSpan) {
    notyf.error(errorSpan.innerHTML);
}