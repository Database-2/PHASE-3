<?php
include 'config.php';
session_start();

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
?>
 

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
* {
  box-sizing: border-box;
}
.menu {
  float: left;
  width: 20%;
}
.menuitem {
  padding: 8px;
  margin-top: 7px;
  border-bottom: 1px solid #f1f1f1;
}
.main {
  float: left;
  width: 60%;
  padding: 0 20px;
  overflow: hidden;
}
.right {
  background-color: lightblue;
  float: left;
  width: 20%;
  padding: 10px 15px;
  margin-top: 7px;
}
.topright {
  position:absolute;
  top:5px;
  right:5px;
}


@media only screen and (max-width:800px) {
  /* For tablets: */
  .main {
    width: 80%;
    padding: 0;
  }
  .right {
    width: 100%;
  }
  .topcorner{
    width: 100%;
  }
}
@media only screen and (max-width:500px) {
  /* For mobile phones: */
  .menu, .main, .right {
    width: 100%;
  }
}
</style>
</head>
<body style="font-family:Verdana;">

<div class="topright">
  <form action="logout.php" method="POST">
    <input type="submit" name="logout" value= "Sign Out">
  </form>  
  </div>

<div class="topcorner">
  <form action="home.php" method="POST">
    <input type="submit" name="home" value= "Home">
  </form>  
  </div>

<div style="background-color:#ffffff;padding:15px;">
  <center>
  <h1>Inbox</h1>
  </center>
</div>


<div style="overflow:auto">
  <div class="menu">
    <?php
        echo "Welcome, " .$_SESSION['username']. "!";
    ?>
    
    <!-- <div class="menuitem">
      <form action="profile.php" method="POST">
            <input type="submit" name="profile" value= "My Profile">
      </form>  
    </div> -->

    <div class="menuitem">Follwers
    <?php
		// Display follower count
		$sql = "SELECT COUNT(*) 
				FROM `follow`,user 
				WHERE $user_uid = uid AND following_id = uid";

		$result =$conn->query($sql);

		if($result->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
				echo $row["COUNT(*)"];
				echo '<br />';
			}
		} else {
			echo "0";
		}
     ?>
     </div>
    <div class="menuitem">Follwing
    <?php
		// Display following count  
		$sql = "SELECT COUNT(*) 
				FROM `follow`,user 
				WHERE $user_uid = uid AND follower_id = uid";

		$result =$conn->query($sql);

		if($result->num_rows > 0){
			while ($row = $result->fetch_assoc()) {
				echo $row["COUNT(*)"];
				echo '<br />';
			}
		} else {
			echo "0";
		}
    ?>
    </div>
    <div class="menuitem">Message
	  <form action="send.php" method="POST" >
        <input type="submit" name="send" value= "Send">
      </form></div>
  </div>

  <div class="main">
    <form action="Inbox.php" method="POST">

	</form>
	
	<?php
		// Makes a table of messages sent to the logged in user
		$sql ="SELECT DISTINCT username, body, send_time, message_id  
				FROM user, message
				WHERE user.uid = sender_id
				AND receiver_id = $user_uid
				ORDER By send_time DESC";

		$result =$conn->query($sql);
		// Prints every message from above table for current user to HTML page
		while ($row = $result->fetch_assoc()) {
			$username = $row['username']; 
			$current_username = $row["username"];
			$date = $row["send_time"];
			$body = $row["body"];
			$list_id = $row["message_id"];
			echo "<ul style='list-style-type:none'>";
			echo "<li>".$current_username." ".$date. "</li>";
			echo "<li>".$body."</li>";
			echo "<li><a href='delete_message.php?id=".$row['message_id']."'>
				Delete</a> <a href='reply_message.php?id=".$row['username']."&amp;mid=".$row['message_id']."'>Reply</a></li>";
			echo "</ul>";		
		}
    ?> 
	
  </div>

</body>
</html>