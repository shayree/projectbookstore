<?php
session_start();
$username = "root";
$password = "";
$server = 'localhost';
$db = 'bs';

$user = ($_GET ["id"]);
$pass = ($_GET ["pass"]);
//$link = "/bs/login.php";
$connect = mysqli_connect( $server, $username, $password, $db )
    or die("Can not connect");


$temp =  mysqli_query( $connect, "select * from profile where id='$user'") or die("Can not execute query");
                        while($temp_value = $temp->fetch_assoc()){
                            $id = $temp_value['id'];
                            $password = $temp_value['pass'];
                        }  
if($id == $user && $pass = $password){
	$_SESSION['user'] = $user;
	header("Location: /bs/book.php");
}
else{ 
	header("Location: /bs/login.html");
}


?>