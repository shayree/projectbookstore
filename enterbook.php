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

$title = $_POST ['title'];
$aurthor = $_POST ['aurthor'];
$price = $_POST ['price'];
$radio = $_POST ['status'];

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


$query2 = "INSERT INTO book_store (owner, title, aurthor, status, price ) VALUES ('$user','$title','$aurthor','$radio','$price')" or die("Can not execute query");
mysqli_query( $connect, $query2 ) or die("Can not execute query");

$temp =  mysqli_query( $connect, "select MAX(id) from book_store") or die("Can not execute query");
while($temp_value = $temp->fetch_assoc()){
    $id = $temp_value['MAX(id)'];
} 

echo $id;


 //header("Location: /bs/profile.php");

?>