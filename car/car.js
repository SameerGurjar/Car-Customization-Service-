function myFunction() {
    var x = document.getElementById("myTopnav");
    var y = document.getElementById("");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

// Get the modal login
var modal_login = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal_login) {
        modal_login.style.display = "none";
    }
}


// Get the modal signup
var modal_signup = document.getElementById('id02');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal_signup) {
        modal_signup.style.display = "none";
    }
}