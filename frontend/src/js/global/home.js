const profile_menu = document.getElementById("profile_menu");
const  button_profile_button = document.getElementById("button_profile_button");
button_profile_button.addEventListener("click", function (event) {
    event.preventDefault();
    if(profile_menu.classList.contains("hidden")){
        profile_menu.classList.remove("hidden");
    }else{
        profile_menu.classList.add("hidden");
    }       
}); 