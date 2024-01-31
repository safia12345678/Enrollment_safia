<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="signup.css">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
  <h1>Login Form</h1>
</div>

<div class="row">
  <div class="container">
  <form action="login.php" method="post">
  <div class="row">
    <div class="col-25">
      <label for="userid">User ID</label>
    </div>
    <div class="col-75">
      <input type="text" id="uid" name="id" placeholder="User ID...">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="password">Password</label>
    </div>
    <div class="col-75">
      <input type="password" id="pass" name="pass" placeholder="Password">
    </div>
  </div>
  <div class="row">
    <input type="submit" value="Signin" name="login">
  </div>
  </form>
</div>
</div>

<div class="footer">
  <h2>Copyright@puc.cse</h2>
  
</div>

</body>
</html>

<?php
include("connection.php");
if(isset($_POST['login']))
{
	$id=$_POST['id'];
	$pass=$_POST['pass'];

	$sql="select tid,password from teacher where tid='$id' and password='$pass'";
    $sql2="select id,password from admin where id='$id' and password='$pass'";
	$sql1="select ID,password from  student where ID='$id' and password='$pass'";
            $tr=mysqli_query($con,$sql);
            $sr=mysqli_query($con,$sql1);
			$ad=mysqli_query($con,$sql2);
            if(mysqli_num_rows($ad)==1)
            {
                $_SESSION['user_id']=$id;
                $_SESSION['admin_login_status']="loged in";
                header("Location:Admin/home.php");
            }
            
            else if(mysqli_num_rows($tr)>0)
            {
                $_SESSION['user_id']=$id;
                $_SESSION['teacher_login_status']="loged in";
                header("Location:Teacher/home.php");
            }
			else if(mysqli_num_rows($sr)>0)
            {
                $_SESSION['user_id']=$id;
                $_SESSION['student_login_status']="loged in";
                header("Location:Student/home.php");
            }
            else
            {
                echo "<p style='color: red;'>Incorrect UserId or Password</p>";
            }
	
}
?>