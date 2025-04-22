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
const buttonAddAnnonce = document.getElementById("button-add-annonce");
const popapAddAnnonce = document.getElementById("popap-add-annonces");
const buttonFermeAddAnnonce = document.getElementById("ferme-popap-annonce");

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

buttonAddAnnonce.addEventListener('click', () => {
    popapAddAnnonce.classList.toggle('hidden');
});
buttonFermeAddAnnonce.addEventListener('click', () => {
    popapAddAnnonce.classList.toggle('hidden');
});

document.addEventListener("DOMContentLoaded", function () {
    const map = L.map('map').setView([31.7917, -7.0926], 6);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

    let marker;

    map.on('click', function (e) {
        const { lat, lng } = e.latlng;
        if (marker) {
            marker.setLatLng([lat, lng]);
        } else {
            marker = L.marker([lat, lng]).addTo(map);
        }
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    });

    const output = document.querySelector("output");
    const input = document.querySelector("input[type='file']");
    let imagesArray = [];

    input.addEventListener("change", () => {
        const files = Array.from(input.files);
        imagesArray.push(...files);
        displayImages();
    });
    window.deleteImage = function (index) {
        imagesArray.splice(index, 1);
        displayImages();
    }
    function displayImages() {
        output.innerHTML = imagesArray.map((image, index) => `
            <div class="image relative inline-block mr-2 mb-2">
                <img src="${URL.createObjectURL(image)}" class="w-20 h-20 object-cover rounded border" alt="image">
                <span onclick="deleteImage(${index})" class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center cursor-pointer">&times;</span>
            </div>
        `).join("");
    }
    const form = document.getElementById('add-annonce-form');
    form.addEventListener('submit', async function (event) {
        event.preventDefault();
        const formData = new FormData(form);
        imagesArray.forEach((file) => {
            formData.append('images[]', file);
        });
        try {
            const response = await fetch("http://127.0.0.1:8000/api/annonces", {
                method: "POST",
                body: formData
            });

            const result = await response.json();

            if (response.ok) {
                alert("Annonce créée avec succès !");
                form.reset();
                output.innerHTML = '';
                marker?.remove();
                imagesArray = [];
            } else {
                console.error(result);
                alert("Erreur lors de la création de l'annonce.");
            }
        } catch (error) {
            console.error(error);
            alert("Une erreur est survenue.");
        }
    });
    document.getElementById('ferme-popap-annonce').addEventListener('click', () => {
        document.getElementById('popap-add-annonces').classList.add('hidden');
    });
});
document.addEventListener('DOMContentLoaded', function () {
    const mapElement = document.getElementById('map');
    if (mapElement) {
        const map = L.map('map').setView([31.7917, -7.0926], 6);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        }).addTo(map);

        let marker;
        const latitudeInput = document.getElementById('latitude');
        const longitudeInput = document.getElementById('longitude');
        const coordsDisplay = document.getElementById('coords-display');

        map.on('click', function (e) {
            const { lat, lng } = e.latlng;
            if (marker) {
                marker.setLatLng([lat, lng]);
            } else {
                marker = L.marker([lat, lng]).addTo(map);
            }

            if (latitudeInput) latitudeInput.value = lat;
            if (longitudeInput) longitudeInput.value = lng;

            if (coordsDisplay) {
                coordsDisplay.textContent = `Position sélectionnée: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
                coordsDisplay.style.display = 'block';
            }

            console.log("Latitude:", lat, "Longitude:", lng);
        });
    }
    const output = document.querySelector("output");
    const input = document.querySelector("input[type='file']");
    let imagesArray = [];
    const MAX_IMAGES = 5;

    if (input && output) {
        input.addEventListener("change", () => {
            const files = input.files;

            if (imagesArray.length + files.length > MAX_IMAGES) {
                alert(`Vous ne pouvez pas télécharger plus de ${MAX_IMAGES} images.`);
                return;
            }

            for (let i = 0; i < files.length; i++) {
                if (!files[i].type.startsWith("image/")) {
                    alert(`Le fichier "${files[i].name}" n'est pas une image valide.`);
                    continue;
                }

                if (files[i].size > 2 * 1024 * 1024) {
                    alert(`L'image "${files[i].name}" dépasse la taille maximale de 2 MB.`);
                    continue;
                }

                imagesArray.push(files[i]);
            }
            displayImages();
        });
    }

    function displayImages() {
        if (!output) return;

        let images = "";
        imagesArray.forEach((image, index) => {
            images += `
   <div class="image">
     <img src="${URL.createObjectURL(image)}" alt="image">
     <span onclick="deleteImage(${index})" title="Supprimer cette image">&times;</span>
   </div>`;
        });
        output.innerHTML = images;
    }

    window.deleteImage = function (index) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cette image ?")) {
            imagesArray.splice(index, 1);
            displayImages();
        }
    };

    const form = document.getElementById('add-annonce-form');
    const loadingIndicator = document.getElementById('loading-indicator');

    if (form) {
        form.addEventListener('submit', async function (event) {
            event.preventDefault();
            if (loadingIndicator) loadingIndicator.style.display = 'block';

            const formData = new FormData(form);
            imagesArray.forEach((file) => {
                formData.append('images[]', file);
            });

            try {
                const response = await fetch("http://127.0.0.1:8000/api/annonces", {
                    method: "POST",
                    body: formData,
                });

                if (!response.ok) {
                    const contentType = response.headers.get("content-type");
                    if (contentType && contentType.includes("application/json")) {
                        const errorData = await response.json();
                        if (errorData.errors) {
                            let errorMessage = "Erreurs de validation:\n";
                            for (const [field, messages] of Object.entries(errorData.errors)) {
                                errorMessage += `- ${field}: ${messages.join(', ')}\n`;
                            }
                            alert(errorMessage);
                        } else {
                            alert(errorData.message || "Erreur lors de la création de l'annonce.");
                        }
                    } else {
                        alert(`Erreur serveur: ${response.status}`);
                    }
                } else {
                    const result = await response.json();
                    alert("Annonce créée avec succès !");

                    form.reset();
                    imagesArray = [];
                    if (output) output.innerHTML = '';

                    if (typeof marker !== 'undefined' && marker) {
                        marker.remove();
                        marker = null;
                    }
                }
            } catch (error) {
                console.error("Erreur:", error);
                alert("Une erreur est survenue lors de la communication avec le serveur.");
            }
        });
    }
});
async function getAllMyAnnonce() {
    const cookies = document.cookie;
    const token = cookies.split(';')[2].split('=')[1];
    const id = cookies.split(';')[3].split('=')[1];
    console.log("id = " + id);

    const url = "http://127.0.0.1:8000/api/annonces/seller/" + id;
    try {
        const response = await fetch(url, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                "Authorization": `Bearer ${token}`
            }
        });

        if (!response.ok) {
            console.error("Erreur lors de la récupération des annonces :", response.statusText);
            return;
        }

        const data = await response.json();
        console.log("Réponse API :", data);

        if (!Array.isArray(data.annonces)) {
            console.error("Format de données inattendu :", data);
            return;
        }

        setAnnonce(data.annonces);

    } catch (error) {
        console.error("Erreur lors de la requête API :", error);
    }
}

function setAnnonce(annonces) {
    const annoncesContainer = document.getElementById('annonces-container-seller');
    annoncesContainer.innerHTML = '';  

    annonces.forEach(annonce => {
                const imagePath = annonce.image && annonce.image.path 

        console.log(imagePath);
        const annonceElement = document.createElement('div');
        annonceElement.className = 'bg-white shadow-md rounded-lg overflow-hidden';
        
        annonceElement.innerHTML = `
            <div class="relative h-48">
                <img src="http://127.0.0.1:8000/storage/${imagePath}" 
                     class="w-full h-full object-cover" 
                     alt="${annonce.title}">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold">${annonce.title}</h3>
                <p class="text-gray-500">${annonce.type}</p>
                <p class="text-gray-500">${annonce.date}</p>
                <p class="font-semibold mt-2">${annonce.price} DH</p>
                <a href="/frontend/views/client/details.html?${annonce.id}" 
                   class="text-blue-500 hover:underline mt-2 block">Voir les détails</a>
            </div>
        `;

        annoncesContainer.appendChild(annonceElement);
    });
}

 getAllMyAnnonce();
