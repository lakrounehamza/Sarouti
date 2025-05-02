console.log('hi');
myMessage();
function myMessage() {
    const cookies = document.cookie;
    const token = cookies.split(';')[2]?.split('=')[1];
    const id = cookies.split(';')[3]?.split('=')[1];
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
    const cookies = document.cookie;
    const id = cookies.split(';')[3]?.split('=')[1];
    const messages_users = document.getElementById("messages-users");
    messages_users.innerHTML = ''; 

    for (let message of messages) { 
        const isSender = message.sender_id == id;

        messages_users.innerHTML += `
            <div class="px-2 space-y-1">
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
                        <p class="text-sm text-gray-400 truncate">${message.content}</p>
                    </div>
                </div>
            </div>`;
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