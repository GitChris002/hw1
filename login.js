function validazione(event) {
    // Verifica se tutti i campi sono riempiti
    if (
        form.username.value.length == 0 ||
        form.password.value.length == 0 ||
        form.telefono.value.length == 0 ||
        form.nome.value.length == 0 ||
        form.cognome.value.length == 0
    ) {
        // Avvisa utente
        // (meglio con div nascosto)
        alert("Compilare tutti i campi.");
        // Blocca l'invio del form
        event.preventDefault();
    }
}

// Riferimento al form
const form = document.forms['nome-form'];
// Aggiungi listener
form.addEventListener('submit', validazione);
