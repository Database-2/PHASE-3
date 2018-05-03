<?php
include 'config.php';
session_start();

// Set up user and ids 
if(!isset($_SESSION['uid'])){
  header("Location: login.php");
  exit();
}
$user_uid = "";
if(isset($user_uid)){
$user_uid = $_SESSION['uid'];
}

//get data and time
$da = date_default_timezone_set("America/New_York");
$d = date("Y-m-d h:i:sa");
 
$user_enter = $commenter_enter= "";

// Set up comment body, the button clicked and the tweet id
if(isset($_POST['u_commenter'])){
	$user_enter = $_POST['u_commenter'];
}
if(isset($_POST['user_click'])){
	$commenter_enter = $_POST['user_click'];
}
if(isset($_POST['tid'])){
	$tidl = $_POST['tid'];
}

// If the commenter submitted and the comment body isn't empty
// add the comment to comment
if ($commenter_enter) {
   if (empty($user_enter)){
		// Enter a comment temporary message
		$_SESSION['temp_comm']  = "Please enter a comment.";
	}else{
		// Add comment to comment
		$sql_comm = "INSERT INTO `comment`(`uid`, `tid`, `body`, `comment_time`) 
					 VALUES ('$user_uid', '$tidl', '$user_enter','$d')";
		$result_user_comm =$conn->query($sql_comm);
		// Clear the comment meeage box
		$_SESSION['temp_comm'] = "";
		// Refresh home page
		echo "<meta http-equiv='refresh' content='0;url=home.php'>";
	}
}
?>