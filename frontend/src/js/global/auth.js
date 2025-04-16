const url_connexion = "http://127.0.0.1:8000/api/login";
const url_inscription = "http://127.0.0.1:8000/api/register";
const url_logout = "http://127.0.0.1:8000/api/logout";
const url_refresh = "http://127.0.0.1:8000/api/refresh";
const connexion_button_popap = document.getElementById("connexion_button_popap");
const menu_div = document.getElementById("profile_menu");
const token = getTokenFromCookie();
if (token) {
    menu_div.innerHTML = `<div class="   absolute right-2 top-24 bg-black/50 backdrop-blur-md p-6 rounded-2xl shadow-lg flex flex-col items-center space-y-4" >
          <button class="px-6 py-2 bg-white text-black rounded-lg hover:bg-gray-200 transition" id="connexion_button">déconnexion</button>
          <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition" id="inscription_button">profile</button>
        </div>`;
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

console.log(getTokenFromCookie());
// console.log(getTimeFromCookie());