<?php
   session_start();
   if($_SESSION['admin_login_status']!="loged in" and ! isset($_SESSION['user_id']) )
    header("Location:../index.php");
   
   if(isset($_GET['sign']) and $_GET['sign']=="out") {
	$_SESSION['admin_login_status']="loged out";
	unset($_SESSION['user_id']);
   header("Location:../index.php");    
   }
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
  <h1>This is Admin Home Page</h1>
  
</div>

<div class="topnav">
  <a href="home.php">Home</a>
  <a href="session.php">New Session</a>
  <a href="course.php">Create Offer List</a>
  <a href="advisor1.php">Assign Advisor</a>
  <a href="changepass.php" style="float:right">Change Password</a>
  <a href="?sign=out" style="float:right">Logout</a>
</div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
      
      <h5>Today <?php echo date('D M Y');?></h5>
      <div class="fakeimg" style="height:200px;"><img src="scene.jpg" height="100%" width="100%"></div>
      <p>Some text..</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
    </div>
    <div class="card">
      <h5>Today <?php echo date('D:M:Y');?></h5>
      <div class="fakeimg" style="height:200px;">Image</div>
      <p>Some text..</p>
      <p>Sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco.</p>
    </div>
  </div>
  <div class="rightcolumn">
    <div class="card">
      <h2>About Me</h2>
	  <?php
 include("../connection.php");
 $cusid=$_SESSION['user_id'];
 $sql="select name,address,mobile,email,image from customer where cus_id='$cusid'";
 $r=mysqli_query($con,$sql);
 $row=mysqli_fetch_assoc($r);
 $name=$row['name'];
 $image=$row['image'];
 $adds=$row['address'];
 $mbl=$row['mobile'];
 $email=$row['email'];
 echo "<h3>Hello I am $name.</h3>";
 echo "<div class='fakeimg' style='height:100px;'><img src='../uploadedimage/$image' height='80px' width='100px'></div>";
 echo "<p><b>Address:</b> $adds</br><b>Mobile No.:</b> $mbl</br><b>Email:</b> $email</br></p>";
?>  
    </div>
    <div class="card">
      
    </div>
    <div class="card">
      <
    </div>
  </div>
</div>

<div class="footer">
  <h2>Copyright@puc.cse</h2>
</div>

</body>
</html>
