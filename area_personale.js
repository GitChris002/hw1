const overlay = document.getElementById("overlay");
overlay.addEventListener('click', closeModal);

function closeModal(event){
  console.log("Close modal");
  event.currentTarget.classList.add("hidden");
  const card = document.querySelector('.selected');
  card.classList.remove("selected");
  card.classList.remove("unselected");
  card.querySelector('img').classList.remove("img-selected");
  card.querySelector('.canzoneInfo').classList.remove("show");
  card.querySelector('.infoContainer').classList.remove("infoSelected");
  const form = card.querySelector('.removeForm');
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

    const form = event.currentTarget.querySelector('.removeForm');
    form.classList.add("hidden");

  } else {
    console.log('already selected');
  }
}


function fetchSongs() {
  fetch("fetch_song.php").then(fetchResponse).then(fetchSongsJson);
}


function fetchResponse(response) {
  if (!response.ok) {return null};
  return response.json();
}

function fetchSongsJson(json) {
    console.log("Fetching...");
    console.log(json);
    if (!json.length) { noResults(); return; }

    const container = document.getElementById('results');
    container.innerHTML = '';
    container.className = 'spotify';
    if (!json.length) { noResults(); return; } 

    json.forEach(song => { 
        const card = document.createElement('div');
        card.dataset.id = song.songid; 
        card.dataset.title = song.content.title; 
        card.dataset.artist = song.content.artist; 
        card.dataset.duration = song.content.duration; 
        card.dataset.popularity = song.content.popularity; 
        card.dataset.image = song.content.image; 
        card.classList.add('track');
        const trackInfo = document.createElement('div');
        trackInfo.classList.add('trackInfo');
        card.appendChild(trackInfo);

        const img = document.createElement('img');
        img.src = song.content.image; 
        trackInfo.appendChild(img);

        const infoContainer = document.createElement('div');
        infoContainer.classList.add('infoContainer');
        trackInfo.appendChild(infoContainer);

        const info = document.createElement('div');
        info.classList.add('info');
        infoContainer.appendChild(info);

        const name = document.createElement('h2');
        name.innerHTML = song.content.title; 
        info.appendChild(name);

        const artist = document.createElement('p');
        artist.innerHTML = song.content.artist; 
        info.appendChild(artist);

        
        const removeForm = document.createElement('div');
        removeForm.classList.add("removeForm");
        card.appendChild(removeForm);

        const remove = document.createElement('div');
        remove.classList.add("remove");
        removeForm.appendChild(remove);

        
        const canzoneInfo = document.createElement('div');
        canzoneInfo.classList.add("canzoneInfo");
        const popularity = document.createElement('p');
        popularity.innerHTML = 'Popolarità: ' + song.content.popularity; 
        canzoneInfo.appendChild(popularity);

       
        const duration = document.createElement('p');
        const durationMs = parseInt(song.content.duration);
        const durationMin = Math.floor(durationMs / 60000);
        const durationSec = Math.floor((durationMs % 60000) / 1000);
        duration.innerHTML = `Durata: ${durationMin} min ${durationSec} sec`; 
        canzoneInfo.appendChild(duration);
        card.appendChild(canzoneInfo);

        card.classList.add("unselected");

        card.addEventListener('click', resizeSong);

        removeForm.addEventListener('click', removeSong);
        container.appendChild(card);
    });
}

function removeSong(event) {
    console.log("Rimozione");
    const card = event.currentTarget.parentNode;
    const formData = new FormData();
    formData.append('id', card.dataset.id);

    fetch("remove_songs.php", 
    { 
        method: 'post', 
        body: formData 
    })
    .then(dispatchResponse)
    .catch(dispatchError);

    event.stopPropagation();
}

function dispatchResponse(response) {
    console.log('Response:', response);
    if (!response.ok) {
        console.error('Error in response:', response.statusText);
        return;
    }
    
    response.json().then(data => {
        if (data.success) {
            console.log('Canzone eliminata dai favoriti con successo.');
            document.querySelector(`div[data-id='${data.id}']`).remove();
        } else {
            console.error('Errore nella rimozione dei favoriti.');
        }
    }).catch(error => {
        console.error('Errore:', error);
    });
}

function dispatchError(error) {
    console.error('Error:', error);
}



function noResults() {
    const container = document.getElementById('results');
    container.innerHTML = '';
    const nores = document.createElement('div');
    nores.className = "nores";
    nores.textContent = "Nessun risultato.";
    container.appendChild(nores);
  }



fetchSongs();