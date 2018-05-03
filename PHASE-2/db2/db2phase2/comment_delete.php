<?php
include 'config.php';
session_start();

$id = $_GET['del'];

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

// Delete the comment from comment
$sql = "DELETE FROM comment WHERE cid = $id"; 

if (mysqli_query($conn, $sql)) {
	// Close page and loads profile page
    mysqli_close($conn);
    header('Location: profile.php');
    exit;
} else {
	// Error message
    echo "Error deleting record";
}

?>
