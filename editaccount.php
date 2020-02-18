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

$connect = mysqli_connect( $server, $username, $password, $db )
    or die("Can not connect");

$temp =  mysqli_query( $connect, "select * from profile where id='$user'") or die("Can not execute query");
                        while($query_value = $temp->fetch_assoc()){
                          $email = $query_value['email'];
                          $phone = $query_value['phone'];                       
                        } 

?>




<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Book</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />

</head>
<body>
  <div class="col-md-4"></div>
<div class="col-md-4">
  <h2 style="text-align: center;">EDIT ACCOUNT INFORMATION</h2>
  <form action="editaccountdone.php">

  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-3 col-form-label">Email</label>
    <div class="col-sm-8">
      <?php
      echo '<input type="text" name="email" class="form-control" id="inputPassword3" value="'.$email.'" >';  
      ?>
    </div>
  </div>

  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-3 col-form-label">Phone Number</label>
    <div class="col-sm-8">
      <?php
      echo '<input type="text" name="phone" class="form-control" id="inputPassword3" value="'.$phone.'">';  
      ?>
    </div>
  </div>

  <div class="form-group row">
    <div>
     
      <button type="submit" class="btn btn-primary btn-block">Submit</button>
    </div>
  </div>
</form>
</div>

</body>
</html>
