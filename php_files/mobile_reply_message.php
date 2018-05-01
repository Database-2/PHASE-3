<?php
include 'config.php';
session_start();

// Data for the message table
$sender_id = $receiver_id = $body = "";
$sender_id = $_POST['sender_id'];
$receiver_id = $_POST['receiver_id'];
$body = $_POST['body'];

  echo $sender_id;
  echo $receiver_id;
  echo $body;

// Get date and time
$da = date_default_timezone_set("America/New_York");
$d = date("Y-m-d h:i:sa");

// Adds the message to the message table
$sql = "INSERT INTO `message`(`sender_id`, `receiver_id`, `body`, `send_time`)
		VALUES ('$sender_id','$receiver_id','$body','$d')";

if (mysqli_query($conn, $sql)) {
  // Close page and load inbox page
  mysqli_close($conn);
  echo "Message Sent";
  echo $sender_id;
  echo $receiver_id;
  echo $body;
} else {
  // Error message
  echo "Error, Message Not Sent";
  echo $sender_id;
  echo $receiver_id;
  echo $body;
}

?>
