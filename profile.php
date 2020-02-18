<?php
session_start();
$username = "root";
$password = "";
$server = 'localhost';
$db = 'bs';

$connect = mysqli_connect( $server, $username, $password, $db )
    or die("Can not connect");

if (isset($_SESSION['user'])==false) {
  header("Location: /bs/login.php");
}
$user = $_SESSION['user'];
$temp =  mysqli_query( $connect, "select * from profile where id='$user'") or die("Can not execute query");
                        while($temp_value = $temp->fetch_assoc()){
                            $id = $temp_value['id'];
                            $firstname = $temp_value['firstname'];
                            $lastname = $temp_value['lastname'];
                            $email = $temp_value['email'];
                            $phone = $temp_value['phone'];
                            $bio = $temp_value['bio'];
                            $dept = $temp_value['dept'];
                        }  

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>UIU|Book Store</title>
   
    <link href="style/style.css" rel="stylesheet">
    <link href="style/an_style.css" rel="stylesheet">
     <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  
    <!-- For Modal -->
  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css" />
  <link rel="stylesheet" type="text/css" href="font-awesome/css/font-awesome.min.css" />
  <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script> 



</head>
<body>

<!-- Modal for enter new book up-->
           <div class="modal fade" id="add_book" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style="margin-right: 50px;">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            </button>
                            <h4 class="modal-title reg" id="myModalLabel" style="font-weight: bold;">Enter a new book</h4>
                        </div>
                        <div class="modal-body">
                            <form class="pb-modalreglog-form-reg">
                                <div class="form-group">
                                    <label for="inputuserName" style="font-weight: bold;">Book Title</label>
                                    <div class="input-group pb-modalreglog-input-group">
                                        
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Book Title">
                                    </div>
                                </div>

                                <div class="form-group">
                                     <label for="inputuserName" style="font-weight: bold;">Book Aurthor</label>
                                    <div class="input-group pb-modalreglog-input-group">
                                        <input type="text" class="form-control" name="aurthor" id="aurthor" placeholder="Aurthor Name">
                                    </div>
                                </div>

                                 <div class="form-group">
                                     <label for="inputuserName" style="font-weight: bold;">Status</label>
                                    <div class="input-group pb-modalreglog-input-group">
                                        <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="1" checked>
                                                    <label class="form-check-label" for="exampleRadios1" style="padding-left: 20px;">
                                                     For Sell</label>
                                                        </div>
                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="2">
                                                         <label class="form-check-label" for="exampleRadios2" style="padding-left: 20px;">
                                                 For Exchange
                                                                        </label>
                                        </div>
                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status" id="exampleRadios3" value="3">
                                                         <label class="form-check-label" for="exampleRadios3" style="padding-left: 20px;">
                                                 Free
                                                                        </label>
                                        </div>
                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status" id="exampleRadios4" value="4">
                                                         <label class="form-check-label" for="exampleRadios4" style="padding-left: 20px;">
                                                 Only Me
                                                                        </label>
                                        </div>
                                    </div>
                                </div>

                                 <div class="form-group">
                                     <label for="inputuserName" style="font-weight: bold;">Price</label>
                                    <div class="input-group pb-modalreglog-input-group">
                                        <input type="number" class="form-control" name="price" id="price" placeholder="Price">
                                    </div>
                                </div>

                               
                                <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="enter()">Submit</button>
                        </div>
                            </form>
                        </div>
                       
                    </div>
                </div>
            </div>




  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="/bs/book.php"><img src="img/lo.png" width="15%"  alt="" title="" /></img></a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="/bs/book.php">Home</a></li>
           <?php
                echo "<li class='menu-has-children' style='color:white'><a href='#'>$firstname</a>";
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
                    <h1 class="name">Hi, <?php echo "$firstname $lastname";?></h1>
                    <span>WELCOME TO YOUR PROFILE</span>
                </div>
               


                <div class="row">
                    <div class="col-md-3">
                        <div class="personal-details">
                            <strong><?php echo "$id";?></strong>
                            <small>ID NUMBER</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="personal-details">
                            <strong><?php echo "$dept";?></span></strong>
                            <small>DEPARTMENT</small>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="personal-details">
                            <strong>Student</span></strong>
                            <small>STATUS</small>
                        </div>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="personal-details">
                            <strong><?php echo "$email";?></strong>
                            <small>EMAIL ADDRESS</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="personal-details">
                            <strong>+88 <?php echo "$phone";?></strong>
                            <small>PHONE NUMBER</small>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="personal-details">
                            <a href="editaccount.php">Edit Account</a>
                        </div>
                    </div>
                    
                </div>

            </div>
        </div>
    </div>
</header>
<div class="col-md-1"></div>
<center>
<!-- book self -->    
    <div class="container col-md-4"> 
    <h2 style="color: #F68B1F">YOUR BOOKSELF</h2> 
    <a href="#" style="text-align: center;" data-toggle='modal' data-target='#add_book'>Enter a new book</a>        
  <table class="table table-striped" id="myTable">
    <thead>
      <tr style="color:black">
        <th>Book Title</th>
        <th>Author</th>
        <th>Status</th>
        <th>Price</th>
        <th>Edit</th>
        <th>Remove</th>
      </tr>
    </thead>
    <tbody>

        <?php
        $query =  mysqli_query( $connect, "SELECT * FROM book_store where owner='$user'") or die("Can not execute query");
             while($query_value = $query->fetch_assoc()){
                echo "<tr>";
                        $bookid = $query_value['id'];
                        $title = $query_value['title'];
                        $aurthor = $query_value['aurthor'];
                        $status = $query_value['status'];
                        $price = $query_value['price'];
                        echo "<td>$title</td>";
                        echo "<td>$aurthor</td>";
                        echo "<td>$status</td>";
                        echo "<td>$price</td>";
                        echo "<td><a href='editbook.php?id=$bookid' style='color: #F68B1F' role='button'>Edit</a></td>";
                        echo "<td><a style='color: red' role='button' onclick='del(this,$bookid)'>Remove</a></td>";
                echo "</tr>";
            } 
            
        ?>
    </tbody>
  </table>
