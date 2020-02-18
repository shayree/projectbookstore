<?php

session_start();

$username = "root";
$password = "";
$server = 'localhost';
$db = 'bs';

$link = "/bs/logout.php";
$connect = mysqli_connect( $server, $username, $password, $db )
    or die("Can not connect");

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
}
else 
  header("Location: /bs/login.php");

$temp =  mysqli_query( $connect, "select * from profile where id='$user'") or die("Can not execute query");
                        while($temp_value = $temp->fetch_assoc()){
                            $firstname = $temp_value['firstname'];                            
                        }  
  /*                      
$temp =  mysqli_query( $connect, "select * from book_store") or die("Can not execute query");
                        while($temp_value = $temp->fetch_assoc()){
                            $title = $temp_value['title'];
                            $aurthor = $temp_value['aurthor'];
                            $status = $temp_value['status'];
                            $price = $temp_value['title'];                            
                        }  */
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>UIU|Book Store</title>

  

    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  
    <link href="style/an_style.css" rel="stylesheet">
  
     <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
    <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
    <link  rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
     $(document).ready(function () {
      $('#myTable').DataTable();
      $('.dataTables_length').addClass('bs-select');
    });    
   </script>
</head>

<body>

  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="/bs/book.php"><img src="img/lo.png" width="15%"  alt="" title="" /></img></a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="/bs/book.php">Home</a></li>
           <?php
                echo "<li class='menu-has-children' style='color:white'><a href='/bs/profile.php'>$firstname</a>";
                echo "<ul>";
                echo "<li style='background-color:black'><a style='color:white' href='/bs/profile.php'>Your Profile</a></li>";
                echo "<li style='background-color:black'><a style='color:white' href='/bs/logout.php'>Log Out</a></li>";
                echo "</ul>";
                echo "</li>";
            ?>
          <li><a href="#contact">Contact Us</a></li>
        </ul>
      </nav>
    </div>
  </header>

<div>
  
  <img style="width: 100%;height: 900px;" src="img/book.jpg">
</div>
  <main id="main">
    <section id="portfolio">
      <div class="container  col-md-12">
        <div class="section-header">
          <h3 class="section-title"  style="color: #F68B1F">Virtual Book Shelf</h3>
        </div>
 
      <div class="row" id="portfolio-wrapper">
          <div class="col-md-12 portfolio-item " style="height: auto">
            <table class="table" id="myTable">
  <thead>
    <tr>

      <th scope="col" style="color: #F68B1F">Book Title</th>
      <th scope="col"  style="color: #F68B1F">Book Aurthor</th>
      <th scope="col"  style="color: #F68B1F">Status</th>
      <th scope="col"  style="color: #F68B1F">price</th>
      <th scope="col"  style="color: #F68B1F">Owner</th>
      <th scope="col"  style="color: #F68B1F">Contact</th>
    </tr>
  </thead>
  <tbody>
    <?php
        $query =  mysqli_query( $connect, "SELECT * FROM book_store") or die("Can not execute query");
             while($query_value = $query->fetch_assoc()){
              if($query_value['status'] != "Only Me"){
                echo "<tr>";
                        $title = $query_value['title'];
                        $owner = $query_value['owner'];
                        $aurthor = $query_value['aurthor'];
                        $status = $query_value['status'];
                        $price = $query_value['price'];
                        
                        $x = (string)$owner;
                        $y = (int)$x;
                        //echo $x;
                        echo "<td>$title</td>";
                        echo "<td>$aurthor</td>";
                        echo "<td>$status</td>";
                        echo "<td>$price</td>";
                        if($owner != $user){
                          echo "<td><a href='others_profile.php?id=$owner' style='color:#5a5d43;'  role='button'>$owner</a></td>";
                          echo "<td><a style='cursor:pointer' role='button' onclick='buddy($y)'>Send Message</a></td>";
                        }   
                          
                        else{
                          echo "<td><a href='profile.php' style='color:#5a5d43;'  role='button'>$owner</a></td>";
                          echo "<td><a style='cursor:pointer' role='button' >Send Message</a></td>";
                        }
                        
                echo "</tr>";
              }
                
            } 
            $connect->close();
        ?>
  </tbody>
</table>
          </div>
      </div>
      
    </section>


    <section id="contact">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h3 class="section-title">Contact</h3>
          <p class="section-description">We are willing to know your queries.</p>
        </div>
      </div>

      <div class="container ">
        <div class="row justify-content-center">

          <div class="col-lg-3 col-md-4">

            <div class="info">
              <div>
                <i class="fa fa-map-marker"></i>
                <p>Satarkul, Badda<br>Dhaka, 1219</p>
              </div>

              <div>
                <i class="fa fa-envelope"></i>
                <p>info@uiu.com</p>
              </div>

              <div>
                <i class="fa fa-phone"></i>
                <p>+88 0155 555 555</p>
              </div>
            </div>

          </div>

          <div class="col-lg-5 col-md-8">
            <div class="form">
              <form action="sendmessage.php" >
                <div class="form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder=<?php  echo $user;?> disabled/>
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject"/>
                  <div class="validation"></div>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
                  <div class="validation"></div>
                </div>
                <div class="text-center"><button type="submit">Send Message</button></div>
              </form>
            </div>
          </div>

        </div>

      </div>
    </section>

  <footer id="footer">
    <div class="footer-top">
      <div class="container">

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>United International University</strong>. All Rights Reserved.
      </div>
    </div>
  </footer>

  </main>

 <script type="text/javascript">
   function buddy(y) {
      $.post('addbuddy.php',{id:y},function(data){});
      //document.getElementById("demo").innerHTML = "Hello World";
      console.log(y);
    }
 </script>


</body>
</html>
