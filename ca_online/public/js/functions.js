// const appBaseName = '';
// const baseUrl = window.location.origin;
// const baseOfUrl = baseUrl;

const appBaseName = 'projects/ca_online';
const baseUrl = window.location.origin;
const baseOfUrl = appBaseName != "" ? `${baseUrl}/${appBaseName}` : `${baseUrl}`;

// ---------------------------------


function startCountdown(elementId, endDate) {
    let endTime = new Date(endDate).getTime();
    const timeContainer = document.getElementById(elementId);

    function updateCountdown() {
        let now = new Date().getTime();
        let timeLeft = endTime - now;

        if (timeLeft < 0) {
            clearInterval(interval);
            timeContainer.innerHTML = 'Temps écoulé';

            const room = timeContainer.closest('.room');
            const roomName = room.getAttribute('data-room');
            const startTime = room.getAttribute('data-start');
            const endTime = room.getAttribute('data-end');
            elapsedNotifications('#timeElapsedModal .notifs', startTime, endTime, roomName);
            playNotificationSound();
            setTimeout(() => {
                room.remove();
            }, 10000);

            return;
        }

        let hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        seconds = seconds < 10 ? '0' + seconds : seconds;

        // Changer la couleur du texte si le temps restant est inférieur ou égale à 10 minutes
        let countdownElement = timeContainer;

        if (timeLeft < 10 * 60 * 1000) { // Moins de 10 minutes
            countdownElement.style.color = 'red';
        } else {
            countdownElement.style.color = 'black';
        }

        timeContainer.innerHTML = `${hours}:${minutes}:${seconds}`;
    }

    let interval = setInterval(updateCountdown, 1000);
    updateCountdown(); // Call it once to avoid initial delay
}



// const enTime = `${hours}:${minutes}:${seconds}`;
// const room = elementId.closest('.room');
// const startTime = room.getAttribute('data-start');
// elapsedNotifications('#timeElapsedModal .notifs', startTime, enTime, room)


// Fonction pour afficher une modal
function showModal(elementId) {
    const modal = document.querySelector(elementId);
    modal.classList.add('active');
}

// Fonction pour cacher une modal
function dismissModal(elementId) {
    const modal = document.querySelector(elementId);
    modal.classList.remove('active');
}


// Ajouter la notification du temps écoulé
function elapsedNotifications(containerId, startTime, endDate, room) {
    const row = document.createElement('div');
    row.classList.add('notif');
    row.innerHTML = `<p><strong>${room}</strong> : Temps écoulé</p>
                        <small>${startTime} - ${endDate}</small>`;
    document.querySelector(containerId).prepend(row);
    showModal('#timeElapsedModal');
}

let audio = null; // Déclarer la variable en dehors de la fonction pour qu'elle soit accessible

function playNotificationSound() {
    // Vérifier s'il y a déjà un audio en cours de lecture et l'arrêter
    if (audio && !audio.paused) {
        audio.pause();
        audio.currentTime = 0; // Remettre le son au début
    }

    // Créer un nouvel élément audio
    audio = new Audio('public/audio/simple-notification-152054.mp3');
    // Jouer le son
    audio.play();
}


function manageOptionContainer(targetId, parentId) {
    const select = document.querySelector(targetId);
    const optionContainer = document.querySelector(parentId + ' .optional-container');
    const activeOption = document.querySelector(parentId + ' .optional-container.active');
    if (activeOption) activeOption.classList.remove('active')

    if (select.value != "") {
        document.querySelector(parentId + ' .optional-container#' + select.value).classList.add('active')
    } else {
        optionContainer.classList.remove('active');
    }
}





function incrementHours(startInputId, endInputId, nbInputId) {
    // startInputId et endInputId sont des input type time
    // nbInputId est un input number
    const startInput = document.querySelector(startInputId);
    const endInput = document.querySelector(endInputId);
    const nbInput = document.querySelector(nbInputId);

    if (startInput.value === "" || nbInput.value === "") {
        return;
    }

    const time = startInput.value;
    // Séparer les heures et les minutes
    let [hours, minutes] = time.split(':').map(Number);

    // Ajouter les heures spécifiées par l'utilisateur
    let additionalHours = parseInt(nbInput.value, 10);
    hours += additionalHours;

    // Ajuster si les heures dépassent 23 ou sont négatives
    while (hours >= 24) {
        hours -= 24;
    }
    while (hours < 0) {
        hours += 24;
    }

    // Formater les heures et les minutes avec deux chiffres
    hours = hours < 10 ? '0' + hours : hours;
    minutes = minutes < 10 ? '0' + minutes : minutes;

    // Afficher le résultat
    const newTime = `${hours}:${minutes}`;
    endInput.value = newTime;
    // console.log(newTime);
    // return newTime;
}



