<?php
##$servername = "localhost";
#$dbname = "journaldatabase";
#$conn = mysqli_connect($servername, $dbname);
#if (!$conn) {
#    die("Connection failed: " . mysqli_connect_error());
#}
?>

<?php
	$con = mysqli_connect("localhost", "journaldatabase", "") or die("Connection failed: " . mysqli_connect_error());
	mysqli_select_db($con,'journaldatabase');
?>