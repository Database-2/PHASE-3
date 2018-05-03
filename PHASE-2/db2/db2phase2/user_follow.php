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
 
 if( isset($_GET['fol']) ) {
	$id = $_GET['fol'];
	//check for duplicates
	$get_num_username = "SELECT `following_id` FROM `follow` WHERE follower_id = $user_uid AND `following_id` = $id";
	$check_for_username = mysqli_query($conn,$get_num_username);

	// If you are already following the user then refresh the home page,
	//   if not then follow the user.
	if (mysqli_num_rows($check_for_username) > 0) {
		// Refreshes home page
		echo "<meta http-equiv='refresh' content='0;url=home.php'>";
	}else {
		// Adds logged in account as a follower to found user into follows table
		$sql= "INSERT INTO `follow`(`follower_id`, `following_id`, `follow_time`) 
				VALUES ('$user_uid','$id','$d')";
		$res= mysqli_query($conn,$sql) or die("Failed".mysqli_error());
		//Refreshes home page
		echo "<meta http-equiv='refresh' content='0;url=home.php'>";
	}
}
?>