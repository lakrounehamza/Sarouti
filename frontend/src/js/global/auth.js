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

    var deconnexion_button = document.getElementById("deconnexion_buttonu");
    setImageProfier();

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
            console.log(data);
            if (data.success) {
                const now = new Date();
                var date = now.getFullYear() + "" + (now.getMonth() + 1) + "" + now.getDate() + "" + now.getHours() + "" + now.getMinutes() + "" + now.getSeconds();
                console.log("dara" + data.data.user.id);
                setTokenTimeCookie(data.data.token, date, data.data.user.id);;
                console.log("Connexion réussie !");
                console.log(data.data.token);

            }
        })
}
connexion_button_popap.addEventListener("click", async function (event) {
    event.preventDefault();
    await connexion();
    setTimeout(function () {
        window.location.reload();
    },
        5000);
});

function setTokenTimeCookie(token, time, user_id) {
    const expireDate = new Date();
    expireDate.setDate(expireDate.getDate() + 7);
    document.cookie = `time=${time}; path=/; expires=${expireDate.toUTCString()}; Secure; SameSite=Strict`;
    document.cookie = `token=${token}; path=/; expires=${expireDate.toUTCString()}; Secure; SameSite=Strict`;
    document.cookie = `user_id=${user_id}; path=/; expires=${expireDate.toUTCString()}; Secure; SameSite=Strict`;

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
    document.cookie = "time=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
    document.cookie = "user_id=; path=/; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
}
function getTimeFromCookie() {
    const cookies = document.cookie.split(';');
    for (let c of cookies) {
        const [key, value] = c.trim().split('=');
        if (key === 'time') return decodeURIComponent(value);
    }
    return null;
}

if (token)
    deconnexion_button.addEventListener("click", function () {
        // event.preventDefault();
        console.log("deconnexion");
        fetch(url_logout, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${getTokenFromCookie()}`
            },
        }).then(response => response.json()).then(
            data => {
                console.log(data);
                if (data.success) {
                    window.location.reload();
                }
            }
        );
        deleteTokenCookie();
    });
// console.log(deconnexion_button);
// console.log(getTimeFromCookie());
function inscription() {
    // event.preventDefault();
    console.log("inscription");
    const name = document.getElementById('inscription_name').value;
    const email = document.getElementById('inscription_email').value;
    const password = document.getElementById('inscription_password').value;
    const phone = document.getElementById('inscription_phone').value;
    let photo = document.getElementById('file-upload').files[0];
    const role = document.getElementById('inscription_role').value;

    if (!photo) {
        console.error("Aucune image sélectionnée !");
        return;
    }
    // photo = photo.split('\\').pop(); 
    console.log({ name, email, password, phone, photo, role });
    const formData = new FormData();
    formData.append('name', name);
    formData.append('email', email);
    formData.append('password', password);
    formData.append('phone', phone);
    formData.append('photo', photo);
    formData.append('role', role);
    fetch(url_inscription, {
        method: 'POST',
        // body: JSON.stringify({ name,email,password, phone, photo,role })
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            console.log(data.message);

        });
}
const inscription_button_popap = document.getElementById("inscription_button_popap");
inscription_button_popap.addEventListener("click", inscription);

function setImageProfier() {
    const cookies = document.cookie.split('; ');
    console.log(cookies);
    const id = cookies[2];
    console.log("id  user : "+id);
    const url = "http://127.0.0.1:8000/api/users/" + id.split('=')[1];
    console.log(url);
    const porfile_image = document.getElementById("profile-image-client");
    const xhr = new XMLHttpRequest();
    console.log(url);
    xhr.open("GET", url, true);
    console.log("ddd2");
    xhr.onreadystatechange = function () {
        console.log("ddd3");
        if (xhr.readyState === 4 && xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);
            console.log(data.user.photo);
            path = "../../../backend/public/" + data.user.photo;
            console.log(path);
             porfile_image.src = path;
             porfile_image.style.radius = "100px";
            console.log(porfile_image);
            console.log("ddd4");
        }
    };
    xhr.send();
}