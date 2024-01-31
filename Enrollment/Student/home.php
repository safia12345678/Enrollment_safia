<?php
   session_start();
   if($_SESSION['student_login_status']!="loged in" and ! isset($_SESSION['user_id']) )
    header("Location:../login.php");
   //Sign Out code
   if(isset($_GET['sign']) and $_GET['sign']=="out") {
	$_SESSION['student_login_status']="loged out";
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
  <h1>This is Student Home Page</h1>
  
</div>

<div class="topnav">
  <a href="home.php">Home</a>
  <a href="enroll.php">Enrollment</a>
  <a href="enrollshow.php">Enrollment Report</a>
  <a href="changepass.php" style="float:right">Change Password</a>
  <a href="?sign=out" style="float:right">Logout</a>
</div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
      
      <h5>Today <?php echo date('d m y');?></h5>
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
 $sid=$_SESSION['user_id'];
 $sql="select name,dept,mobileno,pic from student where ID='$sid'";
 $r=mysqli_query($con,$sql);
 $row=mysqli_fetch_assoc($r);
 $name=$row['name'];
 $image=$row['pic'];
 $dept=$row['dept'];
 $mbl=$row['mobileno'];
 echo "<h3 >Hello I am $name.</h3><br>";
 echo "<h3>ID# $sid.</h3>";
 echo "<div class='fakeimg' style='height:100px;'><img src='../Simage/$image' height='80px' width='100px'></div>";
 echo "<p><b>Department:</b> $dept</br><b>Mobile No.:</b> $mbl</p>";
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
