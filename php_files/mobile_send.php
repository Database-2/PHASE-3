<?php
include 'config.php';
session_start();

//get data and time
$da = date_default_timezone_set("America/New_York");
$d = date("Y-m-d h:i:sa");

// Data for the message table
$sender_id = $receiver_name = $body = $receiver_id = "";
$sender_id = $_POST['sender_id'];
$receiver_name = $_POST['receiver_name'];
$body = $_POST['body'];

// Checks database for user to receive message
$sql = "SELECT user.uid
		FROM `user` 
		WHERE user.username = '$receiver_name'"; 
$result = mysqli_query($conn,$sql);

// If the user exists send the message
if($result->num_rows > 0){
	$row = mysqli_fetch_assoc($result);  
	$receiver_id = $row["uid"];

	// Adds the message to the message table
	$sql = "INSERT INTO `message`(`sender_id`, `receiver_id`, `body`, `send_time`)
		VALUES ('$sender_id','$receiver_id','$body','$d')";
	$result = mysqli_query($conn,$sql);
	echo "Message Sent";
} else {
	echo "No User Found";
} 
?> 