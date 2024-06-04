<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: home.php");
    exit;
}
$current_password = $_SESSION['storedPasswordHash']; 



function validaPassword($password, $current_password) {
  if ($password === $current_password) {
      return "La nuova password non può essere uguale alla password attuale.";
  }

  if (!preg_match('/[0-9]/', $password)) {
      return "La password deve contenere almeno un numero.";
  }

  if (!preg_match('/[A-Z]/', $password)) {
      return "La password deve contenere almeno una lettera maiuscola.";
  }

  if (strlen($password) < 8) {
      return "La password deve essere lunga almeno 8 caratteri.";
  }
  return true;
}

if (isset($_POST["new_username"])) {
    $conn = mysqli_connect("localhost", "root", "", "homework1");
    if (!$conn) {
        die("Connessione fallita: " . mysqli_connect_error());
    }

    $current_username = $_SESSION['username'];
    $new_username = mysqli_real_escape_string($conn, $_POST['new_username']);

    // Verifica se l'utente corrente esiste e ottiene il suo ID
    $query = "SELECT id FROM utenti WHERE username='$current_username'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $userId = $row['id'];

        // Verifica se il nuovo username è già preso da un altro utente
        $query = "SELECT id FROM utenti WHERE username='$new_username' AND id != '$userId'";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $errore = "Il nuovo username è già preso. Scegli un altro username.";
        } else {
            // Aggiorna l'username se è stato fornito
            if (!empty($new_username)) {
                $checkquery = "UPDATE utenti SET username='$new_username' WHERE id='$userId'";
                if (!mysqli_query($conn, $checkquery)) {
                    $errore = "Errore durante l'aggiornamento dell'username. Riprova.";
                } else {
                    $_SESSION["username"] = $new_username;
                    $_SESSION["successMessage"] = "Aggiornamento username avvenuto con successo";
                    header("Location: profilo.php");
                    exit();
                }
            }
        }
    } else {
        $errore = "Utente non trovato.";
    }

    mysqli_close($conn);
}

if (isset($_POST["new_password"])) {
    $conn = mysqli_connect("localhost", "root", "", "homework1");
    if (!$conn) {
        die("Connessione fallita: " . mysqli_connect_error());
    }

    $current_username = $_SESSION['username'];
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);

    // Verifica se l'utente corrente esiste e ottiene il suo ID
    $query = "SELECT id FROM utenti WHERE username='$current_username'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $userId = $row['id'];

        // Valida la nuova password


      $risultatoValidazione = validaPassword($new_password, $current_password);
        if ($risultatoValidazione === true) {
            // Aggiorna la password se è stata fornita e valida
            $checkquery = "UPDATE utenti SET password='$new_password_hash' WHERE id='$userId'";
            if (!mysqli_query($conn, $checkquery)) {
                $errore = "Errore durante l'aggiornamento della password. Riprova.";
            } else {
                $_SESSION["successMessage"] = "Aggiornamento password avvenuto con successo";
                header("Location: profilo.php");
                exit();
            }
        } else {
            $errore = $risultatoValidazione;
        }
    } else {
        $errore = "Utente non trovato.";
    }

    mysqli_close($conn);
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profilo Utente</title>
    <link rel="stylesheet" href="profilo.css">
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
<div class="background"></div>
<div class="update-container">
    <h1>CAMBIA I TUOI DATI:</h1>

    <?php
    if (isset($_SESSION["successMessage"])) {
        echo "<p class='successo'>";
        echo $_SESSION["successMessage"];
        echo "</p>";
        unset($_SESSION["successMessage"]);
    }
    ?>
    <?php
    if (isset($errore)) {
        echo "<p class='errore'>";
        echo $errore;
        echo "</p>";
    }
    ?>
    <form name="nome-form1" action="" method='post'>
        <label>Nuovo Username<br> <input type='text' name='new_username' id='new_username' required></label>
        <input type='submit' id='submit1' value='Modifica Username'>
    </form>

    <form name="nome-form2" action="" method='post'>
        <label>Nuova Password<br> <input type='password' name='new_password' id='new_password' required></label>
        <input type='submit' id='submit2' value='Modifica Password'>
        <div class="torna"><p>Torna ad</p> <a href="home.php">Home</a></div>
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
