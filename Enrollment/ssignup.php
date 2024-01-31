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
<h2 align='center'>Student Registration Form</h2>
  <div class="container">
  <form action="ssignup.php" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="col-25">
      <label for="tid">Student ID</label>
    </div>
    <div class="col-75">
      <input type="text" id="sid" name="sid" placeholder="Your id.." required>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="name">Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="name" name="name" placeholder="Your name..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="email">Batch</label>
    </div>
    <div class="col-75">
      <input type="text" id="batch" name="batch" placeholder="Your batch..">
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
      <label for="mobile">Mobile No.</label>
    </div>
    <div class="col-75">
      <input type="text" id="mobile" name="mobile" placeholder="Your mobile no..">
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
	$name=$_POST['name'];
	$batch=$_POST['batch'];
	$dept=$_POST['dept'];
	$mobile=$_POST['mobile'];
	$id=$_POST['sid'];
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
	 
	
	
	$query="insert into student values('$id','$name',$mobile,'$dept',$batch,'$image','$pass')";
	if(mysqli_query($con,$query))
	{
		echo "Successfully inserted!";
		if($image !=null){
	                move_uploaded_file($_FILES['pic']['tmp_name'],"Simage/$image");
                    }
    }
	else
	{
		echo "error!".mysqli_error($con);
	}
}
?>