</div>
</center>
</div>

<div class="col-md-1"></div>

<!-- chat box -->    
    <div class="container col-md-4"> 
    <center><h2 style="color: #F68B1F">CHAT BOX</h2></center>     
    <div class="col-md-12">
        <form action="sendcomment.php">
          <div class="form-group">
            <label for="exampleInputEmail1">Name:</label>
            <input type="text" class="form-control" name="buddy_name" id="buddy_name"   >
            
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Message:</label>
             <textarea name="text" rows="4" cols="25" placeholder="Type your message..."></textarea> 
          </div>

          <button type="submit" class="btn btn-primary" >Submit</button>
        </form>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="exampleInputEmail1">Your Contact</label>
             <div class="table-wrapper-scroll-y my-custom-scrollbar">

  <table class="table table-bordered table-striped mb-0">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Buddy</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $i = 1;
        $query =  mysqli_query( $connect, "SELECT buddy_id FROM buddy where id='$user'") or die("Can not execute query");
             while($query_value = $query->fetch_assoc()){
                echo "<tr>";
                        $buddy_id = $query_value['buddy_id'];
                        $x = (string) $buddy_id;
                        $x = (int) $buddy_id;
                        $query2 =  mysqli_query( $connect, "SELECT firstname FROM profile where id='$buddy_id'") or die("Can not execute query");
                        while($query_value2 = $query2->fetch_assoc()){
                            $buddy_id = $query_value2['firstname'];
                         }
                        echo "<td>$i</td>";
                        $i++;
                        echo "<td><a role='button' onclick='chat($x)'>$buddy_id</a></td>";
                echo "</tr>";
            } 
            
        ?>
    </tbody>
  </table>

</div>
          </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="exampleInputEmail1" style="padding-top: 20px">Chat History</label>
             <div class="table-wrapper-scroll-y my-custom-scrollbar">

  <table class="table table-bordered table-striped mb-0">
    <thead>
      <tr>
        <th scope="col" >Name</th>
        <th scope="col">Chat Messages</th>
        <th scope="col">Date & Time</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $query =  mysqli_query( $connect, "SELECT * FROM chat where user_id='$user' or buddy_id='$user' ORDER BY time_date DESC;") or die("Can not execute query");
             while($query_value = $query->fetch_assoc()){
                echo "<tr>";
                        $user_id = $query_value['user_id'];
                        $query2 =  mysqli_query( $connect, "SELECT firstname FROM profile where id='$user_id'") or die("Can not execute query");
                        while($query_value2 = $query2->fetch_assoc()){
                            $user_id = $query_value2['firstname'];
                         }
                        $buddy_id = $query_value['buddy_id'];
                        $query3 =  mysqli_query( $connect, "SELECT firstname FROM profile where id='$buddy_id'") or die("Can not execute query");
                        while($query_value3 = $query3->fetch_assoc()){
                            $buddy_id = $query_value3['firstname'];
                         }
                        $cmt = $query_value['comment'];
                        $time_date = $query_value['time_date'];
                        $x = $user_id." to ".$buddy_id;
                        echo "<td>$x</td>";
                        echo "<td>$cmt</td>";
                        echo "<td>$time_date</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
  </table>

</div>
          </div>

    </div>
</div>



</div>
<script type="text/javascript">
    
     
    function del(r,x) {
      var i = r.parentNode.parentNode.rowIndex;
      var r = confirm("Do you want to delete the entry!");
      if (r == true) {
        document.getElementById("myTable").deleteRow(i);
        console.log(x);
        $.post('removebook.php',{rec:x},function(data){});
      }    
    }

    function enter() {
      var title = document.getElementById("title").value;
      var aurthor = document.getElementById("aurthor").value;
      var status = document.querySelector('input[name="status"]:checked').value;
      var price = document.getElementById("price").value;
      var r = confirm("Do you want to enter the entry!");
      if (r == true) {
        console.log(title);
        $.post('enterbook.php',{title:title,aurthor:aurthor,status:status,price:price},function(result){
           console.log(result);
           var id = result;
        });
        if(status == 1)
            status = "For Sell";
        else if(status == 2)
            status = "For Exchange";
        else if(status == 3)
            status = "Free";
        else 
            status = "Only Me";

        var myHtmlContent = "<tr><td>"+title+"</td><td>"+aurthor+"</td><td>"+status+"</td><td>"+price+"</td><td><a href='editbook.php?&id' style='color: #F68B1F' role='button'>Edit</a></td><td><a style='color: red' role='button'  onclick='del(this,id)'>Remove</a></td></tr>";
        var table = document.getElementById('myTable').getElementsByTagName('tbody')[0];
        var newRow   = table.insertRow(table.rows.length);
        newRow.innerHTML = myHtmlContent;
        $('#add_book').modal('hide');

      }   
    }

    function chat (member){
        var member = '0'.concat(member);
        document.getElementById('buddy_name').value = member;
        console.log(member);
    } 


 
</script>
</body>
</html>