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

$bookid = ($_GET ["id"]);

$connect = mysqli_connect( $server, $username, $password, $db )
    or die("Can not connect");

$temp =  mysqli_query( $connect, "select * from book_store where id='$bookid'") or die("Can not execute query");
                        while($query_value = $temp->fetch_assoc()){
                            $title = $query_value['title'];
                          $aurthor = $query_value['aurthor'];
                          $status = $query_value['status'];
                          $price = $query_value['price'];                           
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
  <h2 style="text-align: center;">EDIT BOOK INFORMATION</h2>
  <form action="editdone.php">
  <div class="form-group row">
   
    <div class="col-sm-10">
      <input type="hidden" name="bookid" class="form-control" id="inputEmail3" <?php echo "value =  $bookid" ?> >
    </div>
  </div>  
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Book Title</label>
    <div class="col-sm-10">
      <?php
      echo '<input type="text" name="title" class="form-control" id="inputEmail3" value="'.$title.'" placeholder="Book Title">';  
      ?>
      
    </div>
  </div>
  <div class="form-group row">
    <label for="inputPassword3" class="col-sm-2 col-form-label">Aurthor Name</label>
    <div class="col-sm-10">
      <?php
      echo '<input type="text" name="aurthor" class="form-control" id="inputPassword3" value="'.$aurthor.'" placeholder="Aurthor Name">';  
      ?>
    </div>
  </div>
  <fieldset class="form-group">
    <div class="row">
      <legend class="col-form-label col-sm-2 pt-0">Status</legend>
      <div class="col-sm-10">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="op" id="gridRadios1" value="1" checked>
          <label class="form-check-label" for="gridRadios1">
            For Sell
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="op" id="gridRadios2" value="2">
          <label class="form-check-label" for="gridRadios2">
            For Exchage
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="op" id="gridRadios3" value="3" >
          <label class="form-check-label" for="gridRadios3">
            Free
          </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="op" id="gridRadios4" value="4">
         <label class="form-check-label" for="gridRadios4" >
         Only Me
          </label>
      </div>
      </div>
    </div>
  </fieldset>
  <div class="form-group row">
    <label for="inputEmail3" class="col-sm-2 col-form-label">Price</label>
    <div class="col-sm-10">
      <input type="number" name="price" class="form-control" id="inputEmail3" <?php echo "value =  $price" ?> placeholder="Price">
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
