<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$userid = $_SESSION['user_id']; 

removeFavorite();

function removeFavorite() {
    global $dbconfig, $userid;
    $conn = new mysqli('localhost', 'root', '', 'homework1');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userid = mysqli_real_escape_string($conn, $userid);
    $id = mysqli_real_escape_string($conn, $_POST['id']);

    $query = "SELECT * FROM songs WHERE user_id = '$userid' AND song_id = '$id'";
    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if(mysqli_num_rows($res) == 0) {
        echo json_encode(array('success' => false, 'error' => 'Song not found'));
        exit;
    }

    $query2 = "DELETE FROM songs WHERE user_id = '$userid' AND song_id = '$id'";
    error_log($query2);
    if(mysqli_query($conn, $query2) or die(mysqli_error($conn))) {
        echo json_encode(array('success' => true, 'id' => $id));
        exit;
    }

    mysqli_close($conn);
    echo json_encode(array('success' => false, 'error' => 'Failed to delete song'));
}
?>
