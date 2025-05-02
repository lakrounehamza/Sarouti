const usersButton = document.getElementById("users-button");
const RolesButton = document.getElementById("roles-button");
const signalementsButton = document.getElementById("signalements-button");
const categorysButton = document.getElementById("categorys-button");
const demandesButton = document.getElementById("demandes-button");
const annoncesButton = document.getElementById("annonces-button");
const statistiquesButton = document.getElementById("statistiques-button");
const notificationsButton = document.getElementById("notifications-button");
const deconnexionButton = document.getElementById("deconnexion-button");
const usersContainer = document.getElementById("users-container");
const rolesContainer = document.getElementById("roles-container");
const signalementsContainer = document.getElementById("signalements-container");
const categorysContainer = document.getElementById("categorys-container");
const demandesContainer = document.getElementById("demandes-container");
const notificationsContainer = document.getElementById("notifications-container");
const fermePopapCategory = document.getElementById("fermePopapCategory");
const addCategory = document.getElementById("addCategory");
const popapAddCategory = document.getElementById("popap-addCategory");
function switchSection(section) {
    if (section === 'usersContainer') {
        localStorage.setItem('dashboardSection', 'users');
        usersContainer.classList.remove("hidden");
        rolesContainer.classList.add("hidden");
        signalementsContainer.classList.add("hidden");
        categorysContainer.classList.add("hidden");
        demandesContainer.classList.add("hidden");
        notificationsContainer.classList.add("hidden");
    } else if (section === 'rolesContainer') {
        localStorage.setItem('dashboardSection', 'roles');
        usersContainer.classList.add("hidden");
        rolesContainer.classList.remove("hidden");
        signalementsContainer.classList.add("hidden");
        categorysContainer.classList.add("hidden");
        demandesContainer.classList.add("hidden");
        notificationsContainer.classList.add("hidden");
    } else if (section === 'signalementsContainer') {
        localStorage.setItem('dashboardSection', 'signalements');
        usersContainer.classList.add("hidden");
        rolesContainer.classList.add("hidden");
        signalementsContainer.classList.remove("hidden");
        categorysContainer.classList.add("hidden");
        demandesContainer.classList.add("hidden");
        notificationsContainer.classList.add("hidden");
    } else if (section === 'categorysContainer') {
        localStorage.setItem('dashboardSection', 'categorys');
        usersContainer.classList.add("hidden");
        rolesContainer.classList.add("hidden");
        signalementsContainer.classList.add("hidden");
        categorysContainer.classList.remove("hidden");
        demandesContainer.classList.add("hidden");
        notificationsContainer.classList.add("hidden");
    } else if (section === 'demandesContainer') {
        localStorage.setItem('dashboardSection', 'demandes');
        usersContainer.classList.add("hidden");
        rolesContainer.classList.add("hidden");
        signalementsContainer.classList.add("hidden");
        categorysContainer.classList.add("hidden");
        demandesContainer.classList.remove("hidden");
        notificationsContainer.classList.add("hidden");
    } else if (section === 'notificationsContainer') {
        localStorage.setItem('dashboardSection', 'notifications');
        usersContainer.classList.add("hidden");
        rolesContainer.classList.add("hidden");
        signalementsContainer.classList.add("hidden");
        categorysContainer.classList.add("hidden");
        demandesContainer.classList.add("hidden");
        notificationsContainer.classList.remove("hidden");
    }
}

usersButton.addEventListener('click', () => {
    switchSection('usersContainer');
});
 RolesButton.addEventListener('click', () => {
    switchSection('rolesContainer');
});
signalementsButton.addEventListener('click', () => {
    switchSection('signalementsContainer');
});
categorysButton.addEventListener('click', () => {
    switchSection('categorysContainer');
});
demandesButton.addEventListener('click', () => {
    switchSection('demandesContainer');
});
notificationsButton.addEventListener('click', () => {
    switchSection('notificationsContainer');
});
document.addEventListener('DOMContentLoaded', () => {
    const savedSection = localStorage.getItem('dashboardSection');
 
    switch (savedSection) {
        case 'users':
            switchSection('usersContainer');
            break;
        case 'roles':
            switchSection('rolesContainer');
            break;
        case 'signalements':
            switchSection('signalementsContainer');
            break;
        case 'categorys':
            switchSection('categorysContainer');
            break;
        case 'demandes':
            switchSection('demandesContainer');
            break;
        case 'notifications':
            switchSection('notificationsContainer');
            break;
        default:
            switchSection('usersContainer');
    }
});
addCategory.addEventListener('click', () => {
    popapAddCategory.classList.toggle("hidden");
});
fermePopapCategory.addEventListener('click', () => {
    popapAddCategory.classList.toggle("hidden");
});

