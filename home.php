<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$nome = $_SESSION['nome'];
$cognome = $_SESSION['cognome'];
$genere = $_SESSION['genere'];
$user_id=$_SESSION['user_id'];

$messaggio_benvenuto = "";

if (isset($_SESSION['new_user'])) {
    $messaggio_benvenuto = ($genere == 'F') ? "Benvenuta" : "Benvenuto";
} elseif (isset($_SESSION['returning_user'])) {
    $messaggio_benvenuto = ($genere == 'F') ? "Bentornata" : "Bentornato";
} else {
    $messaggio_benvenuto = "Ciao";
}

$messaggio_benvenuto .= " " . $nome . "!";
?>


<html>
    <head>
  
      <title>Homework1 Volpe Christian</title>
      <link rel="stylesheet" href="home.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="home.js" defer></script>
  
    </head>
    <body>
    <nav class="top">
    <div class="Menu">
        <a href="http://localhost/Homework/home.php">
            <img src="Immagini/logo.png" class="logo">
        </a>
        <div class="dropdown2">
            <img src="Immagini/Menu.png" class="menu-icon">
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
    <a href="area_personale.php">
        <div class="user"></div>
    </a>
    <div class="logutbutton">
        <a href="logout.php"><p class="logout">LOGOUT</p></a>
    </div>
</nav>



      
      <header class="contenuto">
      <div class="Benvenuto"><?php echo $messaggio_benvenuto; ?></div>
        <div id="specialOffers"></div>
</header>
      
      <div class="Boxabbonamento">
        <div class="Boxabbonamento1">
          <div class="Abbonamento">
            <h3>ABBONAMENTO</h3>
            <p>Da <span class="price">34,90€</span>/MESE</p>
            <a href="iscrizione.php"> <div class="iscrizione2">ISCRIVITI ORA</div></a>
          </div>
        </div>
        <div class="Boxabbonamento2">
          <div class="riga1">
            <div class="numer1">
              <div class="numero">25+</div>
              <p>centri in Europa</p>
            </div>
            <div class="numer2">
              <div class="numero">365</div>
              <p>giorni l'anno</p>
            </div>
          </div>
          <div class="riga2">
            <div class="numer3">
              <div class="numero">27</div>
              <p>anni di esperienza</p>
            </div>
            <div class="numer4">
              <div class="numero">100%</div>
              <p>allenamento</p>
            </div>
          </div>
        </div>
      </div>
      <div class="contenuto2">
        <img src="Immagini/Immagine2.jpg" class="Immagine2">
        <div class="testoimmagine2">
        <div class="scelta">
          <p>S C E L T A     D' A L L E N A M E N T O</p>
        </div>
        <div class="Fitness">
          <p>FITNESS E OLTRE</p>
        </div>
        <div class="Scopri" id="scopriButton"><p>SCOPRI DI PIÙ</p></div>
        <div class="modal2" id="myModal2">
    <div class="modal-content2">
        <span class="close2">&times;</span>
        <h2>Programma di Allenamento</h2>
        <p>Il nostro programma di allenamento è progettato per aiutarti a raggiungere i tuoi obiettivi di fitness in modo efficace e divertente. Ecco alcuni dei vantaggi:</p>
        <ul>
            <li>Miglioramento della forza e della resistenza muscolare</li>
            <li>Perdita di peso e tonificazione</li>
            <li>Miglioramento della salute cardiovascolare</li>
            <li>Incremento dell'energia e del benessere generale</li>
            <li>Accesso a trainer esperti per assistenza personalizzata</li>
        </ul>
        <p>Indipendentemente dal livello di fitness o dagli obiettivi che hai, il nostro programma offre una varietà di opzioni e un supporto costante per aiutarti a raggiungere il successo.</p>
        <h2>Benefici del Fitness</h2>
        <p>L'attività fisica regolare ha numerosi benefici per la salute, tra cui:</p>
        <ul>
            <li>Riduzione del rischio di malattie cardiache e ictus</li>
            <li>Miglioramento dell'umore e della salute mentale</li>
            <li>Riduzione dello stress e dell'ansia</li>
            <li>Miglioramento della qualità del sonno</li>
            <li>Aumento della fiducia in se stessi e dell'autostima</li>
        </ul>
        <p>Con il nostro programma di allenamento, puoi godere di tutti questi benefici e molto altro ancora. Inizia il tuo percorso verso una vita più sana e felice oggi!</p>
    </div>
</div>
</div>




      </div>
      </div>
      
      <div class="Boxabbonamento3">
      <div class="testo2">
        <p class="abbonamento2">A B B O N A M E N T O</p>
        <h2 class="muoviti">MUOVITI.  E SARAI FELICE.</h2>
      </div>
        <div class="desc">
          <p>Cerchi qualcosa di non vincolante? O qualcosa di stabile? Non importa quello che vuoi, noi ce l’abbiamo. Puoi disdire il contratto Flex ogni mese. Che sia un contratto annuale o mensile, hai comunque a disposizione l’intera offerta di allenamento e potrai allenarti in tutta Europa.</p>
        </div>
  
      </div>
  
      <div class="Boxabbonamento4">
    <div class="arrow left-arrow">&#10094;</div>
    
    <div class="Boxabbonamento5" id="slide1">
        <div class="Standard">
            <h3 class="std">STANDARD</h3>
            <p>Da <span class="price2"> 34,90€ </span> /MESE</p>
            <div class="mese1">Contratto di 12 mesi*</div>
            <a href="iscrizione.php"><div class="scopri2">SCOPRI DI PIÙ</div></a>
        </div>
    </div>
    
    <div class="Boxabbonamento6" id="slide2" style="display: none;">
        <div class="Flex">
            <h3 class="flx">FLEX</h3>
            <p>Da <span class="price3"> 44,90€ </span> /MESE</p>
            <div class="mese2">Contratto di 1 mese**</div>
            <a href="iscrizione.php"><div class="scopri2">SCOPRI DI PIÙ</div></a>
        </div>
    </div>
    
    <div class="arrow right-arrow">&#10095;</div>
