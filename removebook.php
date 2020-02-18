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

$bookid = $_POST ['rec'];

$connect = mysqli_connect( $server, $username, $password, $db )
    or die("Can not connect");


$query2 = "DELETE FROM book_store WHERE id=$bookid" or die("Can not execute query");
		mysqli_query( $connect, $query2 )
			or die("Can not execute query"); 
$connect->close();
 //header("Location: /bs/profile.php");

?>