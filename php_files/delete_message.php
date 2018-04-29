<?php
include 'config.php';
session_start();

$id = $_GET['id'];

// Set up user and ids 
if(!isset($_SESSION['uid'])){
	header("Location: login.php");
	exit();
}
if(isset($_SESSION['username'])){
}
$user_uid = "";
if(isset($user_uid)){
	$user_uid = $_SESSION['uid'];
}

// Delete message from message table
$sql = "DELETE FROM message WHERE message_id = $id"; 

if (mysqli_query($conn, $sql)) {
    // Close page and load inbox page
	mysqli_close($conn);
    header('Location: inbox.php');
    exit;
} else {
	// Error message
    echo "Error deleting record";
}

?>
