<?php
include 'config.php';
session_start();

// Set up user and ids 
if(!isset($_SESSION['uid'])){
  header("Location: login.php");
  exit();
}
$user_uid = "";
if(isset($user_uid)){
$user_uid = $_SESSION['uid'];
}
//get data and time
$da = date_default_timezone_set("America/New_York");
$d = date("Y-m-d h:i:sa");

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
  <h1>Twitter</h1>
  </center>
</div>


<div style="overflow:auto">
  <div class="menu">
    <?php
        echo "Welcome, " .$_SESSION['username']. "!";
    ?>

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
    <h2>Post</h2>
     <form action="profile.php" method="POST" >
      <textarea name="userpost" style="resize:none" rows="4" cols="50" maxlength="200" placeholder ="What's on your mind?" > </textarea><br />
      <input type="submit" name="proses" value= "Post">
  	  </form> 
 <?php

// create user's post
  $user_post = $proses = $user_post_err = "";
  if (isset($_POST['proses'])){
      $user_post = nl2br($_POST['userpost']); 
   if (!strlen(trim($user_post))){
        $user_post_err = "<p>Please enter something.</p>";
        echo $user_post_err;
   }else {

      $sqla = "INSERT INTO `twitts`(`uid`, `body`, `post_time`)
              VALUES ('$user_uid','$user_post','$d')";
      $resulta = mysqli_query($conn,$sqla);
    }        
 }

// display user's post only
  $sql ="SELECT username, body, post_time,tid  
         FROM user, twitts
         WHERE twitts.uid = user.uid
               AND user.uid = $user_uid
         ORDER By post_time DESC";

  $result =$conn->query($sql);


  if($result->num_rows > 0){

    while ($row = $result->fetch_assoc()) {
      $current_username = $row["username"];
      $date = $row["post_time"];
      $body = $row["body"];
      $tidl = $row["tid"];
      echo "<ul style='list-style-type:none'>";
      echo "<li>".$current_username." ".$date. " <a href='post_del.php?del=$row[tid]'>delete</a></li>";
      echo "<li>".$body."</li>";
      

      //comment 
      $sqlcomm = "SELECT `username`, comment.body, `comment_time`, `cid` 
                  FROM `user`,`comment` 
                  WHERE user.uid = comment.uid AND comment.tid = $tidl
                  ORDER By comment_time ASC";
      $resultcomm =$conn->query($sqlcomm);  

      // likes
      $sqll = "SELECT COUNT(*) FROM `thumb` WHERE  tid= $tidl";
      $resultl =$conn->query($sqll);

      //dislike
      $sqldisl = "SELECT COUNT(*) FROM `dislike` WHERE  tid= $tidl";
      $resultdisl =$conn->query($sqldisl);

        if(($resultl->num_rows >= 0) &&  ($resultdisl->num_rows >= 0 )) {
        while (($rowl = $resultl->fetch_assoc()) && ($rowdisk = $resultdisl->fetch_assoc())){
        
        //numbers of like
        $likes = $rowl["COUNT(*)"];
        
        //numbers of dislike
        $dislike = $rowdisk["COUNT(*)"];
        echo "<li> <a href='user_like_profile.php?lik=$row[tid]'>Likes</a> "  .$likes.  " <a href='user_dislike_profile.php?disl=$row[tid]'>Dislike</a> "  .$dislike. "</li>";
        }
      
        } if($resultcomm->num_rows > 0){
        while (($rowcomm = $resultcomm->fetch_assoc())){
        //display comments
        $user_comm = $rowcomm["username"];
        $date_comm = $rowcomm["comment_time"];
        $comm_body = $rowcomm["body"];     

        //echo "<li> <a href='user_like_profile.php?lik=$row[tid]'>Likes</a> "  .$likes.  " <a href='user_dislike_profile.php?disl=$row[tid]'>Dislike</a> "  .$dislike. "</li>";
        echo "<li>" .$user_comm. " " .$date_comm.  " <a href='comment_delete.php?del=$rowcomm[cid]'>Delete</a> </li>";
        echo "<li>" .$comm_body. "</li>";
        //echo "</ul>";

      }
    }
      echo "<li> <form action='user_comment_profile.php' method='POST' > </li>";
      echo "<li> <input type='text' name ='u_commenter' placeholder= 'Enter a comment....' />   
                 <input type='hidden' name = tid  value= $row[tid] />
                 <input type='submit' name = 'user_click' value='enter' /> </li>"; 
      echo "<li> </form> </li>";        
      echo "</ul>";
     }
  }else {
     echo "No result";
      }
      
      ?> 

      </div>
</body>
</html>