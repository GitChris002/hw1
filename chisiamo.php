<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Chi Siamo - Homework1 Volpe Christian</title>
    <link rel="stylesheet" href="chisiamo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

<div class="contenuto">
    <section class="chi-siamo">
        <h1>Chi Siamo</h1>
        <p>Siamo un team dedicato al benessere e alla salute, offrendo servizi di fitness di alta qualità. Con oltre 25 centri in tutta Europa, siamo impegnati a fornire un'esperienza di allenamento eccellente per tutti i nostri membri.</p>
        <p>La nostra missione è aiutare le persone a raggiungere i loro obiettivi di fitness attraverso una combinazione di tecnologia avanzata, attrezzature moderne e personale altamente qualificato.</p>
        <h2>La Nostra Storia</h2>
        <p>Fondati nel 1995, siamo cresciuti costantemente negli anni, espandendoci in nuovi mercati e migliorando continuamente i nostri servizi. Oggi, siamo uno dei principali fornitori di fitness in Europa, con una reputazione per l'eccellenza e l'innovazione.</p>
        <h2>Il Nostro Team</h2>
        <p>Il nostro team è composto da professionisti appassionati di fitness, con anni di esperienza e competenze in diverse aree. Siamo qui per supportarti in ogni fase del tuo percorso di fitness.</p>
        <h2>I Nostri Valori</h2>
        <ul>
            <li><strong>Innovazione:</strong> Utilizziamo le tecnologie più avanzate per migliorare continuamente i nostri servizi.</li>
            <li><strong>Qualità:</strong> Forniamo attrezzature e servizi di altissima qualità per garantire i migliori risultati ai nostri membri.</li>
            <li><strong>Comunità:</strong> Creiamo un ambiente accogliente e solidale per tutti i nostri membri.</li>
            <li><strong>Sostenibilità:</strong> Ci impegniamo a operare in modo sostenibile e rispettoso dell'ambiente.</li>
        </ul>
        <h2>Contattaci</h2>
        <p>Se hai domande o desideri ulteriori informazioni, non esitare a contattarci<a href="contatti.php" class="contatti"> qui</a>. Siamo qui per aiutarti!</p>
    </section>
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
