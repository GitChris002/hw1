<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$userid = $_SESSION['user_id']; 

spotify();

function spotify() {
    global $dbconfig, $userid;
    $conn = new mysqli('localhost', 'root', '', 'homework1');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userid = mysqli_real_escape_string($conn, $userid);
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $artist = mysqli_real_escape_string($conn, $_POST['artist']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    $popularity = mysqli_real_escape_string($conn, $_POST['popularity']);
    $image = mysqli_real_escape_string($conn, $_POST['image']);

    $query = "SELECT * FROM songs WHERE user_id = '$userid' AND song_id = '$id'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if(mysqli_num_rows($res) > 0) {
        echo json_encode(array('ok' => true));
        exit;
    }

    $query = "INSERT INTO songs(user_id, song_id, content) VALUES('$userid','$id', JSON_OBJECT('id', '$id', 'title', '$title', 'artist', '$artist', 'duration', '$duration', 'popularity', '$popularity', 'image', '$image'))";
    error_log($query);
    if(mysqli_query($conn, $query) or die(mysqli_error($conn))) {
        echo json_encode(array('ok' => true));
        exit;
    }

    mysqli_close($conn);
    echo json_encode(array('ok' => false));
}
?>
