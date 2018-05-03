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

// If unfollow was clicked then unfollow user 
if( isset($_GET['unfl']) ){
	$id = $_GET['unfl'];
	// Unfollow user from follow
	$sql= "DELETE FROM `follow` WHERE`follower_id` = '$user_uid' AND `following_id` = '$id'";
	$res= mysqli_query($conn,$sql) or die("Failed".mysqli_error());
	// Refreshes home page
	echo "<meta http-equiv='refresh' content='0;url=home.php'>";
}
?>