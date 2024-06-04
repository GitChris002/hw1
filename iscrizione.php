<?php
session_start();

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
$is_subscribed = mysqli_num_rows($result) > 0;
$_SESSION['already_subscribed'] = $is_subscribed;

// Imposta $_SESSION['already_subscribed'] anche quando viene caricata la pagina di iscrizione
if ($is_subscribed) {
    echo "<script>document.addEventListener('DOMContentLoaded', function() {
            const disdettaForm = document.forms['disdetta-form'];
            disdettaForm.style.display = 'block';
            const form=document.querySelector('.form-container');
            const inserisci=document.querySelector('.Inserisci');
            inserisci.style.display='none';
            form.style.display='none';
        });</script>";
}
?>


      <!DOCTYPE html>
      <html lang="it">
      <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <title>Iscrizione Abbonamento</title>
          <link rel="stylesheet" href="iscrizione.css">
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

      <header class="immagine">
          <div class="text">
              <div id="messaggio-iscrizione" class="messaggio-iscrizione" style="display: none;"></div>
              <div id="messaggio-disdetta" class="messaggio-disdetta" style="display: none;">
                  <h1 id="messaggio-disdetta-testo"></h1>
              </div>
              <h2 class="IscrivitiOra">Iscriviti e diventa un King!</h2><br>
          </div>
          
          <div class="Text-box">
              <div class="stdoflx"><p>STANDARD O FLEX?<p></div>
              <ul>
                  <li>STANDARD: Un semplice contratto mensile a €34,90/mese, dalla durata minima di 12 mesi e pagamento di €39 di una membercard all'attivazione. Il cliente ha un diritto di recesso entro 14 giorni</li>
                  <li>FLEX: Un semplice contratto mensile a €49,90/mese, con durata di un singolo mese, pagamento di €39 di una membercard all'attivazione. Il cliente ha un diritto di recesso entro 14 giorni.</li>
              </ul>
              <div class="MaggioriInfo">Per maggiori informazioni, <a href="http://localhost/Homework/home.php#testo3">clicca qui</a></div>
          </div>
      </header>

      <h1 class="Inserisci">Inserisci qua i tuoi dati:</h1>

      <div class="form-container">
          <div class="errore"></div>
          <form name="iscrizione-form" method="post">
              <label for="nome">Nome:</label><br>
              <input type="text" id="nome" name="nome" required><br>
              <label for="cognome">Cognome:</label><br>
              <input type="text" id="cognome" name="cognome" required><br>
              <label for="email">Email:</label><br>
              <input type="email" id="email" name="email" required><br>
              <label for="telefono">Telefono:</label><br>
              <input type="tel" id="telefono" name="telefono" required><br>
              <label for="tipo_abbonamento">Tipo Abbonamento:</label><br>
              <select id="tipo_abbonamento" name="tipo_abbonamento" required>
                  <option value="STANDARD">Standard</option>
                  <option value="FLEX">Flex</option>
              </select><br>
              <label for="data_inizio">Data Inizio Abbonamento:</label><br>
              <input type="date" id="data_inizio" name="data_inizio" required><br><br>
              <input type="submit" value="Iscriviti">
          </form>
      </div>

      <form name="disdetta-form" method="post" class="disdetta-form" <?php if (!isset($_SESSION['already_subscribed'])) { echo 'style="display: none;"'; } ?>>
    <h2 class="form-disdetta-text">Sei già iscritto, vuoi disdire il tuo abbonamento?</h2>
    <input type="hidden" name="disdetta" value="true">
    <input type="submit" value="Disdici Abbonamento" id="disdetta-button">
</form>




      <script src="iscrizione.js" defer></script>

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
                          <div class="testoinfo"><a href="c ontatti.php"><p>Contattaci</p></a></div>
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
