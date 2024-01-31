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
<link rel="stylesheet" type="text/css" href="signup.css">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
  <h1>Create Session</h1>
  
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
<h2 align='center'>Create New Session</h2>
  <div class="container">
  <form action="session.php" method="post">
    <div class="row">
    <div class="col-25">
      <label for="pass">Session Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="se" name="session" placeholder="session name..">
    </div>
  </div>
  
  <div class="row">
    <input type="submit" value="Create Session" name="submit">
  </div>
  </form>
</div>
<?php
if(isset($_POST['submit']))
{
	include("../connection.php");
    $id=$_SESSION['user_id'];
    $s=$_POST['session'];
	
	$sql="insert into session(name,status) values('$s',1)";
    if(mysqli_query($con,$sql))
	{
		echo "New session created!";
	}
	else
		echo "error".mysqli_error($con);
}

?>
</div>
<div class="footer">
  <h2>Copyright@puc.cse</h2>
</div>

</body>
</html>
