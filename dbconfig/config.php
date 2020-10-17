<?php
	$con = mysqli_connect("localhost", "logindb", "") or die("Connection failed: " . mysqli_connect_error());
	mysqli_select_db($con,'logindb');
?>