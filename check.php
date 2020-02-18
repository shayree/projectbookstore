<?php
//session_start();
$username = "root";
$password = "";
$server = 'localhost';
$db = 'bs';
$connect = mysqli_connect( $server, $username, $password, $db )
    or die("Can not connect");

$buddy_id = "011132013";
$user = "011132013";
if($buddy_id == $user)
  echo "valgid";
else
  echo "invalid";
$temp = 1;
$query =  mysqli_query( $connect, "SELECT * FROM buddy") or die("Can not execute query");
             while($query_value = $query->fetch_assoc()){
              $b_id = (string) $query_value['buddy_id'];
              echo $b_id;
              if($b_id == $buddy_id || $b_id == $user)
                echo "ok";
              else
                echo "not ok";                
            } 



$connect->close();
 //header("Location: /bs/book.php");

?>