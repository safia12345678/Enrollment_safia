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
<link rel="stylesheet" type="text/css" href="signup.css">
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
<h2 align='center'>Enrollment Form</h2>
  <div class="container">
  <form action="enroll.php" method="post">
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
 <div class="row">
<div class="col-25">
      <label for="pass">Select a Semester</label>
</div>
    <div class="col-75">
	<select name="sem">
      <?php
 $sql="select distinct sem from course";
 $r=mysqli_query($con,$sql);
 
 if(mysqli_num_rows($r)>0)
 {
    
    while($row=mysqli_fetch_array($r))
    {
        $s=$row['sem'];
        echo "<option value='$s'>$s</option>";
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
    <input type="submit" value="Search" name="submit">
  </div>
  </form>
</div>
<?php
if(isset($_POST['submit']))
{
	include("../connection.php");
    $session=$_POST['session'];
	$sem=$_POST['sem'];
	$_SESSION['sname']=$session;
	$_SESSION['sem']=$sem;
	$sql="select * from course where sem=$sem and session='$session' order by courseid ASC";
    $r=mysqli_query($con,$sql);
echo "<form action='enroll.php' method='post'>";

    if(mysqli_num_rows($r)>0)
    {
echo "<table align='center'>";
echo "<tr><th>Course ID</th><th>Course Title</th><th>Exam Type</th>
</tr>";
              while($row=mysqli_fetch_array($r))
              {
                $cid=$row['courseid'];
                $title=$row['title'];
                echo "<tr><td>$cid</td><td>$title</td>
				<td><input type='radio' name='course_exam_data[$cid]' value='regular'>Regular
        <input type='radio' name='course_exam_data[$cid]' value='recourse'>Recourse
        <input type='radio' name='course_exam_data[$cid]' value='retake'>Retake
		</td></tr>";
              } 
echo "</table>";
echo "<input name='insert' type='submit' value='Enroll'/>";
echo "</form>";  
}
else
{
	echo mysqli_error($con);
}
}

?>
<?php
if(isset($_POST['insert']))
      {
        $sid=$_SESSION['user_id'];
		$sem=$_SESSION['sem'];
		$session=$_SESSION['sname'];
		$course_exam_data = $_POST['course_exam_data'];
        include("../connection.php");
        foreach($course_exam_data as $course => $exam_type)
        {
			$query="insert into enroll values('$sid','$course','$sem','$session','$exam_type')";
            mysqli_query($con,$query);
		}
		echo "Successfully Enrolled!";
	  }	
		
?>
</div>
<div class="footer">
  <h2>Copyright@puc.cse</h2>
</div>

</body>
</html>
