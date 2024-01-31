<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="signup.css">
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="header">
  <h1>Simple Database Management Project</h1>
  <p>Practice, Practice, Practice, &...</p>
</div>

<div class="topnav">
  <a href="index.php">Home</a>
  <a href="#">About</a>
  <a href="ssignup.php">Student SignUp</a>
  <a href="tsignup.php">Teacher SignUp</a>
  <a href="login.php" style="float:right">Login</a>
</div>

<div class="row">
<h2 align='center'>Teacher Registration Form</h2>
  <div class="container">
  <form action="tsignup.php" method="post" enctype="multipart/form-data">
<div class="row">
    <div class="col-25">
      <label for="tid">User ID</label>
    </div>
    <div class="col-75">
      <input type="text" id="tid" name="tid" placeholder="Your user id..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="name">Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="fname" name="name" placeholder="Your name..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="des">Designation</label>
    </div>
    <div class="col-75">
      <input type="text" id="des" name="desig" placeholder="Your designation..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="dept">Department Name</label>
    </div>
    <div class="col-75">
      <select id="dep" name="dept">
        <option value="CSE">CSE</option>
        <option value="EEE">EEE</option>
        <option value="Arc">ARC</option>
      </select>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="dob">Date of Birth</label>
    </div>
    <div class="col-75">
      <input type="date" id="dob" name="dob" >
	  </div>
  </div>
  
  <div class="row">
    <div class="col-25">
      <label for="image">Picture</label>
    </div>
    <div class="col-75">
      <input type="file" id="image" name="pic">
	  </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="pass">Password</label>
    </div>
    <div class="col-75">
      <input type="password" id="pass" name="pass" placeholder="Your password..">
    </div>
  </div>
  <div class="row">
    <input type="submit" value="Submit" name="submit">
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
if(isset($_POST['submit']))
{
$id=$_POST['tid'];	
$tname=$_POST['name'];
	$desig=$_POST['desig'];
	$dept=$_POST['dept'];
	$dob=$_POST['dob'];
	$pass=$_POST['pass'];
	//customer id generation
	$num=rand(10,100);
	$cus_id="c-".$num;
	
	//image upload code
	$ext= explode(".",$_FILES['pic']['name']);
    $c=count($ext);
    $ext=$ext[$c-1];
    $date=date("D:M:Y");
    $time=date("h:i:s");
    $image_name=md5($date.$time.$cus_id);
    $image=$image_name.".".$ext;
	 
	
	
	$query="insert into teacher values('$id','$tname','$dept','$desig','$dob','$image','$pass')";
	if(mysqli_query($con,$query))
	{
		echo "Successfully inserted!";
		if($image !=null){
	                move_uploaded_file($_FILES['pic']['tmp_name'],"Timage/$image");
                    }
    }
	else
	{
		echo "error!".mysqli_error($con);
	}
}
?>