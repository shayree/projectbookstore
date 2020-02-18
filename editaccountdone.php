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

$email = ($_GET ["email"]);
$phone = ($_GET ["phone"]);

$connect = mysqli_connect( $server, $username, $password, $db )
    or die("Can not connect");


$query2 = "UPDATE profile SET email='$email', phone='$phone' WHERE id=$user" or die("Can not execute query");
		mysqli_query( $connect, $query2 )
			or die("Can not execute query"); 
$connect->close();
 header("Location: /bs/profile.php");

?>