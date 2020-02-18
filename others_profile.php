<?php
session_start();
$username = "root";
$password = "";
$server = 'localhost';
$db = 'bs';

$link = "/media24/processcart.php";
$connect = mysqli_connect( $server, $username, $password, $db )

    or die("Can not connect");

if (isset($_SESSION['user'])==false) {
  header("Location: /bs/login.php");
}
$user = $_SESSION['user'];
$owner = ($_GET ["id"]);
$temp =  mysqli_query( $connect, "select * from profile where id='$owner'") or die("Can not execute query");
                        while($temp_value = $temp->fetch_assoc()){
                            $id = $temp_value['id'];
                            $firstname = $temp_value['firstname'];
                            $lastname = $temp_value['lastname'];
                            $email = $temp_value['email'];
                            $phone = $temp_value['phone'];
                            $bio = $temp_value['bio'];
                            $dept = $temp_value['dept'];
                        }  
$temp =  mysqli_query( $connect, "select * from profile where id='$user'") or die("Can not execute query");
                        while($temp_value = $temp->fetch_assoc()){
                            $fname = $temp_value['firstname'];
                        }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <title>UIU|Student Portal</title>
    <!-- Style CSS -->
    

  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">

   <link href="style/style.css" rel="stylesheet">
    <link href="style/an_style.css" rel="stylesheet">
    <!-- For Sign UP Modal -->
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
 
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
                echo "<li class='menu-has-children' style='color:white'><a href='#'>$fname</a>";
                echo "<ul>";
                echo "<li style='background-color:black'><a style='color:white' href='/bs/profile.php'>Your Profile</a></li>";
                echo "<li style='background-color:black'><a style='color:white' href='/bs/logout.php'>Log Out</a></li>";
                echo "</ul>";
                echo "</li>";
            ?>
         
        </ul>
      </nav>
    </div>
  </header>



<div id="main-wrapper">
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="profile-img">
                    <img src="img/demo.png" class="img-responsive" alt=""/>
                </div>

            </div>
            <div class="col-md-9">
                <div class="name-wrapper">
                    <h1 class="name">Hi, I'm <?php echo "$firstname $lastname";?></h1>
                    <span style="color: #F68B1F">WELCOME TO MY PROFILE</span>
                </div>
                

                <div class="row">
                    <div class="col-md-3">
                        <div class="personal-details">
                            <strong style="color: #F68B1F"><?php echo "$id";?></strong>
                            <small>ID NUMBER</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="personal-details">
                            <strong style="color: #F68B1F"><?php echo "$dept";?> </span></strong>
                            <small>DEPARTMENT</small>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="personal-details">
                            <strong style="color: #F68B1F">Student</span></strong>
                            <small>STATUS</small>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="personal-details">
                            <strong style="color: #F68B1F"><?php echo "$email";?></strong>
                            <small>EMAIL ADDRESS</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="personal-details">
                            <strong style="color: #F68B1F">+88 <?php echo "$phone";?></strong>
                            <small>PHONE NUMBER</small>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</header>
<!-- .header-->

<center>
<div class="col-md-4"></div>
    
    <div class="container col-md-4"> 
    <h2 style="color: #F68B1F">My BookShelf</h2>         
  <table class="table table-striped">
    <thead>
      <tr style="color:black">
        <th style="color: #F68B1F">Book Title</th>
        <th style="color: #F68B1F">Author</th>
        <th style="color: #F68B1F">Status</th>
        <th style="color: #F68B1F">Price</th>
       
      </tr>
    </thead>
    <tbody>

        <?php
        $query =  mysqli_query( $connect, "SELECT * FROM book_store where owner='$owner'") or die("Can not execute query");
             while($query_value = $query->fetch_assoc()){
                if($query_value['status']!="Only Me"){
                    echo "<tr>";
                        $bookid = $query_value['id'];
                        $title = $query_value['title'];
                        $aurthor = $query_value['aurthor'];
                        $status = $query_value['status'];
                        $price = $query_value['price'];
                        //$title = $row['title'];
                        echo "<td>$title</td>";
                        echo "<td>$aurthor</td>";
                        echo "<td>$status</td>";
                        echo "<td>$price</td>";
                       
                echo "</tr>";
                }
                
            } 
           
        ?>
    </tbody>
  </table>
</div>
<div class="col-md-1"></div>


    
</center>

</div>

</body>
</html>