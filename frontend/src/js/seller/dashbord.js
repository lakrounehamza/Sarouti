// console.log('hi seller');
const buttonAnnonces = document.getElementById("button-annonces");
const buttonDemandes = document.getElementById("button-demandes");
const buttonMessages = document.getElementById("button-messages");
const buttonProfile = document.getElementById("button-profile");
const buttonStatistiques = document.getElementById("button-statistiques");
const buttonDeconnexion = document.getElementById("button-deconnexion");

const containerAnnonces = document.getElementById("container-annonces");
const containerDemandes = document.getElementById("container-domendes");
const containerMessages = document.getElementById("container-messages");
const containerStatistiques = document.getElementById("container-statistic");
const containerProfile = document.getElementById("container-profile");

function switchSection(section) {

    if (section === 'containerAnnonces') {
        localStorage.setItem('dashboardSection', 'annonces');
        containerAnnonces.classList.remove("hidden");
        containerDemandes.classList.add("hidden");
        containerMessages.classList.add("hidden");
        containerStatistiques.classList.add("hidden");
        containerProfile.classList.add("hidden");
    } else if (section === 'containerDemandes') {
        localStorage.setItem('dashboardSection', 'demandes');
        containerAnnonces.classList.add("hidden");
        containerDemandes.classList.remove("hidden");
        containerMessages.classList.add("hidden");
        containerStatistiques.classList.add("hidden");
        containerProfile.classList.add("hidden");
    } else if (section === 'containerMessages') {
        localStorage.setItem('dashboardSection', 'messages');
        containerAnnonces.classList.add("hidden");
        containerDemandes.classList.add("hidden");
        containerMessages.classList.remove("hidden");
        containerStatistiques.classList.add("hidden");
        containerProfile.classList.add("hidden");
    } else if (section === 'containerStatistiques') {
        localStorage.setItem('dashboardSection', 'statistiques');
        
        containerAnnonces.classList.add("hidden");
        containerDemandes.classList.add("hidden");
        containerMessages.classList.add("hidden");
        containerStatistiques.classList.remove("hidden");
        containerProfile.classList.add("hidden");
    } else if (section === 'containerProfile') {
        localStorage.setItem('dashboardSection', 'profile');
        
        containerAnnonces.classList.add("hidden");
        containerDemandes.classList.add("hidden");
        containerMessages.classList.add("hidden");
        containerStatistiques.classList.add("hidden");
        containerProfile.classList.remove("hidden");
    }
}

buttonAnnonces.addEventListener('click', () => {
    switchSection('containerAnnonces');
});
buttonDemandes.addEventListener('click', () => {
    switchSection('containerDemandes');
});
buttonMessages.addEventListener('click', () => {
    switchSection('containerMessages');
});
buttonProfile.addEventListener('click', () => {
    switchSection('containerProfile');
});
buttonStatistiques.addEventListener('click', () => {
    switchSection('containerStatistiques');
});

document.addEventListener('DOMContentLoaded', () => {
    const savedSection = localStorage.getItem('dashboardSection');

    switch (savedSection) {
        case 'annonces':
            switchSection('containerAnnonces');
            break;
        case 'demandes':
            switchSection('containerDemandes');
            break;
        case 'messages':
            switchSection('containerMessages');
            break;
        case 'statistiques':
            switchSection('containerStatistiques');
            break;
        case 'profile':
            switchSection('containerProfile');
            break;
        default:
            switchSection('containerAnnonces');
    }
});
