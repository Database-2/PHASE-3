<?php
include 'config.php';
session_start();

$id = "";
$id = $_POST['id'];

// Delete message from message table
$sql = "DELETE FROM message WHERE message_id = $id"; 

if (mysqli_query($conn, $sql)) {
    // Close page and load inbox page
	mysqli_close($conn);
        echo "Message Deleted";
} else {
	// Error message
    echo "Error deleting record";
}

?>