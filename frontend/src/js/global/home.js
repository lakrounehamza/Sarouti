const profile_menu = document.getElementById("profile_menu");
const  button_profile_button = document.getElementById("button_profile_button");
const  connextoin_popup = document.getElementById("connextoin_popup"); 
const connexion_button = document.getElementById("connexion_button");
const close_popup_connextion = document.getElementById("close-popup-connextion");
button_profile_button.addEventListener("click", function (event) {
    event.preventDefault();
    if(profile_menu.classList.contains("hidden")){
        profile_menu.classList.remove("hidden");
    }else{
        profile_menu.classList.add("hidden");
    }       
}); 
connexion_button.addEventListener("click", function (event) {
    event.preventDefault();
    if(connextoin_popup.classList.contains("hidden")){
        connextoin_popup.classList.remove("hidden");
    }else{
        connextoin_popup.classList.add("hidden");
    }       
});
close_popup_connextion.addEventListener("click", function (event) {
    event.preventDefault();
    if(connextoin_popup.classList.contains("hidden")){
        connextoin_popup.classList.remove("hidden");
    }else{
        connextoin_popup.classList.add("hidden");
    }       
});