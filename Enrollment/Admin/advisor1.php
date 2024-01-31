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
<h2 align='center'>Assign Advisor to the Students</h2>
  <div class="container">
  <form action="advisor1.php" method="post">
    <div class="row">
  <div class="row">
    <div class="col-25">
      <label for="pass">Select a Batch</label>
    </div>
    <div class="col-75">
	<select name="batch">
      <?php
 include("../connection.php");
 $sql="select distinct batch from student";
 $r=mysqli_query($con,$sql);
 
 if(mysqli_num_rows($r)>0)
 {
    
    while($row=mysqli_fetch_array($r))
    {
        $b=$row['batch'];
        echo "<option value='$b'>$b</option>";
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
    $batch=$_POST['batch'];
	$sql="select ID,name from student where batch=$batch order by ID ASC";
    $r=mysqli_query($con,$sql);
echo "<form action='advisor1.php' method='post'>";
echo "<label for='s'>Select Session</label><select name='session'>";
 $sql1="select name from session where status=1";
 $r1=mysqli_query($con,$sql1);
 
 if(mysqli_num_rows($r1)>0)
 {
    
    while($row=mysqli_fetch_array($r1))
    {
        $sname=$row['name'];
        echo "<option value='$sname'>$sname</option>";
    }
 }
 else
	{
		echo "error!".mysqli_error($con);
	}
echo "</select>";
echo "<label for='adv'>Select Advisor</label><select name='adv'>";
 $sql2="select tid,name from teacher";
 $r2=mysqli_query($con,$sql2);
 
 if(mysqli_num_rows($r2)>0)
 {
    
    while($row=mysqli_fetch_array($r2))
    {
        $tid=$row['tid'];
		$tname=$row['name'];
        echo "<option value='$tid'>$tname</option>";
    }
 }
 else
	{
		echo "error!".mysqli_error($con);
	}
echo "</select>";
    if(mysqli_num_rows($r)>0)
    {
echo "<table align='center'>";
echo "<tr><th>Student Id</th><th>Student Name</th></tr>";
              while($row=mysqli_fetch_array($r))
              {
                $s_id=$row['ID'];
                $s_name=$row['name'];
                echo "<tr><td><input  type='checkbox' value='$s_id' name='sid[]'/>$s_id</td>
                &nbsp;&nbsp;&nbsp;&nbsp;<td>$s_name</td></tr>";
              } 
echo "</table>";
echo "<input name='insert' type='submit' value='Assign'/>";
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
        $sid=$_POST['sid'];
		$aid=$_POST['adv'];
		$session=$_POST['session'];
        include("../connection.php");
        foreach($sid as $item)
        {
            $id=$item;
			$query="insert into advisor values('$aid','$id','$session')";
            mysqli_query($con,$query);
		}
		echo "Successfully Assigned!";
	  }	
		
?>
</div>
<div class="footer">
  <h2>Copyright@puc.cse</h2>
</div>

</body>
</html>
