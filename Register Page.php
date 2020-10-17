<?php
	require 'dbconfig/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
	<link rel="stylesheet" type="text/css" href="CSS/Register Page.css">
	<link rel="icon" href="Images/register.png" type="image/gif" sizes="16x16">
	<title>Richie's Personal Journal Website - Register Page</title>
</head>
<body onload="myFunction()" style="margin:0;">

	<div id="loader"></div>
	<div style="display:none;" id="myDiv" class="background animate-bottom">


	<div id="main-wrapper">
		<center>
			<img class="logo-img" src="Images/logo.png"/>
			<div id="pic1" class="feat-img zoom"></div>
			<h2>Register an Account</h2>
		</center>
	

	<form class="myform" action="Register Page.php" method="POST">
		<label>Register Username:</label>
		<input name="username" type="text" class="inputvalues" placeholder="Type your Username" required/>
		<br>
		<br>
		<label>Register Password:</label>
		<input name="password" type="password" class="inputvalues" placeholder="Type your Password" required/>
		<br>
		<br>
		<label>Confirm Password:</label>
		<input name="cpassword" type="password" class="inputvalues" placeholder="Confirm Password" required/>
		<input name="submit_btn" type="submit" id="signup_btn" value="Sign Up" />
		<br>
		<a href="Login Page.php"><input type="button" id="back_btn" value="Back to Log-In" /></a>
	</form>

<?php
	if(isset($_POST['submit_btn']))
	{
		//echo '<script type="text/javascript>alert("Account successfully created!");</script>';

		$id = $_POST['id'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$cpassword = $_POST['cpassword'];

		if($password==$cpassword)
		{
			$query = "select * from user WHERE username = '$username'";
			$query_run = mysqli_query($con,$query);

			if(mysqli_num_rows($query_run)>0)
			{
				// There is already a user with the same username
				echo '<script type="text/javascript">alert("Username already exist!");</script>';
			}
			else
			{
				$query = "Insert into user values('$id', '$username', '$password')";
				$query_run = mysqli_query($con,$query);

				if($query_run)
				{
					// header('location:Login Page.php');
					// echo '<script type="text/javascript">alert("Account successfully created!");</script>';
					echo "<script>
							alert('Account successfully created!');
							window.location.href='Login Page.php';
						  </script>";
				}
				else
				{
					echo '<script type="text/javascript">alert("Error!");</script>';
				}
			}
		}
		else
		{
			echo '<script type="text/javascript">alert("Password and Confirm Password does not match!");</script>';
		}
	}
?>

	</div>

	<script type="text/javascript" src="JS/jquery-1.11.3.min.js"></script>
	<script type="text/javascript">
		var myVar;

function myFunction() {
  myVar = setTimeout(showPage, 300);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
		$(document).ready(function(){

			/*! Fades in page on load */
			$('body').css('display', 'none');
			$('body').fadeIn(500);
		});
		 //$(document).ready(function () { $('div').hide().fadeIn(1500).delay(4000)});
		/*$(document).ready(function() {
			$('a').click(function() {
				// alert("Are you sure you want to visit this website?");
				var selected = $(this);
				$('a').removeClass('active');
				$(selected).addClass('active');
			});
			
			var $a = $('.a'),
				$b = $('.b'),
				$c = $('.c'),
				$d = $('.d'),
				$e = $('.e'),
				$home = $('.home'),
				$home = $('.aboutus');
			
			$a.click(function() {
				$home.fadeIn();
				$aboutus.fadeOut();
			});
			$b.click(function() {
				$aboutus.fadeIn();
				$home.fadeOut();
			});
		});*/
	</script>

</body>
</html>