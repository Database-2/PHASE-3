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
 
// If delete was clicked then delete post
if( isset($_GET['del']) ){
	$id = $_GET['del'];
	// Deletes post
	$sql= "DELETE FROM twitts WHERE tid='$id'";
	$res= mysqli_query($conn,$sql) or die("Failed".mysqli_error());
	// Refreshes profile page
	echo "<meta http-equiv='refresh' content='0;url=profile.php'>";
}
?>