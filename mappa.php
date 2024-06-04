<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
    <html>
    <head>
        <title>Mappe King's Fit</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src='https://api.mapbox.com/mapbox-gl-js/v2.9.0/mapbox-gl.js'></script>
        <link href='https://api.mapbox.com/mapbox-gl-js/v2.9.0/mapbox-gl.css' rel='stylesheet' />
        <script src="mappa.js" defer></script>
        <link href='mappa.css' rel='stylesheet' />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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



        <div class="intro">
            <h1>King's Fit in Italia</h1>
            <p>Benvenuti nella pagina delle mappe di King's Fit! Qui potete trovare una panoramica di tutte le nostre sedi in Italia. Scegliete la palestra più vicina a voi e iniziate il vostro percorso di allenamento con noi.</p>
        </div>
    <div id="map"></div>
    
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
