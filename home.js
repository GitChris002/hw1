async function fetchSpecialOffers() {
    try {
        const response = await fetch('api_home_content.php');
        if (!response.ok) {
            throw new Error('Errore nella richiesta API');
        }
        const data = await response.json();
        if (data.error) {
            console.error(data.error);
            window.location.href = 'login.php';
            return;
        }
        renderSpecialOffers(data.specialOffers);
    } catch (error) {
        console.error('Error:', error);
    }
}

fetchSpecialOffers();

function renderSpecialOffers(specialOffers) {
    const specialOffersDiv = document.getElementById('specialOffers');
    specialOffersDiv.innerHTML = `<h2>${specialOffers.title}</h2>`;
    const offersList = document.createElement('ul');
    specialOffers.offers.forEach(offer => {
        const listItem = document.createElement('li');
        listItem.innerText = offer;
        offersList.appendChild(listItem);
    });
    specialOffersDiv.appendChild(offersList);
}





document.getElementById('inputUtente').addEventListener('keydown', function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        inviaMessaggioUtente();
    }
});

let conversazione = [
    { role: 'system', content: 'Sei un personal trainer di una palestra chiamata King\'s Fit, devi aiutare l\'utente ad ambientarsi al meglio nel mondo della palestra se è un nuovo iscritto, se invece è iscritto da tanto tempo cerca di aiutarlo in ciò che ti chiede. Se ti viene chiesto un piano di alimentazione o di allenamento chiedi il sesso dell\'utente perchè in base al sesso i piani di alimentazioni e allenamenti variano,ricorda che non sei un dietologo ma puoi comunque offrire consigli o trick,oltre al sesso devi anche chiedere altezza,peso e obbiettivo e regolarti di conseguenza. Se non sai qualcosa riferisci che sarebbe meglio contattare l\'assistenza, ricorda che tu sei l\'assistente virtuale del sito King\'s Fit,ma non sai effettivamente come è strutturato il sito quindi non inventare cose e soprattutto non inventare cose che non sono del settore fitness,alimentazione e palestra,inoltre sii simpatico e non essere troppo duro,ma non esagerare con le emoji, se necessario dai dei messaggi motivazionali ma non esagerare, se ti viene chiesto qualcosa riguardo la musica indica il pulsante in basso a sinistra nella pagina per creare la propria playlist tramite spotify; non scrivere più di 300 caratteri' } 
];

function visualizzaIndicatoreScrittura() {
    const chatMessages = document.getElementById('chatMessages');
    const indicatoreElement = document.createElement('div');
    indicatoreElement.textContent = 'L\'Assistente sta scrivendo...';
    indicatoreElement.classList.add('indicator');
    indicatoreElement.classList.add('indicatore-scrittura');
    chatMessages.appendChild(indicatoreElement);
    chatMessages.scrollTop = chatMessages.scrollHeight;
    indicatoreElement.style.opacity = 0;
    setTimeout(() => indicatoreElement.style.opacity = 1, 300);
    return indicatoreElement;
}

function rimuoviIndicatoreScrittura(indicatoreElement) {
    indicatoreElement.remove();
    setTimeout(() => indicatoreElement.remove(), 300);
}

async function inviaMessaggioUtente() {
    const messaggioUtenteInput = document.getElementById('inputUtente');
    const messaggioUtente = messaggioUtenteInput.value.trim();
    if (messaggioUtente !== '') {
        messaggioUtenteInput.value='';
        visualizzaMessaggioUtente(messaggioUtente);
        conversazione.push({ role: 'user', content: messaggioUtente });
        const indicatoreScrittura = visualizzaIndicatoreScrittura();
        try {
            const response = await inviaMessaggioPHP(conversazione);
            rimuoviIndicatoreScrittura(indicatoreScrittura);
            conversazione.push({ role: 'assistant', content: response });
            visualizzaMessaggioAI(response);
        } catch (error) {
            console.error('Errore durante l\'invio del messaggio:', error);
        }
        document.getElementById('inputUtente').value = '';
    }
}

async function inviaMessaggioPHP(conversazione) {
    try {
        const response = await fetch('invia_messaggio.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({
                'conversazione': JSON.stringify(conversazione)
            })
        });
        if (!response.ok) {
            throw new Error('Errore durante l\'invio del messaggio: ' + response.status);
        }
        const data = await response.json();
        console.log('Messaggio inviato con successo');
        if (data.risposta) {
            return data.risposta;
        } else {
            console.error('Errore nella risposta dell\'AI:', data.errore);
            throw new Error('Errore nella risposta dell\'AI: ' + data.errore);
        }
    } catch (error) {
        throw new Error('Errore durante l\'invio del messaggio: ' + error.message);
    }
}

