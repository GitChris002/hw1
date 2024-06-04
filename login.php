<?php
session_start();
if (isset($_SESSION["username"])) {
    header("Location: home.php");
    exit;
}
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $conn = mysqli_connect("localhost", "root", "", "homework1");
    if (!$conn) {
        die("Connessione fallita: " . mysqli_connect_error());
    }
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT id, username, password, genere FROM utenti WHERE username = '$username'";
    $res = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($res) == 1) {
        $row = mysqli_fetch_assoc($res);
        $storedPasswordHash = $row['password'];
    
        if (password_verify($password, $storedPasswordHash)) {
            $_SESSION["username"] = $row["username"];
            $_SESSION["genere"] = $row["genere"];
            $_SESSION["returning_user"] = true;
            $_SESSION["user_id"] = $row["id"]; 
            $_SESSION["storedPasswordHash"] = $storedPasswordHash;
    
            // Recupera i dati salvati durante la registrazione
            $query_register = "SELECT nome, cognome, telefono,genere FROM utenti WHERE id = '".$_SESSION["user_id"]."'";
            $result_register = mysqli_query($conn, $query_register);
            $row_register = mysqli_fetch_assoc($result_register);
    
            $_SESSION["nome"] = $row_register["nome"]; 
            $_SESSION["cognome"] = $row_register["cognome"]; 
            $_SESSION["telefono"] = $row_register["telefono"]; 
            $_SESSION["genere"] = $row_register["genere"]; 
    
            header("Location: home.php");
            exit();
        } else {
            $errore = true;
        }
    } else {
        $errore = true;
    }
    
    mysqli_close($conn);
}
?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
    <script src='login.js' defer></script>
</head>
<body>
<div class="background"></div>
<div class="Login-text"><p>ACCEDI O REGISTRATI<br>A KING'S FIT</p></div>
<div class="login-container">
    <form name="nome-form" action="" method='post'>
    <?php
if (isset($errore)) {
    echo "<span class='errore'>";
    echo "Credenziali non valide";
    echo "</span>";
}
?>
        <h1>LOG IN</h1>
        <label>Username<br> <input type='text' name='username' id='uspass' required></label>
        <label>Password<br> <input type='password' name='password' id='uspass' required></label>
        <input type='submit' id='submit' value='Invia'>
        <div class="register"><p>Non hai un account? <a href="register.php">Registrati qui</a></p></div>
    </form>
</div>
</body>
</html>
