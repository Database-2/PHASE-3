<?php
include 'config.php';
session_start();

// Makes a table of messages sent to the logged in user
$sqla ="SELECT username, tid, user.uid, body, post_time  
		FROM user, twitts
		WHERE user.uid = twitts.uid
		ORDER By post_time DESC";
  $resulta = mysqli_query($conn,$sqla);

  $result = array();

  while($row = mysqli_fetch_array($resulta)){
    array_push($result,array(
        'username'=>$row['username'],
		'tid'=>$row['tid'],
        'uid'=>$row['uid'],
        'body'=>$row['body'],
        'post_time'=>$row['post_time'],
    ));
  }
  echo json_encode(array('result'=>$result));
?>