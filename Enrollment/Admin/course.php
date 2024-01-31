<?php
   session_start();
   if($_SESSION['admin_login_status']!="loged in" and ! isset($_SESSION['user_id']) )
    header("Location:../login.php");
   //Sign Out code
   if(isset($_GET['sign']) and $_GET['sign']=="out") {
	$_SESSION['admin_login_status_login_status']="loged out";
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
  <h1>Welcome to Admin Home Page</h1>
  
</div>

<div class="topnav">
  <a href="home.php">Home</a>
  <a href="course.php">Create Offer List</a>
  <a href="advisor1.php">Assign Advisor</a>
  <a href="changepass.php" style="float:right">Change Password</a>
  <a href="?sign=out" style="float:right">Logout</a>
</div>

<div class="row">
<h2 align='center'>Create Offer List</h2>
  <div class="container">
  <form action="course.php" method="post">
    <div class="row">
    <div class="col-25">
      <label for="pass">Course ID</label>
    </div>
    <div class="col-75">
      <input type="text" id="pass" name="cid" ">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="pass">Course Title</label>
    </div>
    <div class="col-75">
      <input type="text" id="pass" name="title">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="sem">Semester</label>
    </div>
    <div class="col-75">
      <select id="dep" name="sem">
        <option value="1">1st</option>
        <option value="2">2nd</option>
        <option value="3">3rd</option>
		<option value="4">4th</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="pass">Credit</label>
    </div>
    <div class="col-75">
      <input type="text" id="pass" name="credit">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="pass">Select Session</label>
    </div>
    <div class="col-75">
	<select name="session">
      <?php
 include("../connection.php");
 $sql="select name from session where status=1";
 $r=mysqli_query($con,$sql);
 
 if(mysqli_num_rows($r)>0)
 {
    
    while($row=mysqli_fetch_array($r))
    {
        $sname=$row['name'];
        echo "<option value='$sname'>$sname</option>";
    }
 }
 else
	{
		echo "error!".mysqli_error($con);
	}

?>
</select>
    </div>
  </div>
  <br>
  <div class="row">
    <input type="submit" value="Save" name="submit">
  </div>
  </form>
</div>
<?php
if(isset($_POST['submit']))
{
	include("../connection.php");
    $cid=$_POST['cid'];
    $title=$_POST['title'];
	$sem=$_POST['sem'];
	$c=$_POST['credit'];
	$s=$_POST['session'];
	$query="insert into course values('$cid','$title','$sem',$c,'$s')";
    mysqli_query($con,$query);
	echo "Successfully Added!";
}

?>
</div>
<div class="footer">
  <h2>Copyright@puc.cse</h2>
</div>

</body>
</html>
