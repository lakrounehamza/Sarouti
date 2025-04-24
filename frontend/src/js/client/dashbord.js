// console.log('hi dashboard');
const buttonHome = document.getElementById("button-home");
const buttonDomendes = document.getElementById("button-domendes");
const buttonMessages = document.getElementById("button-messages");
const buttonProfile = document.getElementById("button-profile");
const containerDomendes = document.getElementById("container-domendes");
const containerMessages = document.getElementById("container-messages");
const containerProfile = document.getElementById("container-profile");

function switchSection(section) {
    if (section === containerDomendes) {
        localStorage.setItem('dashboardSection', 'demands');
        containerDomendes.classList.remove("hidden");
        containerMessages.classList.add("hidden");
        containerProfile.classList.add("hidden");
    } else if (section === containerMessages) {
        localStorage.setItem('dashboardSection', 'messages');
        containerDomendes.classList.add("hidden");
        containerMessages.classList.remove("hidden");
        containerProfile.classList.add("hidden");
    } else if (section === containerProfile) {
        localStorage.setItem('dashboardSection', 'profile');
        containerDomendes.classList.add("hidden");
        containerMessages.classList.add("hidden");
        containerProfile.classList.remove("hidden");
    }
}
buttonHome.addEventListener('click', () => {
    switchSection(containerDomendes);
});
buttonDomendes.addEventListener('click', () => {
    switchSection(containerDomendes);
});
buttonMessages.addEventListener('click', () => {
    switchSection(containerMessages);
});
buttonProfile.addEventListener('click', () => {
    switchSection(containerProfile);
});
document.addEventListener('DOMContentLoaded', () => {
    const activeSection = localStorage.getItem('dashboardSection');

    if (activeSection === 'messages') {
        switchSection(containerMessages);
    } else if (activeSection === 'profile') {
        switchSection(containerProfile);
    } else {
        switchSection(containerDomendes);
    }
});
