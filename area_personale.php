<?php 
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$userid = $_SESSION['user_id']; 
$genere=$_SESSION['genere'];
$telefono=$_SESSION['telefono'];
$nome=$_SESSION['nome'];
$cognome=$_SESSION['cognome'];

$conn = new mysqli('localhost', 'root', '', 'homework1');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recupera l'abbonamento dal database
$fetch_abbonamento_query = "SELECT tipo_abbonamento FROM iscrizioni WHERE user_id = '$userid'";
$abbonamento_result = mysqli_query($conn, $fetch_abbonamento_query);

if ($abbonamento_row = mysqli_fetch_assoc($abbonamento_result)) {
    $tipo_abbonamento = $abbonamento_row['tipo_abbonamento'];
} else {
    $tipo_abbonamento = 'NESSUN ABBONAMENTO SOTTOSCRITTO'; // Se l'abbonamento non è stato trovato, imposta una stringa vuota
}


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Area Personale</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="area_personale.css">
    <script src="area_personale.js" defer></script>
</head>
<body>
<div id="overlay" class="hidden">
    </div>
    <nav class="top">
    <div class="Menu">
        <a href="http://localhost/Homework/home.php">
            <img src="Immagini/logo.png" class="logo">
        </a>
        <div class="dropdown2">
            <div class="dropdown-content2">
                <a href="chisiamo.php">CHI SIAMO</a>
                <a href="mappa.php">PALESTRE</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">PROFILO</button>
            <div class="dropdown-content">
                <a href="profilo.php">MODIFICA UTENTE</a>
                <a href="iscrizione.php">ABBONAMENTO</a>
            </div>
        </div>
    </div>
  
    <div class="logutbutton">
        <a href="logout.php"><p class="logout">LOGOUT</p></a>
    </div>
</nav>

<div class="user-info">
    <h2>Informazioni Utente</h2>
    <p>Username: <?php echo $username; ?></p>
    <p>Genere: <?php echo $genere; ?></p>
    <p>Nome: <?php echo $nome; ?></p>
    <p>Cognome: <?php echo $cognome; ?></p>
    <p>telefono: <?php echo $telefono; ?></p>
    <p>Abbonamento: <?php echo $tipo_abbonamento; ?></p>


    <h2>Canzoni Salvate</h2>
    <section class="container">
    <div id="results">
    
    </div>
</div>
</section>
<button id="spotifyButton">
            <a href="spotify.php">
            <img src="Immagini/spotify.png" alt="Spotify Logo">
            </a>
        </button>
      <div id="Playlist">
        <p>CREA QUI LA TUA PLAYLIST!    </p>
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
  <div class="info2">
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
