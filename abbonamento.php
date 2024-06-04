<?php
session_start();

// Controlla se è stata inviata una richiesta di controllo dell'email
if (isset($_POST["check_email"]) && isset($_POST["email"])) {
    // Connessione al database
    $conn = mysqli_connect("localhost", "root", "", "homework1");
    if (!$conn) {
        echo json_encode(['success' => false, 'message' => 'Connessione al database fallita: ' . mysqli_connect_error()]);
        exit;
    }

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $check_query = "SELECT * FROM iscrizioni WHERE email = '$email'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['success' => false, 'message' => 'Email già registrata. Utilizza un\'altra email.']);
    } else {
        echo json_encode(['success' => true, 'message' => 'Email disponibile.']);
    }
    exit;
}

// Controlla se l'utente è autenticato
if (!isset($_SESSION["username"])) {
    echo json_encode(['success' => false, 'message' => 'Utente non autenticato.']);
    exit;
}

// Connessione al database
$conn = mysqli_connect("localhost", "root", "", "homework1");
if (!$conn) {
    echo json_encode(['success' => false, 'message' => 'Connessione al database fallita: ' . mysqli_connect_error()]);
    exit;
}

// Ottieni l'ID dell'utente
$username = $_SESSION["username"];
$fetch_user_id_query = "SELECT id FROM utenti WHERE username = '$username'";
$user_id_result = mysqli_query($conn, $fetch_user_id_query);

if ($user_id_row = mysqli_fetch_assoc($user_id_result)) {
    $user_id = $user_id_row['id'];
} else {
    echo json_encode(['success' => false, 'message' => 'Utente non trovato.']);
    mysqli_close($conn);
    exit;
}

// Controlla se l'utente è già iscritto
$check_query = "SELECT * FROM iscrizioni WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $check_query);
$_SESSION['already_subscribed'] = mysqli_num_rows($result) > 0;
$tipo_abbonamento = ''; // Inizializza la variabile


// Se l'utente è già iscritto, procedi con la disdetta
if ($_SESSION['already_subscribed'] && isset($_POST['disdetta'])) {
    $delete_query = "DELETE FROM iscrizioni WHERE user_id = '$user_id'";
    if (mysqli_query($conn, $delete_query)) {
        echo json_encode(['success' => true, 'message' => 'Disdetta effettuata con successo!']);
        unset($_SESSION['already_subscribed']);
        // Unsetta solo se è stata precedentemente impostata
       
    } else {
        echo json_encode(['success' => false, 'message' => 'Errore durante la disdetta: ' . mysqli_error($conn)]);
    }
    mysqli_close($conn);
    exit;
}

// Se non è stata inviata una richiesta di disdetta, procedi con l'iscrizione
if (isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["email"]) && isset($_POST["telefono"]) && isset($_POST["tipo_abbonamento"]) && isset($_POST["data_inizio"])) {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $tipo_abbonamento = mysqli_real_escape_string($conn, $_POST['tipo_abbonamento']);
    $data_inizio = mysqli_real_escape_string($conn, $_POST['data_inizio']);
    
    $_SESSION['tipo_abbonamento'] = $tipo_abbonamento; // Memorizza il tipo di abbonamento nella sessione
    $query = "INSERT INTO iscrizioni (nome, cognome, email, telefono, tipo_abbonamento, data_inizio, user_id) VALUES ('$nome', '$cognome', '$email', '$telefono', '$tipo_abbonamento', '$data_inizio', '$user_id')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['returning_user'] = true;
        echo json_encode(['success' => true, 'message' => 'Iscrizione avvenuta con successo!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Errore durante la registrazione: ' . mysqli_error($conn)]);
    }
    mysqli_close($conn);
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'Richiesta non valida.']);
    exit;
}
?>
