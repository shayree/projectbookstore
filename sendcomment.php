<?php
session_start();
$username = "root";
$password = "";
$server = 'localhost';
$db = 'bs';

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
}
else 
  header("Location: /bs/login.php");

$buddy_id = ($_GET ["buddy_name"]);
$text = ($_GET ["text"]);
echo $text;


$connect = mysqli_connect( $server, $username, $password, $db )
    or die("Can not connect");

$query2 = "INSERT INTO chat (user_id, buddy_id, comment ) VALUES ('$user','$buddy_id','$text')" or die("Can not execute query");
mysqli_query( $connect, $query2 ) or die("Can not execute query");
$connect->close();
 header("Location: /bs/profile.php");

?>