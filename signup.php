<?php  
require_once "config.php";
	if (isset($_POST['submit'])) 
	{
		$userdata=new DB_con();
		$name=$_POST['name'];
		$username=$_POST['username'];
		$mobile=$_POST['mobile'];
		$password=$_POST['password'];
		$password2=$_POST['password2'];
		if($name==""||$username==""||$mobile==""||$password==""||$password2==""){
			echo "<p style='background-color:red'>enter each feild</p>";
		}
		else{
			if ($password==$password2) 
			{
				$sql=$userdata->registration($name,$username,$mobile,$password);
				if($sql)
				{

					echo "<script>alert('Registration successfull.');</script>";
					echo "<script>window.location.href='login.php'</script>";
				}
				else{
					echo "<script>alert('Something went wrong. Please try again');</script>";
				}
			}
			else{
				echo "<p style='background-color:red'>passwords don't match</p>";
			}
		}
	
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>sign up</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<style>
		body{
			
			
			text-align: center;
			background-image: url("taxi.jpg");
  			background-size: cover;
  			background-repeat: no-repeat;
		}
		#a{
			/*margin-top: 7%;*/
			width: 40%;
			background-color: #ffff33;
			margin-left: 25%;
			padding: 2%;
			border-radius: 10%;
			opacity: 0.9;
		} footer a{ color: blue; }
		span,p,h1,a{
			color: orange;
		}
	</style>
	<script>
	function check(va) 
	{
		$.ajax
		({
			type: "POST",
			url: "check.php",
			data:{username:va},
			success: function(data)
			{
				$("#user").html(data);
			}
		});

	}
</script>
</head>
<body>
 <section class="">
  <nav class="navbar navbar-expand-lg navbar-light py-0"style="background-color: #fabd06;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="index.php"><p id="logo">Ced<span id="clr">Cab</span></p></a>
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item active">
          <a href="login.php" type="button" class="btn btn-success">Login</a>
        </li>
      </ul>
    </div>
  </nav>
</section>
	
	<div id="a">
		<h1><strong>SIGNUP</strong></h1>
	<form action="" method="post">
	<p><span>Name</span>
		<input type="text" name="name" placeholder="enter your full Name " pattern="^[a-zA-Z ]*$" id="name">
	</p>
	<p>
		<span>username</span>
		<input type="text" name="username" placeholder="enter username " onblur="check(this.value)" id="username" pattern="[a-zA-Z][a-zA-Z0-9-_\.]{1,20}">

		<span id="user"></span>
	</p>
	<p>
		<span>mobile number</span>
		<input type="text" name="mobile" placeholder="enter mobile number " pattern="[1-9]{1}[0-9]{9}" id="mobile">
	</p>
	<p>
		<span>password</span>
		<input type="password" name="password" placeholder="password" pattern=".{8,}" id="password">
		<span id="password"></span>
	</p>
	<p>
		<span>confirm password</span>
		<input type="password" name="password2" placeholder="confirm password" id="password2">
	</p>
	<p>
		<input type="submit" name="submit" id="submit" class="btn btn-primary">
	</p>
	</form>
	<p>already a user? <a href="login.php">sign in</a>
	</p>

</div>


<?php include "footer.php"; ?>
</body>
</html>