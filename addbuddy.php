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

$buddy_id = $_POST ['id'];
$buddy_id = "0"."".$buddy_id;
$connect = mysqli_connect( $server, $username, $password, $db )
    or die("Can not connect");
 
$temp = 1;
$query =  mysqli_query( $connect, "SELECT * FROM buddy") or die("Can not execute query");
             while($query_value = $query->fetch_assoc()){
              $b_id = $query_value['buddy_id'];
              if($b_id == $buddy_id)
              	$temp = 0;                
            } 

if($temp == 1){
	$query = "INSERT INTO buddy (id,buddy_id) VALUES ('$user','$buddy_id')" or die("Can not execute query");
	mysqli_query( $connect, $query) or die("Can not execute query"); 

	$query = "INSERT INTO buddy (id,buddy_id) VALUES ('$buddy_id','$user')" or die("Can not execute query");
	mysqli_query( $connect, $query) or die("Can not execute query"); 
}
$connect->close();
 //header("Location: /bs/book.php");

?>