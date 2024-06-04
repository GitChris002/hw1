const form = document.forms['contatti-form'];
const emailInput = form.email;
const erroreDiv = document.querySelector('.errore');



form.addEventListener('submit', function(event) {
    event.preventDefault(); 


    if (!form.checkValidity()) {
        return;
    }

    
    const formData = new FormData(form);
    fetch('contatti.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (!data.success) {
            erroreDiv.innerText = data.message;
            erroreDiv.style.display = 'block';
        } else {
            const nome = formData.get('nome');
            const container = document.querySelector('.form-container');
            const inserisci = document.querySelector('.Inserisci');
            inserisci.style.display = 'none';
            container.style.display = 'none';
            const textDiv = document.querySelector('.text');
            textDiv.querySelector('h1').style.display = 'none';
            const messaggioIscrizione = document.getElementById('messaggio-contattaci');
            messaggioIscrizione.innerText = `Grazie per il messaggio, ${nome}, ti risponderemo al più presto!`;
            messaggioIscrizione.style.display = 'block';
            messaggioIscrizione.style.fontSize='1.6rem';
        }
    })
    .catch(error => {
        console.error('Errore:', error);
    });
});