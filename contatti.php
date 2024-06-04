<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: home.php");
    exit;
}


if (isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["messaggio"])) {
    $conn = mysqli_connect("localhost", "root", "", "homework1");
    if (!$conn) {
        echo json_encode(['success' => false, 'message' => "Connessione fallita: " . mysqli_connect_error()]);
        exit;
    }

    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);
    $messaggio = mysqli_real_escape_string($conn, $_POST['messaggio']);



        $query = "INSERT INTO messaggicontatto (nome, cognome, messaggio) VALUES ('$nome', '$cognome', '$messaggio')";

        if (mysqli_query($conn, $query)) {
            $_SESSION['returning_user'] = true;
            echo json_encode(['success' => true, 'message' => 'Iscrizione avvenuta con successo!']);
        } else {
            echo json_encode(['success' => false, 'message' => "Errore durante la registrazione. Riprova. Errore: " . mysqli_error($conn)]);
        }
    

    mysqli_close($conn);
    exit;
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iscrizione Abbonamento</title>
    <link rel="stylesheet" href="contatti.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="contatti.js" defer></script>
</head>
<body>
<nav class="top">
    <div class="Menu">
        <a href="http://localhost/Homework/home.php">
            <img src="Immagini/logo.png" class="logo">
        </a>
        <p><a href="mappa.php">PALESTRE</a></p>
        <p><a href="chisiamo.php">CHI SIAMO</a></p>
        <div class="dropdown">
            <button class="dropbtn">PROFILO</button>
            <div class="dropdown-content">
                <a href="profilo.php">MODIFICA UTENTE</a>
                <a href="iscrizione.php">ABBONAMENTO</a>
            </div>
        </div>
    </div>
    <a href="area_personale.php">
        <div class="user"></div>
    </a>
    <div class="logutbutton">
    <a href="logout.php"><p class="logout">LOGOUT</p></a>
    </div>
</nav>
    
    <header class="immagine">
        <div class="text">
            <div id="messaggio-contattaci" class="messaggio-contattaci" style="display: none;"></div>
            <h1 class="Assistenza">Se hai bisogno di qualcosa qui ci sono i nostri contatti!</h1><br>
        </div>
        
        <div class="Text-Info">
        <p>Indirizzo:Corso Italia, 117 - Catania</p>
        <p>Telefono: 0123 456789</p>
        <p>Email:info@kingsfit.com</p>
        <p>In alternativa inviaci un messaggio qui sotto</p>
        </div>
    </header>
    <h1 class="Inserisci">Inserisci qua il messaggio:</h1>

    <div class="form-container">
    <div class="errore"></div>
    <form name="contatti-form" method="post">
        <label for="nome">Nome:</label><br>
        <input type="text" id="nome" name="nome" required><br>
        <label for="cognome">Cognome:</label><br>
        <input type="text" id="cognome" name="cognome" required><br>
        <label for="messaggio">Messaggio:</label><br>
        <textarea id="messaggio" name="messaggio" required></textarea><br> 
        <input type="submit" value="Invia">
    </form>
</div>

</body>
<footer>
  <div class="Social">
    <div class="BoxSocial">
      <div class="social-item">
        <a href="#"><img src="Immagini/facebook.png" class="Immagine3"></a>
        <p>Facebook</p>
      </div>
      <div class="social-item">
        <a href="#"><img src="Immagini/Ig.png" class="Immagine3"></a>
        <p>Instagram</p>
      </div>
      <div class="social-item">
        <a href="#"><img src="Immagini/tiktok.png" class="Immagine3"></a>
        <p>TikTok</p>
      </div>
    </div>
  </div>
  <div class="info">
    <div class="Infobox">
      <div class="Infobox1">
        <p class="Legale"><i class="fas fa-gavel"></i> Legale</p>
        <div class="Infolegale">
          <div class="testoinfo"><a href="home.php#generali"><p>Generali</p></a></div>
        </div>
      </div>
      <div class="Infobox2">
        <p class="Assistenza"><i class="fas fa-phone-alt"></i> Assistenza contatti</p>
        <div class="Infoassistenza">
          <div class="testoinfo"><a href="contatti.php"><p>Contattaci</p></a></div>
        </div>
      </div>
      <div class="Infobox3">
        <p class="Palestre2"><i class="fas fa-dumbbell"></i> Palestre</p>
        <div class="Infopalestre">
          <div class="testoinfo"><a href="mappa.php"><p>Palestre in Italia</p></a></div>
        </div>
      </div>
    </div>
  </div>
</footer>



</html>