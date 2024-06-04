<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id']; 

$conn = mysqli_connect("localhost", "root", "", "homework1");
if (!$conn) {
    die("Connessione fallita: " . mysqli_connect_error());
}

$user_id = mysqli_real_escape_string($conn, $user_id);

$query = "SELECT * FROM utenti WHERE id = '$user_id'";
$res_1 = mysqli_query($conn, $query);

mysqli_close($conn);
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cerca Canzoni su Spotify</title>
    <link rel="stylesheet" href="spotify.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="spotify.js" defer></script>
</head>
<body>

    <div id="overlay" class="hidden"></div>
    <header>
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
    <h1>ALLENATI AL MASSIMO CON LA TUA MUSICA PREFERITA</h1>
      <a class="subtitle">
        UTILIZZA SPOTIFY E CREA LA TUA PLAYLIST PERFETTA!
      </a>
      <section id="search">
      <form autocomplete="off">
        <div class="search">
          <label for='search'>CERCA QUI</label>
          <input type='text' name="search" class="searchBar">
          <input type="submit" value="Cerca">
        </div>
      </form>
      
    </section>
    <section class="container">

<div id="results">
    
</div>
</section>
</header>
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
