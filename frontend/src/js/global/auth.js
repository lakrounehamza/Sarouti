const url_connexion = "http://127.0.0.1:8000/api/login";
const url_inscription = "http://127.0.0.1:8000/api/register";
const url_logout = "http://127.0.0.1:8000/api/logout";
const url_refresh = "http://127.0.0.1:8000/api/refresh";
const connexion_button_popap = document.getElementById("connexion_button_popap");
const menu_div = document.getElementById("profile_menu");
const token = getTokenFromCookie();
if (token) {
    menu_div.innerHTML = `<div class="   absolute right-2 top-24 bg-black/50 backdrop-blur-md p-6 rounded-2xl shadow-lg flex flex-col items-center space-y-4" >
          <button class="px-6 py-2 bg-white text-black rounded-lg hover:bg-gray-200 transition" id="deconnexion_buttonu" type="submit">déconnexion</button>
          <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition" id="myProfile_button">profile</button>
        </div>`;
        
var  deconnexion_button = document.getElementById("deconnexion_buttonu");
} else
    menu_div.innerHTML = `<div class="   absolute right-2 top-24 bg-black/50 backdrop-blur-md p-6 rounded-2xl shadow-lg flex flex-col items-center space-y-4" >
          <button class="px-6 py-2 bg-white text-black rounded-lg hover:bg-gray-200 transition" id="connexion_button">Connexion</button>
          <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition" id="inscription_button">Inscription</button>
        </div>`;
        
function connexion() {
    // event.preventDefault();

    const password = document.getElementById('connexion_password').value;
    const email = document.getElementById('connexion_email').value;

    fetch(url_connexion, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ password, email })
    })
        .then(response => response.json()
        )
        .then(data => {
            if (data.success) {
                const now = new Date();
                var date = now.getFullYear() + "" + (now.getMonth() + 1) + "" + now.getDate() + "" + now.getHours() + "" + now.getMinutes() + "" + now.getSeconds();
                setTokenTimeCookie(data.data.token, date);
                console.log("Connexion réussie !");
                console.log(data.data.token);

            }
        })
}
connexion_button_popap.addEventListener("click", function (event) {
    event.preventDefault();
    connexion();
});
function setTokenTimeCookie(token, time) {
    const expireDate = new Date();
    expireDate.setDate(expireDate.getDate() + 7);
    document.cookie = `time=${time}; path=/; expires=${expireDate.toUTCString()}; Secure; SameSite=Strict`;
    document.cookie = `token=${token}; path=/; expires=${expireDate.toUTCString()}; Secure; SameSite=Strict`;
}
function getTokenFromCookie() {
    const cookies = document.cookie.split(';');
    for (let c of cookies) {
        const [key, value] = c.trim().split('=');
        if (key === 'token') return value;
    }
    return null;
}
function deleteTokenCookie() {
    document.cookie = "token=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
}
function getTimeFromCookie() {
    const cookies = document.cookie.split(';');
    for (let c of cookies) {
        const [key, value] = c.trim().split('=');
        if (key === 'time') return decodeURIComponent(value);
    }
    return null;
}

deconnexion_button.addEventListener("click", function (event) {
    event.preventDefault();
    console.log("deconnexion");
    fetch(url_logout, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${getTokenFromCookie()}`
        },
    }).then(response => response.json()).then();
    deleteTokenCookie();
});
// console.log(deconnexion_button);
// console.log(getTimeFromCookie());
function inscription(event){
    event.preventDefault();
    // const password = document.getElementById('inscription_password').value;
    // const email  = document.getElementById('inscription_email').value;
    // const username = document.getElementById('inscription_name').value;
    // const password_confirmation = document.getElementById('inscription_password_confirmation').value;
    // const phone = document.getElementById('inscription_phone').value;
    // const profile_photo = document.getElementById('inscription_profile_photo').value;
    // const role = document.getElementById('inscription_role').value;
    const form = document.getElementById('form-inscription');
    const formData = new FormData(form);
    fetch(url_inscription, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        // body: JSON.stringify({ password, email, name, phone, profile_photo, role })
        body : formData,
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.success) {
                console.log("Inscription réussie !");
                console.log(data.message);
            }
        }).catch(error => {
            console.error("Erreur lors de l'inscription : !!!!! ");
        });
}
const inscription_button_popap = document.getElementById("inscription_button_popap");
inscription_button_popap.addEventListener("click", function (event) {
    event.preventDefault();
    inscription();
});