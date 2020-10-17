<?php
    include ('dbconfig/JournalDatabase.php');
    if(!isset($_GET['id'])){
        $error_message = "Invalid access! User ID is required.";
    }

    else{
        $user_id = $_GET['id'];
        $statement = mysqli_prepare($con, 'DELETE FROM journalentries WHERE id = ?');
        mysqli_stmt_bind_param($statement, 'i', $user_id);
        if(mysqli_stmt_execute($statement)){
            header("Location: Display Earliest Journal Page.php");
        }
        else{
            $error_message = "User deletion failed. Try again!";
        }
    }
?>