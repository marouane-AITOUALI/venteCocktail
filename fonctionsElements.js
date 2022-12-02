var navbar = document.getElementById("bandeau");
var menu = document.getElementById("navigation");

window.onscroll = function(){
    if (window.pageYOffset >= menu.offsetTop){
        navbar.classList.add("sticky");
    } else {
        navbar.classList.remove("sticky");
    }
}