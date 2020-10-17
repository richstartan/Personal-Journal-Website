<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
	<title>Richie's Personal Journal Website - Search Results</title>
	<link rel="stylesheet" type="text/css" href="CSS/Journal Page.css">
	<link rel="icon" href="Images/logo.png" type="image/gif" sizes="16x16">
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
		<!-- Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Alert Message success for adding an entry in the database -->
     <script type="text/javascript">
            function successMessage(){
                alert("Your Journal Entry was added in the Database!");
            }
        </script>

	<!-- Buttons -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- CKEditor Call Script -->
    <script src="ckeditor/ckeditor.js"></script>

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
  	  <form action="Search Journal Page.php" class="form-inline" method="POST">
    <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search Journal</button>
    <button name="logout" class="btn btn-outline-danger my-2 my-sm-0" type="submit">Log Out</button>
  	</form>
	</nav>

<!-- Navigation Breadcrumb -->
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
    <li class="breadcrumb-item" aria-current="page"><a style="color:#007bff;"; href="Display Earliest Journal Page.php">ENTRIES</a></li>
    <li class="breadcrumb-item">EARLIEST JOURNAL ENTRIES</li>
    <li class="breadcrumb-item">LATEST JOURNAL ENTRIES</li>
    <li class="breadcrumb-item active" aria-current="page">ADD NEW JOURNAL ENTRY</li>
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

    <!-- Journal Entry Being Added -->
    <div class="now">
    <?php
    include ('dbconfig/JournalDatabase.php');
    echo "<p>Journal Entry<br>";
    $date = date("m-d-Y");
    echo "$date</p>";
    ?>
    </div>

<div class="animate-bottom">
	<center><h1 class="entry-title">
    New Journal Entry 
    </h1></center>

    <div class="journal-entry"> <form action="Journal Page.php" method="POST">
    <!-- Title -->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Title:</span>
            </div>
                <input value="" name="title" type="text" class="form-control" placeholder="Title of your Journal Entry" aria-label="Username" aria-describedby="basic-addon1">
        </div>
    <!-- Journal Entry -->
        <center>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">Journal Entry:</span>
            </div>
                <textarea id="my_editor" placeholder="Journal Entry" value="" name="Journal_Entry" class="form-control ckeditor" aria-label="With textarea"></textarea>
                <!-- Script for texteditor here -->
                <script>
                    CKEDITOR.replace('my_editor');
                </script>
        </div>
        </center>
        <br>
        <button onclick="successMessage()" class="btn btn-primary btn-lg btn-block" style="background-color: #5f27cd;" type="submit" value="submit">Submit your Journal Entry</button>
        <!-- Placing the entry and title database -->
        <?php
            if($_SERVER['REQUEST_METHOD'] =='POST'){
                $title = $_POST['title'];
                $J_Entry = $_POST['Journal_Entry'];

                $statement = mysqli_prepare($con, 'INSERT INTO journalentries (title, entry) VALUES (?, ?)');
                mysqli_stmT_bind_param($statement, 'ss', $title, $J_Entry);
                if(mysqli_stmt_execute($statement)){
                    echo '<script type="text/javascript">successMessagesz();</script>';
                }
                else{
                    $error_message = "User login failed. Try again.";
                }
            }
        ?>
    </form>
    </div>

</div>
</body>
</html>