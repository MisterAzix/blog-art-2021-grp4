let slideIndex = 1
showSlides(slideIndex)

let intervalID = null
setIntervalID()

function currentSlide(n) {
    showSlides(slideIndex = n)
    clearInterval(intervalID)
    setIntervalID()
}

function showSlides(n) {
  let i
  const slides = $(".slides")
  const dots = $(".line")

  if(slides.length == 0) return; // Pour ne pas exécuter le programme sur les pages sans slide == erreur dans la console

  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none"
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "")
  }
  slides[slideIndex-1].style.display = "block"
  dots[slideIndex-1].className += " active"
}

function setIntervalID() {
    intervalID = setInterval(() => {
        slideIndex++
        showSlides(slideIndex)
    }, 4000)
}
