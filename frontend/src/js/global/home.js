const profile_menu = document.getElementById("profile_menu");
const  button_profile_button = document.getElementById("button_profile_button");
const  connextoin_popup = document.getElementById("connexion_popup"); 
const connexion_button = document.getElementById("connexion_button");
const close_popup_connextion = document.getElementById("close-popup-connexion");
const  Inscription_popup = document.getElementById("Inscription_popup");
const inscription_button = document.getElementById("inscription_button");
const  close_popup_inscription = document.getElementById("close-popup-inscription");
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
inscription_button.addEventListener("click", function (event) {
    event.preventDefault();
    if(Inscription_popup.classList.contains("hidden")){
        Inscription_popup.classList.remove("hidden");
    }else{
        Inscription_popup.classList.add("hidden");
    }       
});
close_popup_inscription.addEventListener("click", function (event) {
    event.preventDefault();
    if(Inscription_popup.classList.contains("hidden")){
        Inscription_popup.classList.remove("hidden");
    }else{
        Inscription_popup.classList.add("hidden");
    }       
});

function getAllAnonces() {
    const url = 'http://127.0.0.1:8000/api/annonces';

    fetch(url, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      }
    }).then(response => response.json())
    .then(data => {
    setAnnonce(data.annonces);
    })
    .catch(error => console.error('Error fetching annonces:', error));
}
function setAnnonce(annonces){
    const annoncesContainer = document.getElementById('annonces-container');

    data.annonces.forEach(annonce => {
      const annonceElement = document.createElement('div');
      annonceElement.className = 'bg-white overflow-hidden';

      // console.log("image = " + annonce.images[0].path);

      annonceElement.innerHTML = `
      <div class="relative h-60"> 
        <a href="/frontend/views/client/details.html?${annonce.id}" class="absolute inset-0">
        <div id="carousel-${annonce.id}" class="relative w-full h-full overflow-hidden" >
          <div class="flex transition-all duration-500 ease-in-out" id="carousel-images-${annonce.id}">
            ${annonce.images.map((image, index) => {
        return `
                <img src="../../../backend/public/storage/${image.path}" 
                     class="w-full border-[1px] rounded-[20px] h-60 object-cover" 
                     alt="Image ${index + 1}" />
              `;
      }).join('')}
          </div>

          <!-- Carousel Navigation -->
          <button id="prev-${annonce.id}" class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-black/50 p-2 rounded-full hover:shadow-md">
            <img src="../../assets/images/icon/angle-left-solid.svg" alt="Previous" class="w-6 h-6" />
          </button>
          <button id="next-${annonce.id}" class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-black/50 p-2 rounded-full hover:shadow-md">
            <img src="../../assets/images/icon/angle-right-solid.svg" alt="Next" class="w-6 h-6" />
          </button>

          <!-- Indicators -->
          <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-1" id="indicators-${annonce.id}">
            ${annonce.images.map((_, index) => {
        return `<div class="w-2 h-2 rounded-full ${index === 0 ? 'bg-white' : 'bg-white/50'}" data-index="${index}"></div>`;
      }).join('')}
          </div>
        </div>
        </a>
      </div>

      <div class="p-4">
        <div class="flex justify-between items-center">
          <h3 class="text-lg font-semibold">${annonce.title}</h3>
          <div class="flex items-center">
            <img src="../../assets/images/icon/Star.png" alt="Star" class="w-4 h-4 mr-1" />
            <span>${annonce.rating}</span>
          </div>
        </div>
        <p class="text-gray-500">${annonce.type}</p>
        <p class="text-gray-500">${annonce.date}</p>
        <p class="font-semibold mt-1">${annonce.price} DH</p>

      </div>
    `;

      annoncesContainer.appendChild(annonceElement);
  
    });
}