function  getAllUsers(){
    const cookies = document.cookie.split(';');
    const token = cookies.find(cookie => cookie.trim().startsWith('token='))?.split('=')[1]; 

    const url = "http://127.0.0.1:8000/api/users"; 

    const xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("Authorization", `Bearer ${token}`);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                console.log("Messages reçus :", data);
                setListeUsers(data.users);
            }
        }
    };

    xhr.onerror = function () {
        console.error("Erreur");
    };
    xhr.send();
}
function setListeUsers(users) {
    const table_users = document.getElementById('table-users');
    table_users.innerHTML = ''; 

    for (let user of users) {
        const temp = document.createElement('tr'); 
        temp.classList.add('border-b', 'border-gray-200', 'hover:bg-gray-100');
        temp.innerHTML = `
            <td class="py-3 px-6 text-left">${user.name}</td>
            <td class="py-3 px-6 text-left">${user.email}</td>
            <td class="py-3 px-6 text-left">${user.role }</td>
            <td class="py-3 px-6 text-left"> ${user.ban ===false ? 'actif' : 'suspendre'}</td>
            <td class="py-3 px-6 text-center">
                <div class="flex item-center justify-center">
                ${
                    user.ban == true
                      ? `<button class="w-4 mr-2 transform hover:text-blue-500 hover:scale-110" onclick="actifUser(${user.id})">
                           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                             <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                           </svg>
                         </button>`
                      : `<button class="w-4 mr-2 transform text-red-500 hover:scale-110" onclick="suspendreUser(${user.id})">
                           <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                             <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM184 232l144 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-144 0c-13.3 0-24-10.7-24-24s10.7-24 24-24z" />
                           </svg>
                         </button>`
                  }
                    <button class="w-4 mr-2 transform text-red-500 hover:scale-110">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM216 336l24 0 0-64-24 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l48 0c13.3 0 24 10.7 24 24l0 88 8 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-80 0c-13.3 0-24-10.7-24-24s10.7-24 24-24zm40-208a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                        </svg>
                    </button>
                </div>
            </td>
        `;
        table_users.appendChild(temp);  
    }
}
getAllUsers();
async function suspendreUser(id) {
    const url = `http://127.0.0.1:8000/api/users/${id}/suspendre`; 
    const cookies = document.cookie.split(';');
    const token = cookies.find(cookie => cookie.trim().startsWith('token='))?.split('=')[1];

    if (!token) {
        console.error("Token not found. User is not authenticated.");
        return;
    }

    try {
        const response = await fetch(url, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const data = await response.json();

        if (data.success) {
            console.log(data.message);
            alert("Utilisateur activé avec succès.");
            getAllUsers();  
        } else {
            alert(data.message || "Une erreur est survenue.");
        }
    } catch (error) {
        console.error("Erreur lors de l'activation de l'utilisateur:", error);
        alert("Une erreur est survenue. Veuillez réessayer.");
    }
}
function actifUser(id) {
    const url = `http://127.0.0.1:8000/api/users/${id}/actif`;  
    const cookies = document.cookie.split(';');
    const token = cookies.find(cookie => cookie.trim().startsWith('token='))?.split('=')[1];

    if (!token) {
        console.error("Token not found. User is not authenticated.");
        return;
    }

    fetch(url, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${token}`
        }
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        } else {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
    })
    .then(data => {
        if (data.success) {
            console.log(data.message);
            alert("Utilisateur activé avec succès.");
            getAllUsers(); 
        } else {
            alert(data.message || "Une erreur est survenue.");
        }
    })
    .catch(error => {
        console.error("Erreur lors de l'activation de l'utilisateur:", error);
        alert("Une erreur est survenue. Veuillez réessayer.");
    });
}