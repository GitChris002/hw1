<?php 
  session_start();
  if (!isset($_SESSION['username'])) {
      header("Location: login.php");
      exit;
  }
  
  $username = $_SESSION['username'];
  $user_id = $_SESSION['user_id']; 

    header('Content-Type: application/json');

    $conn = new mysqli('localhost', 'root', '', 'homework1');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

    $user_id = mysqli_real_escape_string($conn, $user_id);
    
    $next = isset($_GET['from']) ? 'AND songs.id < '.mysqli_real_escape_string($conn, $_GET['from']).' ' : '';

    $query = "SELECT id, user_id, song_id, content from songs where user_id = $user_id ORDER BY id DESC LIMIT 10";

    $res = mysqli_query($conn, $query) or die(mysqli_error($conn));
    
    $songArray = array();
    while($entry = mysqli_fetch_assoc($res)) {
        $songArray[] = array('userid' => $entry['user_id'],
                            'songid' => $entry['song_id'], 'content' => json_decode($entry['content']));
    }
    echo json_encode($songArray);
    
    exit;


?>