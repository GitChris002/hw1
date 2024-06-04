<?php
session_start();

if (isset($_SESSION["username"])) {
    header("Location: home.php");
    exit;
}

function validaPassword($password) {
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

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["genere"]) && isset($_POST["nome"]) && isset($_POST["cognome"]) && isset($_POST["telefono"])) {
    $conn = mysqli_connect("localhost", "root", "", "homework1");
    if (!$conn) {
        die("Connessione fallita: " . mysqli_connect_error());
    }

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $genere = mysqli_real_escape_string($conn, $_POST['genere']);
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    $cognome = mysqli_real_escape_string($conn, $_POST['cognome']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);

    $query = "SELECT * FROM utenti WHERE username = '$username'";
    $res = mysqli_query($conn, $query);

    if (mysqli_num_rows($res) > 0) {
        $errore = "Username già esistente. Scegli un altro username.";
    } else {
        $risultatoValidazione = validaPassword($password);
        if ($risultatoValidazione === true) {
         
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            
            $query = "INSERT INTO utenti (username, password, genere, nome, cognome, telefono) VALUES ('$username', '$passwordHash', '$genere', '$nome', '$cognome', '$telefono')";
            if (mysqli_query($conn, $query)) {
                $lastInsertedId = mysqli_insert_id($conn); 
                $_SESSION["username"] = $username;
                $_SESSION["genere"] = $genere;
                $_SESSION["new_user"] = true; 
                $_SESSION["user_id"] = $lastInsertedId;
                $_SESSION["nome"] = $nome;
                $_SESSION["cognome"] = $cognome;
                $_SESSION["telefono"] = $telefono;
                $_SESSION["storedPasswordHash"] = $passwordHash;
                header("Location: home.php");
                exit();
            } else {
                $errore = "Errore durante la registrazione. Riprova.";
            }
            
        } else {
            $errore = $risultatoValidazione;
        }
    }

    mysqli_close($conn);
}

?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrazione</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
<div class="background"></div>
<div class="login-text"><p>REGISTRATI A KING'S FIT</p></div>
<div class="login-container">
    <form name="nome-form" action="" method='post'>
        <?php
        if (isset($errore)) {
            echo "<span class='errore'>";
            echo "$errore";
            echo "</span>";
        }
        ?>
        <h1>REGISTRAZIONE</h1>
        <label>Username<br> <input type='text' name='username' id='username' required></label>
        <label>Nome<br> <input type='text' name='nome' id='nome' required></label>
        <label>Cognome<br> <input type='text' name='cognome' id='cognome' required></label>
        <label>Telefono<br> <input type='tel' name='telefono' id='telefono' required></label>
        <label>Password<br> <input type='password' name='password' id='password' required></label>
        <label>Genere<br>
            <select name="genere" id="genere" required>
                <option value="M">Maschio</option>
                <option value="F">Femmina</option>
            </select>
        </label>
        <input type='submit' id='submit' value='Invia'>
        <div class="torna"><p>Torna ad</p> <a href="login.php">Accedi</a></div>
    </form>
</div>
<script src='login.js' defer></script>
</body>
</html>
