console.log('hi');
myMessage();
function myMessage() {
    const cookies = document.cookie.split(';');
    const id = cookies.find(cookie => cookie.trim().startsWith('user_id='))?.split('=')[1];
    const token = cookies.find(cookie => cookie.trim().startsWith('token='))?.split('=')[1];
    // console.log(id); 
    const url = `http://127.0.0.1:8000/api/messages/user/${id}`;
    const xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("Authorization", `Bearer ${token}`);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                messages = data;
                sectionMessages(messages);
                console.log(messages);
            } else {
                console.error(`Erreur HTTP ${xhr.status}: ${xhr.statusText}`);
                alert(`Erreur  : ${xhr.statusText}`);
            }
        }
    };

    xhr.onerror = function () {
        console.error("Erreur !!!.");
    };

    xhr.send();
}
function sectionMessages(messages) {
    const cookies = document.cookie.split(';');
    const id = cookies.find(cookie => cookie.trim().startsWith('user_id='))?.split('=')[1];
    const messages_users = document.getElementById("messages-users");
    messages_users.innerHTML = '';

    for (let message of messages) {
        const isSender = message.sender_id == id;

        messages_users.innerHTML += `
            <button class="px-2 space-y-1"  onclick="detaileMessage(${isSender ? message.receiver_id : message.sender_id})">
                <div class="p-3 rounded-xl hover:bg-gray-800 flex items-center gap-3">
                    <div class="w-12 h-12 rounded-xl overflow-hidden">
                        <img src="http://127.0.0.1:8000/${isSender ? message.receiver_photo : message.sender_photo}" 
                             alt="Utilisateur" 
                             class="w-full h-full object-cover" />
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <h3 class="font-semibold">${isSender ? message.receiver_name : message.sender_name}</h3>
                            <span class="text-xs text-gray-400">${timeAgo(new Date(message.created_at))}</span>
                        </div>
                        <p class="text-sm text-gray-400 truncate">${message.content.substring(0, 20)}${message.content.length > 20 ? '...' : ''}</p>
                    </div>
                </div>
            </button>`;
    }
}
function timeAgo(date) {
    const now = new Date();
    const diff = Math.floor((now - date) / 1000);

    if (diff < 60) {
        return `${diff}s`;
    } else if (diff < 3600) {
        return `${Math.floor(diff / 60)}m`;
    } else if (diff < 86400) {
        return `${Math.floor(diff / 3600)}h`;
    } else {
        return `${Math.floor(diff / 86400)}d`;
    }
}
function detaileMessage(id_user) {
    const cookies = document.cookie.split(';');
    const token = cookies.find(cookie => cookie.trim().startsWith('token='))?.split('=')[1];
    const id = cookies.find(cookie => cookie.trim().startsWith('user_id='))?.split('=')[1];

    const url = "http://127.0.0.1:8000/api/messages/detaile";
    const body = JSON.stringify({
        sender_id: id,
        receiver_id: id_user
    });

    const xhr = new XMLHttpRequest();
    xhr.open("POST", url, true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.setRequestHeader("Authorization", `Bearer ${token}`);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                const data = JSON.parse(xhr.responseText);
                console.log("Messages reçus :", data);
                sectionMessage(data);
            }
        }
    };

    xhr.onerror = function () {
        console.error("Erreur");
    };
    xhr.send(body);
}
function sectionMessage(messages) {
    const container = document.getElementById('message-byUser');
    const cookies = document.cookie.split(';');
    const id = cookies.find(cookie => cookie.trim().startsWith('user_id='))?.split('=')[1];

    const isSender = messages[0].sender_id == id;
    const id_user = isSender ? messages[0].receiver_id : messages[0].sender_id;
    container.innerHTML = `
        <header class="p-4 border-b border-gray-800 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <h1 class="text-xl font-bold"> ${isSender ? messages[0].receiver_name : messages[0].sender_name}</h1>         
                <span class="text-sm text-gray-400"></span>
            </div>
            <div class="flex items-center gap-4">
                <button class="w-10 h-10 rounded-xl bg-gray-800 flex items-center justify-center text-primary">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </button>
            </div>
        </header>
        <div class="flex-1 overflow-y-auto p-4 space-y-6">
        </div>
        <footer class="p-4 border-t border-gray-800">
            <div class="flex items-center gap-2 bg-gray-800 rounded-xl p-2">
                <button class="p-2 hover:bg-gray-700 rounded-lg text-primary" >
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                    </svg>
                </button>
                <input type="text" placeholder="Votre message" id="input-message"
                    class="flex-1 bg-transparent focus:outline-none text-gray-100 placeholder-gray-400" />
                <button class="p-2 hover:bg-gray-700 rounded-lg text-primary">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z" />
                    </svg>
                </button>
                <button class="p-2 hover:bg-gray-700 rounded-lg text-primary" onclick=sendeMessage(${id_user})>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </button>
            </div>
        </footer>
    `;
    const messagesContainer = container.querySelector('.flex-1.overflow-y-auto.p-4.space-y-6');
    messages.forEach(message => {
        const isSender = message.sender_id === parseInt(document.cookie.split(';').find(cookie => cookie.trim().startsWith('user_id=')).split('=')[1]);

        const messageHTML = `
            <div class="flex gap-4 max-w-2xl ${isSender ? 'ml-auto' : ''}">
                <div class="flex-1">
                    <div class="flex items-center ${isSender ? 'justify-end' : ''} gap-2 mb-1">
                        ${isSender ? '<span class="font-semibold">Vous</span>' : ''}
                        <span class="text-xs text-gray-400">${new Date(message.created_at).toLocaleTimeString()}</span>
                    </div>
                    <div class="${isSender ? 'bg-primary bg-opacity-20' : 'bg-gray-800'} rounded-xl p-4">
                        <p>${message.content}</p>
                    </div>
                </div>
            </div>
        `;

        messagesContainer.innerHTML += messageHTML;
    });
}
function sendeMessage(id_user) { 
    const cookies = document.cookie.split(';');
    const id = cookies.find(cookie => cookie.trim().startsWith('user_id='))?.split('=')[1];
    const token = cookies.find(cookie => cookie.trim().startsWith('token='))?.split('=')[1];
 
    const content = document.getElementById('input-message').value.trim();
    const url = "http://127.0.0.1:8000/api/messages";
    const body = JSON.stringify({
        content: content,
        receiver_id: id_user,
        sender_id: id
    });
    fetch(url, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": `Bearer ${token}`
        },
        body: body
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erreur HTTP ${response.status}: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            document.getElementById('input-message').value = '';
            detaileMessage(id_user);
        })
        .catch(error => {
            alert(`Erreur : ${error.message}`);
        });
}
document.getElementById('search-messages').addEventListener('input', function (e) {
    const searchTerm = e.target.value.toLowerCase();
    filterMessages(searchTerm);
});

function filterMessages(searchTerm) {
    const messages = document.querySelectorAll('#messages-users button');
    messages.forEach(message => {
        const messageContent = message.querySelector('p').textContent.toLowerCase();
        const messageSender = message.querySelector('h3').textContent.toLowerCase();
        if (messageContent.includes(searchTerm) || messageSender.includes(searchTerm)) {
            message.style.display = 'block';
        } else {
            message.style.display = 'none';
        }
    });
}
