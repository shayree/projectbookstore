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

$bookid = ($_GET ["bookid"]);
$title = ($_GET ["title"]);
$aurthor = ($_GET ["aurthor"]);
$radio = ($_GET ["op"]);
$price = ($_GET ["price"]);
if($radio == 2 || $radio == 3)
	$price = 0;

if($radio == 1)
	$radio = "For Sell";
else if($radio == 2)
	$radio = "For Exchange";
else if($radio == 3)
	$radio = "Free";
else 
	$radio = "Only Me";


$connect = mysqli_connect( $server, $username, $password, $db )
    or die("Can not connect");


$query2 = "UPDATE book_store SET title='$title', aurthor='$aurthor', status='$radio', price='$price' WHERE id=$bookid" or die("Can not execute query");
		mysqli_query( $connect, $query2 )
			or die("Can not execute query"); 
$connect->close();
 header("Location: /bs/profile.php");

?>