function incrementDays(startInputId, endInputId, nbInputId) {
    // startInputId et endInputId sont des inputs de type datetime-local
    // nbInputId est un input de type number
    const startInput = document.querySelector(startInputId);
    const endInput = document.querySelector(endInputId);
    const nbInput = document.querySelector(nbInputId);

    if (startInput.value === "" || nbInput.value === "") {
        return;
    }

    // Récupérer et analyser la date et heure de début
    const startDateTime = new Date(startInput.value);

    // Récupérer le nombre de jours à ajouter
    const additionalDays = parseInt(nbInput.value, 10);

    // Ajouter le nombre de jours
    startDateTime.setDate(startDateTime.getDate() + additionalDays);

    // Formater la nouvelle date et heure au format datetime-local
    const year = startDateTime.getFullYear();
    const month = (startDateTime.getMonth() + 1).toString().padStart(2, '0'); // Les mois sont indexés à partir de 0
    const day = startDateTime.getDate().toString().padStart(2, '0');
    const hours = startDateTime.getHours().toString().padStart(2, '0');
    const minutes = startDateTime.getMinutes().toString().padStart(2, '0');

    const newDateTime = `${year}-${month}-${day}T${hours}:${minutes}`;

    // Afficher le résultat
    endInput.value = newDateTime;
    // console.log(newDateTime);
    // return newDateTime;
}



function selectRoom(eventTarget, receiverInputId){

    const target = eventTarget.closest('.room');

    const roomId = target.getAttribute('data-id');
    const roomName = target.getAttribute('data-name');
    const roomPassPrice = target.getAttribute('data-pass-price');
    const roomNuiteePrice = target.getAttribute('data-sejour-price');

    const receiverInput = document.querySelector(receiverInputId);
    const receiver = document.querySelector('#roomReceiver');
    
    receiverInput.value = roomId;
    receiverInput.setAttribute('data-pass-price', roomPassPrice);
    receiverInput.setAttribute('data-sejour-price', roomNuiteePrice);

    receiver.innerHTML = `${roomName} <small>(Passage : ${roomPassPrice} / Nuitée : ${roomNuiteePrice})</small>`;

    calculAmount();

    dismissModal('#roomsModal');

}


// Afficher l'heure actuelle dans un input time
function setCurrentTime(inputId) {
    const now = new Date();
    let hours = now.getHours();
    let minutes = now.getMinutes();

    // Ajouter un 0 inférieur à 10
     hours = hours < 10 ? '0'+hours : hours;
     minutes = minutes < 10 ? '0'+minutes : minutes;

    //  Définir la valeur de l'input
    const timeString = hours+':'+minutes;
     document.querySelector(inputId).value = timeString;
}

// Calcul des montant
function calculAmount(){
    const amountToPaid = document.querySelector('#amount-to-paid');
    const paymentAmount = document.querySelector('#payment-amount');
    const remained = document.querySelector('#remained');

    const type = document.querySelector('#reservation-sejour');
    
    const inputRoom = document.querySelector('input#room');
    const roomPassAmount = inputRoom.getAttribute('data-pass-price');
    const roomSejourAmount = inputRoom.getAttribute('data-sejour-price');

    // console.log(roomPassAmount);
    // // console.log(inputRoom);
    // console.log(roomSejourAmount);
    
    if(inputRoom.value != ""){
        const nbHours = document.querySelector('#reserve-hours');
        const nbNuitees = document.querySelector('#nuitees');
        const amount = type.value == "passage" ? Number(roomPassAmount) * Number(nbHours.value) : Number(roomSejourAmount) * Number(nbNuitees.value);

        remained.value = amount - paymentAmount.value;

        amountToPaid.value = amount;
    }else{
        amountToPaid.value = 0;
        remained.value = 0;
    }

    if(remained.value > 0){
        remained.style.color = 'red';
        remained.style.fontWeight = 'bold';
    }else{
        remained.style.color = 'black';
        remained.style.fontWeight = 'normal';
    }
}



// Générer un mot de passe
function generatePassword(length, receiverInputId){
    
    const uppercaseChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const lowercaseChars = 'abcdefghijklmnopqrstuvwxyz';
    const numericChars = '0123456789';
    const specialChars = '!@#%^&*()_+[]{}|;:,.<>?';

    const allChars = uppercaseChars + lowercaseChars + numericChars + specialChars;
    let password = '';

    for (let i = 0; i < length; i++) {
        const randomIndex = Math.floor(Math.random() * allChars.length);
        password += allChars[randomIndex];
    }
    document.querySelector(receiverInputId).value = password;
    // return password;
}


// Toogle expand element
function toggleRecap(target){
    const recap = document.querySelector('.recap');
    recap.classList.toggle('reduce');
    if(recap.classList.contains('reduce')){
        localStorage.setItem('recap', 'reduce');
        target.innerHTML = '<span class="material-symbols-outlined">expand_more</span>Afficher';
    }else{        
        target.innerHTML = '<span class="material-symbols-outlined">expand_less</span>Réduire';        
        localStorage.setItem('recap', '');
    }
    
}