<?php
   session_start();
   if($_SESSION['teacher_login_status']!="loged in" and ! isset($_SESSION['user_id']) )
    header("Location:../index.php");
   
   if(isset($_GET['sign']) and $_GET['sign']=="out") {
	$_SESSION['teacher_login_status']="loged out";
	unset($_SESSION['user_id']);
   header("Location:../index.php");    
   }
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="signup.css">
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" type="text/css" href="table.css">
</head>
<body>

<div class="header">
  <h1>This is Teacher Home Page</h1>
  
</div>

<div class="topnav">
  <a href="home.php">Home</a>
  <a href="enrollhistory.php">Enrollment History</a>
  <a href="changepass.php" style="float:right">Change Password</a>
  <a href="?sign=out" style="float:right">Logout</a>
</div>
<div class="container">
  <form action="enrollhistory.php" method="post">
    <div class="row">
  <div class="row">
    <div class="col-25">
      <label for="pass">Select a Session</label>
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
 
  </div>
  
  <br>
  <div class="row">
    <input type="submit" value="Search" name="search">
  </div>
  </form>
</div>
</div>
<?php
 include("../connection.php");
 if(isset($_POST['search']))
 {
 $tid=$_SESSION['user_id'];
 $session=$_POST['session'];
 $_SESSION['sname']=$session;
 $sql="select distinct enroll.SID from enroll,advisor where enroll.SID=advisor.SID and enroll.session='$session' and AID='$tid'";
 $r=mysqli_query($con,$sql);
 echo "<form action='enrollhistory.php' method='post'>";
 echo "<label >Select a Student</label>";
 echo "<select name='sid'>";
 if(mysqli_num_rows($r)>0)
 {
    
    while($row=mysqli_fetch_array($r))
    {
        $id=$row['SID'];
        echo "<option value='$id'>$id</option>";
    }
 }
 else
	{
		echo "error!".mysqli_error($con);
	}
	echo "</select>";
 echo "<input type='submit' value='Search' name='submit'></form>";
 }
 
?>
<?php
 include("../connection.php");
 if(isset($_POST['submit']))
 {
 $sid=$_POST['sid'];
 $session=$_SESSION['sname'];
 $sql="select * from enroll,course where enroll.courseid=course.courseid and enroll.session='$session' and enroll.SID='$sid'";
 $r=mysqli_query($con,$sql);
 echo "<table id='customers'>";
 echo "<tr>
 <th>Course ID</th>
 <th>Coourse Title</th>
 <th>Semester</th>
 <th>Credit</th>
 <th>Exam type</th>
  </tr>";
  $totalc=0;
    while($row=mysqli_fetch_array($r))
    {
        $id=$row['courseid'];
		$title=$row['title'];
		$type=$row['type'];
		$sem=$row['sem'];
		$credit=$row['credit'];
		$totalc=$totalc+$credit;
    echo "<tr>
    <td>$id</td><td>$title</td><td>$sem</td><td>$credit</td><td>$type</td>
    </tr>";
    }
	echo "<tr><td colspan='3' align='right'>Total Credit</td>
	<td colspan='2' align='left'>$totalc</td></tr>";
	echo "</table>";
 }
?>
<div class="footer">
  <h2>Copyright@puc.cse</h2>
</div>

</body>
</html>
