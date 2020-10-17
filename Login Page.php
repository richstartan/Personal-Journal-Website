<?php
	session_start();
	require 'dbconfig/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
	<link rel="stylesheet" type="text/css" href="CSS/Login Page.css">
	<link rel="icon" href="Images/login.png" type="image/gif" sizes="16x16">
	<title>Richie's Personal Journal Website - Login Page</title>
</head>
<body onload="myFunction()" style="margin:0;">

	<div id="loader"></div>
	<div style="display:none;" id="myDiv" class="background animate-bottom">


	<div id="main-wrapper">
		<center>
			<img class="logo-img" src="Images/logo.png"/>
			<div id="pic1" class="feat-img zoom"></div>
			<h2>Log-In to Access My Journal!</h2>
		</center>
	

	<form class="myform" action="Login Page.php" method="POST">
		<label>Username:</label>
		<input name="username" type="text" class="inputvalues" placeholder="Type your Username" required/>
		<br>
		<br>
		<label>Password:</label>
		<input name="password" type="password" class="inputvalues" placeholder="Type your Password" required/>
		<br>
		<input name="login" type="submit" id="login_btn" value="Log-In" />
		<br>
		<center><label class="register_label">Don't have an account yet?</label></center>
		<a href="Register Page.php"><input type="button" id="register_btn" value="Register" /></a>
	</form>

<?php
	if(isset($_POST['login']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$query = "select * from user WHERE username='$username' AND password='$password'";

		$query_run = mysqli_query($con,$query);

		if(mysqli_num_rows($query_run)>0)
		{
			// The user has a valid credentials in the database.
			$_SESSION['username']=$username;
			// header('location:Home Page.php');
					echo "<script>
							alert('Login Successful!');
							window.location.href='Display Earliest Journal Page.php';
						  </script>";
		}
		else
		{
			// The user is invalid and has no credentials in the database.
			echo '<script type="text/javascript">alert("Invalid user credentials!");</script>';
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