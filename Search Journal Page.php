<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
	<title>Richie's Personal Journal Website - Search Results</title>
	<link rel="stylesheet" type="text/css" href="CSS/Search Journal Page.css">
	<link rel="icon" href="Images/logo.png" type="image/gif" sizes="16x16">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
		<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	<!-- Buttons -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- Fontawesome -->
    <script src="https://kit.fontawesome.com/23b708834a.js" crossorigin="anonymous"></script>
</head>
<body>

	<nav class="navbar sticky-top navbar-dark" style="background-color: #130f40;">
		<!-- Navbar content -->
	<a class="navbar-brand" href="Display Earliest Journal Page.php">
    <img id="logo" src="Images/logo.png" class="d-inline-block align-top" alt="Richie's Logo">
  	</a>
  	<h3 class="welcome-title">Welcome to my Journal, <u><?php echo $_SESSION['username'] ?>!</u></h3>
  	  <form action="" class="form-inline" method="POST">
    <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search Journal</a></button>
    <button name="logout" class="btn btn-outline-danger my-2 my-sm-0" type="submit">Log Out</button>
  	</form>
	</nav>

<!-- Navigation Breadcrumb -->
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a style="color:#007bff;"; href="Display Earliest Journal Page.php">ENTRIES</a></li>
    <li class="breadcrumb-item">EARLIEST JOURNAL ENTRIES</li>
    <li class="breadcrumb-item">LATEST JOURNAL ENTRIES</li>
    <li class="breadcrumb-item active" aria-current="page">SEARCH RESULTS</li>
    </ol>
    </nav>


	<!-- If the User wants to Log Out -->
	<?php
		if(isset($_POST['logout']))
		{
			session_destroy();
			header('location: Login Page.php');
		}
	?>
	<br>
<div class="animate-bottom">
	<center><h1 class="entry-title">
    <!-- Just to display the text being searched -->
            Search Result(s) for :  <?php
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $search = $_POST['search'];
                echo $search;
            }
    ?>   
    </h1></center>


    <div class="entries">
        <!-- Display Journal Entries from database that has the "text" being searched -->
<?php
    include('dbconfig/JournalDatabase.php');
    $sql = "SELECT * FROM journalentries WHERE entry like '%".$search."%' || title like '%".$search."%' ";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result)<= 0){
        echo "No entries found";
    }
    else{
        echo "<table>
            <th>Date & Time</th>
            <th>Journal Title</th>
            <th>Journal Entry</th>
            <th>Option</th>
        ";


        while($row = mysqli_fetch_assoc($result)){
            echo "<tr><td style='display:none;'>".$row["ID"]."</td><td>".$row["dateandtime_entry"]."</td>"
            
            ."<td>".$row["title"]."</td>"
            
            ."<td>".$row["entry"]."</td>".
            
            "<td>"."<a class='btn btn-success' href='Update Journal Page.php?id=$row[ID]'>"."<i class='fas fa-edit'></i>"."</a>"

            ." <a class='btn btn-danger' href='Delete Journal.php?id=$row[ID]'>"."<i class='fas fa-trash-alt'></i>"."</td>"."</a>";
        }
        echo "</table>";
    }
?>
<br>
<br>
<a href="Journal Page.php" class="btn btn-primary btn-lg btn-block" style="background-color: #5f27cd;">Add New Journal Entry</a>
<br>
    </div>
</div>
</body>
</html>