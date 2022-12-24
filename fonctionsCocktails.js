var navbar = document.getElementById("bandeau");
var menu = document.getElementById("menu");

window.onscroll = function(){
    if (window.pageYOffset >= menu.offsetTop){
        navbar.classList.add("sticky");
    } else {
        navbar.classList.remove("sticky");
    }
}

function reveal() {
    var reveals = document.querySelectorAll(".reveal");
    for (var i = 0; i < reveals.length; i++) {
      var windowHeight = window.innerHeight;
      var elementTop = reveals[i].getBoundingClientRect().top;
      //var elementVisible = 50;
      
      if (elementTop < windowHeight /*- elementVisible*/) {
        reveals[i].classList.add("active");
      } else {
        reveals[i].classList.remove("active");
      }
    }
}
window.addEventListener("scroll", reveal);

document.addEventListener("keydown", function(event) {
  //Desactiver les flèches directrices
  if (event.keyCode == 38 || event.keyCode == 40) {
    event.preventDefault();
  }
});