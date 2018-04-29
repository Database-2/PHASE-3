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
  <h1>Reply to Message</h1>
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
	  <div>
	    <form action="inbox.php" method="POST" style='display:inline;'>
          <input type="submit" name="inbox" value= "Inbox">
        </form>
	    <form action="send.php" method="POST" style='display:inline;'>
          <input type="submit" name="send" value= "Send">
        </form>
	  </div>
	</div>
  </div>

  <div class="main">
    <form action="reply_message.php" method="POST">
      <div class="block">
        <label>To:<label></br>
		<?php echo $id; ?>
      </div>
	  <div class="block">
        </br><label>Mesage:<label></br>
	    <textarea name="user_mes" style="resize:none" rows="4" cols="50" maxlength="200" ></textarea>
      </div>
	  <input type="submit" name="send_mes" value= "Send Message">
	</form>
	
	<?php
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

		// If message body is not empty
		if ($search) {
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
		} 
    ?> 
	
  </div>

</body>
</html>