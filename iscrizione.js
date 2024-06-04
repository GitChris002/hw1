document.addEventListener('DOMContentLoaded', function() {
    // Codice JavaScript per la form di iscrizione
    const form = document.forms['iscrizione-form'];
    const emailInput = form.email;
    const erroreDiv = document.querySelector('.errore');

    function controllaEmail() {
        const email = emailInput.value.trim();
        if (email !== "") {
            fetch('abbonamento.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'check_email=1&email=' + encodeURIComponent(email)
            })
            .then(response => response.json())
            .then(data => {
                if (!data.success) {
                    erroreDiv.innerText = data.message;
                    erroreDiv.style.display = 'block';
                } else {
                    erroreDiv.style.display = 'none';
                    emailInput.setCustomValidity('');
                }
            })
            .catch(error => {
                console.error('Errore:', error);
            });
        }
    }

    emailInput.addEventListener('blur', controllaEmail);

    form.addEventListener('submit', function(event) {
        event.preventDefault(); 

        if (!form.checkValidity()) {
            return;
        }

        const formData = new FormData(form);
        fetch('abbonamento.php', {
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
                const disdettaForm = document.forms['disdetta-form'];
                disdettaForm.style.display = 'block';
                inserisci.style.display = 'none';
                container.style.display = 'none';
                const textDiv = document.querySelector('.text');
                textDiv.querySelector('h2').style.display = 'none';
                messaggioIscrizione.innerText = `Grazie per l'iscrizione, ${nome}!`;
                messaggioIscrizione.style.display = 'block';
                window.scrollTo(0, 0);
            }
        })
        .catch(error => {
            console.error('Errore:', error);
        });
    });

    // Codice JavaScript per la form di disdetta
    const disdettaForm = document.forms['disdetta-form'];
    const disdettaButton = document.querySelector('#disdetta-button');
    const messaggioIscrizione = document.getElementById('messaggio-iscrizione');
    const messaggioDisdetta = document.getElementById('messaggio-disdetta');
    const messaggioDisdettaTesto = document.getElementById('messaggio-disdetta-testo');

    disdettaForm.addEventListener('submit', function(event) {
        event.preventDefault();
        
        const disdettaFormData = new FormData(disdettaForm);
        
        fetch('abbonamento.php', {
            method: 'POST',
            body: disdettaFormData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Disdetta riuscita:', data.message);
                messaggioIscrizione.style.display = 'none';
                messaggioDisdettaTesto.innerText = data.message;
                messaggioDisdetta.style.display= 'block';
                disdettaForm.style.display = 'none';
                window.scrollTo(0, 0);
                mostraFormIscrizione();
            } else {
                console.error('Errore:', data.message);
            }
        })
        .catch(error => {
            console.error('Errore:', error);
        });
    });

    function mostraFormIscrizione() {
        const container = document.querySelector('.form-container');
        const inserisci = document.querySelector('.Inserisci');
        inserisci.style.display='block';
        container.style.display = 'block';
        disdettaForm.style.display = 'none';
    }
});