const chat = document.getElementById('chat');
const chatMessages = document.getElementById('chatMessages');
const indietroButton = document.getElementById('IndietroButton');
const inputUtente = document.getElementById('inputUtente');
const inviaMessaggioButton = document.getElementById('inviaMessaggioButton');

chat.classList.add('hidden');
indietroButton.classList.add('hidden');

const avviaChatButton = document.getElementById('avviaChatButton');

avviaChatButton.addEventListener('click', function() {
    avviaChat();
});

indietroButton.addEventListener('click', function() {
    nascondiChat();
});

inviaMessaggioButton.addEventListener('click', function() {
    inviaMessaggioUtente();
});

function avviaChat() {
    avviaChatButton.classList.add('hidden');
    chat.classList.add('show');
    indietroButton.classList.remove('hidden');
    chat.style.transform = 'translateY(0)';
}

function nascondiChat() {
    avviaChatButton.classList.remove('hidden');
    chat.classList.remove('show');
    indietroButton.classList.add('hidden');
    chat.style.transform = 'translateY(100%)';
}

function visualizzaMessaggioUtente(messaggio) {
    const chatMessages = document.getElementById('chatMessages');
    const messaggioUtenteElement = document.createElement('div');
    messaggioUtenteElement.textContent = messaggio;
    messaggioUtenteElement.classList.add('messaggio-utente');
    chatMessages.appendChild(messaggioUtenteElement);
    chatMessages.scrollTop = chatMessages.scrollHeight;
    messaggioUtenteElement.style.opacity = 0;
    setTimeout(() => messaggioUtenteElement.style.opacity = 1, 100);
}

function visualizzaMessaggioAI(risposta) {
    const messaggioAIElement = document.createElement('div');
    messaggioAIElement.textContent = risposta;
    messaggioAIElement.classList.add('messaggio-ai');
    chatMessages.appendChild(messaggioAIElement);
    chatMessages.scrollTop = chatMessages.scrollHeight;
    messaggioAIElement.style.opacity = 0;
    setTimeout(() => messaggioAIElement.style.opacity = 1, 100);
}




let currentSlide = 1;

function showSlide(slideIndex, direction) {
    const slides = document.querySelectorAll('.Boxabbonamento5, .Boxabbonamento6');
    slides.forEach((slide, index) => {
        slide.classList.remove('slide-in-left', 'slide-in-right', 'slide-out-left', 'slide-out-right');
        
        if (index + 1 === slideIndex) {
            slide.style.display = 'flex';
            slide.style.zIndex = 2; // Portare in primo piano la slide attuale
            if (direction === 'left') {
                slide.classList.add('slide-in-left');
            } else {
                slide.classList.add('slide-in-right');
            }
        } else {
            if (slide.style.display === 'flex') {
                if (direction === 'left') {
                    slide.classList.add('slide-out-left');
                } else {
                    slide.classList.add('slide-out-right');
                }
                slide.style.zIndex = 1; // Mettere in secondo piano la slide uscente
                setTimeout(() => {
                    slide.style.display = 'none';
                    slide.style.opacity = 0;
                }, 400); // Il tempo dell'animazione corrisponde a 400ms
            }
        }
    });
}

function nextSlide() {
    const prevSlide = currentSlide;
    currentSlide = (currentSlide === 2) ? 1 : 2;
    showSlide(currentSlide, 'right');
}

function prevSlide() {
    const prevSlide = currentSlide;
    currentSlide = (currentSlide === 1) ? 2 : 1;
    showSlide(currentSlide, 'left');
}

document.querySelector('.left-arrow').addEventListener('click', prevSlide);
document.querySelector('.right-arrow').addEventListener('click', nextSlide);

showSlide(currentSlide, 'right');




//Modale scopri di più
document.getElementById("scopriButton").addEventListener("click", function() {
    document.getElementById("myModal2").style.display = "block"; 
});

document.getElementsByClassName("close2")[0].addEventListener("click", function() {
    document.getElementById("myModal2").style.display = "none";
});

window.onclick = function(event) {
    if (event.target == document.getElementById("myModal2")) {
        document.getElementById("myModal2").style.display = "none";
    }
}

//modale generali
let generaliLink = document.querySelector('.testoinfo p');
let modal = document.getElementById('modalgenerali');
let closeBtn = document.querySelector('.closegenerali');

generaliLink.addEventListener('click', function() {
    modal.style.display = 'block';
});

closeBtn.addEventListener('click', function() {
    modal.style.display = 'none';
});








