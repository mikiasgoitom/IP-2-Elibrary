// disappear register and login after login

var loggedIn = false;


function logIn(){
    loggedIn = true;
}


var profileIcon;
var signIn;
var logOut;

function status(){
    if (loggedIn) {
        profileIcon = document.getElementById("profile")
        profileIcon.style.display = "flex";
        signIn = document.getElementById("signin");
        signIn.style.display = "none";
        logOut = document.getElementById("logout");
        logOut.style.display = "flex";
    
    } else {
        profileIcon.style.display = "none";
        logOut.style.display = "none";  
        signIn.style.display = "flex"
    }
}