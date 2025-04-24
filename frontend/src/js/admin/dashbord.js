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
// RolesButton  signalementsButton categorysButton demandesButton annoncesButton statistiquesButton notificationsButton
// usersContainer  rolesContainer signalementsContainer categorysContainer demandesContainer notificationsContainer
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
    // usersContainer  rolesContainer signalementsContainer categorysContainer demandesContainer notificationsContainer

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
