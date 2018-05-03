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

if( isset($_GET['lik']) ){
	$lik_tid = $_GET['lik'];
	// check for duplicates 
	// for likes
	$get_num_like = "SELECT * FROM `thumb` WHERE `uid` = $user_uid AND `tid` = $lik_tid";
	$check_for_like = mysqli_query($conn,$get_num_like);

	// check for duplicates
	// for dislikes
	$get_num_dislike = "SELECT * FROM `dislike` WHERE `uid` = $user_uid AND `tid` = $lik_tid";
	$check_for_dislike = mysqli_query($conn,$get_num_dislike);

	// Checks to see if user already liked tweet already
	// then checks to see if the user alrady disliked it
	// if it is disliked it undislikes the tweet and then likes it.
	// if it isnt liked then it just likes the tweet.
	if (mysqli_num_rows($check_for_like) > 0) {
		// Refreshes home page
		echo "<meta http-equiv='refresh' content='0;url=home.php'>";
	}elseif (mysqli_num_rows($check_for_dislike) > 0) {
		// Deletes the dislike from dislike
		$sqldis = "DELETE FROM `dislike` WHERE `uid` = $user_uid AND `tid` = $lik_tid";
		$resdis = mysqli_query($conn,$sqldis) or die("Failed".mysqli_error());

		// Adds a like to thumb
		$sqlil= "INSERT INTO `thumb`(`uid`, `tid`) 
				VALUES ('$user_uid','$lik_tid')";
		$resil= mysqli_query($conn,$sqlil) or die("Failed".mysqli_error());
		// Refreshes home page
		echo "<meta http-equiv='refresh' content='0;url=home.php'>";	
	}else {
		// Adds a like to thumb
		$sqlili= "INSERT INTO `thumb`(`uid`, `tid`) 
				VALUES ('$user_uid','$lik_tid')";
		$resili= mysqli_query($conn,$sqlili) or die("Failed".mysqli_error());
		// Refreshes home page
		echo "<meta http-equiv='refresh' content='0;url=home.php'>";
	}
}	
?>