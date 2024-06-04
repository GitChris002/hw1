

const overlay = document.getElementById("overlay");
overlay.addEventListener('click', closeModal);
document.querySelector("#search form").addEventListener("submit", search);

function closeModal(event){
  console.log("Close modal");
  event.currentTarget.classList.add("hidden");
  const card = document.querySelector('.selected');
  card.classList.remove("selected");
  card.classList.remove("unselected");
  card.querySelector('img').classList.remove("img-selected");
  card.querySelector('.canzoneInfo').classList.remove("show");
  card.querySelector('.infoContainer').classList.remove("infoSelected");
  const form = card.querySelector('.saveForm');
  form.classList.remove("hidden");

}

function resizeSong(event){  
  console.log("Resize song");
  const track = event.currentTarget;

  if (!event.currentTarget.classList.contains("selected")){
  overlay.classList.remove("hidden");

  event.currentTarget.classList.remove("unselected");
  event.currentTarget.classList.add("selected");
  event.currentTarget.querySelector('img').classList.add("img-selected"); 
  event.currentTarget.querySelector('.canzoneInfo').classList.add("show");
  event.currentTarget.querySelector('.infoContainer').classList.add("infoSelected");


  const form = event.currentTarget.querySelector('.saveForm');
  form.classList.add("hidden");

} else {
  console.log('already selected');
}
}

  function jsonSpotify(json) {

    console.log(json);
    const container = document.getElementById('results');
    container.innerHTML = '';
    container.className = 'spotify';
    if (!json.tracks.items.length) {noResults(); return;}
    
    for (let track in json.tracks.items) {
        const card = document.createElement('div');
        card.dataset.id = json.tracks.items[track].id;
        card.dataset.title = json.tracks.items[track].name;
        card.dataset.artist = json.tracks.items[track].artists[0].name;
        card.dataset.duration = json.tracks.items[track].duration_ms;
        card.dataset.popularity = json.tracks.items[track].popularity;
        card.dataset.image = json.tracks.items[track].album.images[0].url;
        card.classList.add('track');
        

        const trackInfo = document.createElement('div');
        trackInfo.classList.add('trackInfo');
        card.appendChild(trackInfo);

        const img = document.createElement('img');
        img.src = json.tracks.items[track].album.images[0].url;
        trackInfo.appendChild(img);

        const infoContainer = document.createElement('div');
        infoContainer.classList.add("infoContainer");
        trackInfo.appendChild(infoContainer);

        const info = document.createElement('div');
        info.classList.add("info");
        infoContainer.appendChild(info);

        const name = document.createElement('strong');
        name.innerHTML = json.tracks.items[track].name;
        info.appendChild(name);

        const artist = document.createElement('a');
        artist.innerHTML = json.tracks.items[track].artists[0].name;
        info.appendChild(artist);

        const saveForm = document.createElement('div');
        saveForm.classList.add("saveForm");
        card.appendChild(saveForm);
        const save = document.createElement('div');
        save.value='';
        save.classList.add("save");
        saveForm.appendChild(save);
        //saveForm.addEventListener('submit', saveSong);
        saveForm.addEventListener('click',saveSong );
     
        // info sulle canzoni quando selected
        const canzoneInfo= document.createElement('div');
        canzoneInfo.classList.add("canzoneInfo");
        const popularity = document.createElement('p');
        popularity.innerHTML = 'Popolarità: '+json.tracks.items[track].popularity;
        canzoneInfo.appendChild(popularity);
        const date = document.createElement('p');
        date.innerHTML = 'Data di pubblicazione: '+json.tracks.items[track].album.release_date;
        canzoneInfo.appendChild(date);
        const duration = document.createElement('p');
        const durationMs = json.tracks.items[track].duration_ms;
        const durationMin  = durationMs / 1000 / 60;
        const intPart = parseInt(durationMin, 10);
        const decimalPart = durationMin - intPart;
        const decimalPartRounded =  Math.floor(decimalPart * 100) / 100;
        const trackSec = parseInt((decimalPartRounded * 60), 10);
        duration.classList.add("duration");
        duration.innerHTML = "Durata: "+intPart+" min "+trackSec+" sec";
        canzoneInfo.appendChild(duration);
        card.appendChild(canzoneInfo);


        card.classList.add("unselected");

        card.addEventListener('click', resizeSong);

        container.appendChild(card);
        }
}

function noResults() {

  const container = document.getElementById('results');
  container.innerHTML = '';
  const nores = document.createElement('div');
  nores.className = "loading";
  nores.textContent = "Nessun risultato.";
  container.appendChild(nores);
}


function search(event){
    const form_data = new FormData(document.querySelector("#search form"));
    fetch("search_songs.php?q="+encodeURIComponent(form_data.get('search'))).then(searchResponse).then(jsonSpotify);
    event.preventDefault();
}

function searchResponse(response){
    console.log(response);
    return response.json();
}


function saveSong(event){
  console.log("Salvataggio")
  const card = event.currentTarget.parentNode;
  const formData = new FormData();
  formData.append('id', card.dataset.id);
  formData.append('title', card.dataset.title);
  formData.append('artist', card.dataset.artist);
  formData.append('duration', card.dataset.duration);
  formData.append('popularity', card.dataset.popularity);
  formData.append('image', card.dataset.image);
  fetch("save_songs.php", {method: 'post', body: formData}).then(dispatchResponse, dispatchError);
  event.stopPropagation();
}

function dispatchResponse(response) {

  console.log(response);
  return response.json().then(databaseResponse); 
}

function dispatchError(error) { 
  console.log("Errore");
}

function databaseResponse(json) {
  if (json.ok) {

    const confirmationMessage = document.createElement('div');
    confirmationMessage.textContent = 'La canzone è stata salvata con successo!';
    confirmationMessage.classList.add('confirmation-message');
    document.body.appendChild(confirmationMessage);
    setTimeout(() => {
      confirmationMessage.classList.add('fadeOut');
      confirmationMessage.addEventListener('animationend', () => {
        confirmationMessage.remove();
      });
    }, 3000); 
  } else {
    console.error('Errore durante il salvataggio della canzone');
  }
}

