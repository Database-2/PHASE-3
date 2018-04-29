<?php
include 'config.php';
session_start();

$user_uid = "";
if(isset($user_uid)){
$user_uid = $_POST['uid'];
}

// Makes a table of messages sent to the logged in user
$sqla ="SELECT DISTINCT username, body, send_time, message_id, sender_id, receiver_id  
		FROM user, message
		WHERE user.uid = sender_id
		AND receiver_id = $user_uid
		ORDER By send_time DESC";
  $resulta = mysqli_query($conn,$sqla);

  $result = array();

  while($row = mysqli_fetch_array($resulta)){
    array_push($result,array(
        'username'=>$row['username'],
        'body'=>$row['body'],
        'send_time'=>$row['send_time'],
        'message_id'=>$row['message_id'],
		'sender_id'=>$row['sender_id'],
        'receiver_id'=>$row['receiver_id']
    ));
  }
  echo json_encode(array('result'=>$result));
?>