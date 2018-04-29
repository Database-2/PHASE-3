<?php
include 'config.php';
session_start();

// Set up user ids for message sending
if(isset($_GET['id'])){
  $id = $_GET['id'];
}
if(!isset($_GET['id'])){
  $id = $_SESSION['receiver'];  
}
if(isset($id)){
  $_SESSION['receiver'] = $id;
  $id = $_SESSION['receiver'];
}

// If there is no user to send message to then load login page
if(!isset($_SESSION['uid'])){
	header("Location: login.php");
	exit();
}

//get data and time
$da = date_default_timezone_set("America/New_York");
$d = date("Y-m-d h:i:sa");

if(isset($_SESSION['username'])){
}
if(isset($_SESSION['uid'])){
}

// Set up user ids for message sending
$user_uid = $receiver_uid = "";
if(isset($user_uid)){
$user_uid = $_SESSION['uid'];
}
if(isset($receiver_uid)){
}

$search = $user_name ="";

		// Checks database for user to receive message 
		$sql = "SELECT user.uid
				FROM `user` 
				WHERE user.username = '$id'"; 
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result); 
		
		// Sets the user to receive the message
		if(isset($user_name)){
			$user_name = $id;
		}

		// Checks the message body
		if(isset($_POST['send_mes'])){
			$search = $_POST['send_mes'];
		}

			// Checks database for user to receive message
			$sql = "SELECT user.uid
					FROM `user` 
					WHERE user.username = '$id'"; 
			$result = mysqli_query($conn,$sql);

			$row = mysqli_fetch_assoc($result);  
			$receiver_uid = $row["uid"];
			$user_mes = $_POST['user_mes'];

			// Adds the message to the message table
			$sql = "INSERT INTO `message`(`sender_id`, `receiver_id`, `body`, `send_time`)
					VALUES ('$user_uid','$receiver_uid','$user_mes','$d')";
			$result = mysqli_query($conn,$sql);

			// Closes page and opens inbox page
			mysqli_close($conn);
			header('Location: inbox.php');
			exit;
?>
