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

$subject = ($_GET ["subject"]);
$message = ($_GET ["message"]);

echo "string";
echo $subject;
$connect = mysqli_connect( $server, $username, $password, $db )
    or die("Can not connect");


$query2 = "INSERT INTO contact (user_id, subject, message) VALUES ('$user','$subject','$message')" or die("Can not execute query");
mysqli_query( $connect, $query2 ) or die("Can not execute query");

header("Location: /bs/book.php");

?>