</div>


      <section id ="testo3"class="testo3">
        <div class="testo4">
          <div class="testo5">
            <p class="testo6">
            *King's Fit - Regolamento Contrattuale per Abbonamento Annuale:
            Durante l'iscrizione a King's Fit per un abbonamento annuale, verrà stipulato un contratto con i seguenti termini e condizioni:
            Durata Contrattuale: Il contratto ha una durata minima di 12 mesi. In assenza di disdetta a mezzo raccomandata A/R con almeno 15 giorni di anticipo rispetto alla scadenza del contratto, lo stesso si rinnoverà automaticamente di 6 mesi in 6 mesi, e così via, al prezzo previsto durante la prima durata contrattuale.
            Costo di Attivazione Membercard: È richiesto il pagamento di €39 come costo di attivazione della Membercard.
            Requisiti per l'Offerta: L'offerta è valida solo per i clienti che hanno già compiuto 15 anni.
            Diritto di Recesso: Il cliente ha il diritto di recedere dal contratto entro 14 giorni dalla sua conclusione.
            </p>
            <p class="testo7">
              **King's Fit - Regolamento Contrattuale per Abbonamento Mensile:
                Durante l'iscrizione a King's Fit per un abbonamento mensile, verrà stipulato un contratto con i seguenti termini e condizioni:
                Durata Contrattuale: Il contratto ha una durata minima di un mese con decorrenza dal primo giorno del mese fino all'ultimo giorno dello stesso mese. Se la data di decorrenza non coincide con il primo giorno del mese, il contratto dura il periodo compreso tra la data di sottoscrizione e la fine dello stesso mese, sommato al periodo tra il primo giorno del mese successivo fino all’ultimo giorno dello stesso mese.
                Quota Mensile: La quota mensile per l'abbonamento è di €49,90 o €54,90, a seconda del prezzo mensile a regime in vigore nel centro di sottoscrizione del contratto.
                Rinnovo Automatico: Il contratto si rinnova automaticamente per un mese alla volta, salvo disdetta tramite l'area riservata sul sito internet almeno 15 giorni prima della scadenza del contratto.
                Costo di Attivazione Membercard: È richiesto il pagamento di €39 come costo di attivazione della Membercard.
                Requisiti per l'Offerta: L'offerta è valida solo per i clienti che hanno già compiuto 15 anni.
                Diritto di Recesso: Il cliente ha il diritto di recedere dal contratto entro 14 giorni dalla sua conclusione.
            </p>
          </div>
        </div>
      </section>


      <button id="avviaChatButton">Avvia la chat</button>
        <div id="chat" class="hidden">
        <div id="chatMessages"></div>
        <div id="chatInput">
        <input type="text" id="inputUtente" placeholder="Digita un messaggio...">
        <button id="inviaMessaggioButton">Invia</button>
        <button id="IndietroButton">Indietro</button>
        </div>
        </div>

        <button id="spotifyButton">
            <a href="spotify.php">
            <img src="Immagini/spotify.png" alt="Spotify Logo">
            </a>
        </button>
      <div id="Playlist">
        <p>CREA QUI LA TUA PLAYLIST!</p>
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
          <div id="modalgenerali" class="modalgenerali">
                         <div class="modal-generali-content">
                             <span class="closegenerali">&times;</span>
                              <h2 class="informazioni-legali">Informativa sulla Privacy e Termini e Condizioni</h2>
                              <h3>Privacy</h3>
                              <p>King's Fit rispetta la tua privacy e si impegna a proteggere le informazioni personali che ci fornisci. Utilizziamo le tue informazioni solo per fornirti i servizi richiesti e per migliorare la tua esperienza con noi. Non condivideremo mai le tue informazioni con terze parti senza il tuo consenso.</p>
                              <h3>Termini e Condizioni</h3>
                              <p>Accedendo al nostro sito web e utilizzando i nostri servizi, accetti di essere vincolato dai seguenti Termini e Condizioni:</p>
                              <ul>
                              <li>Devi avere almeno 15 anni per utilizzare i nostri servizi, o ottenere il consenso dei tuoi genitori o tutori legali.</li>
                              <li>Accetti di utilizzare i nostri servizi solo per scopi leciti e conformi alle leggi vigenti.</li>
                              <li>Selezioni di alimenti e integratori devono essere approvati da un medico o un professionista della salute.</li>
                              <li>King's Fit non è responsabile per eventuali danni o lesioni derivanti dall'uso improprio dei nostri servizi o attrezzature.</li>
                              </ul>
                              <p>Questi sono solo alcuni dei nostri Termini e Condizioni. Ti invitiamo a leggere l'intero documento per una comprensione completa.</p>
                          </div>
                  </div>
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