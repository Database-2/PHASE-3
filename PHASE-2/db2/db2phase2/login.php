<?php
include 'config.php';
session_start();

echo "<h2>Sign In</h2>";
echo "<p>Please enter your username and password.</p>";

$uid = $username = $pwd = $login = "";

// Set up user and ids with given log in information
if(isset($_POST['uid'])){
}
if(isset($_POST['username'])){
$username = $_POST['username'];
}
if(isset($_POST['pwd'])){
$pwd = $_POST['pwd'];
}
if(isset($_POST['login'])){
$login = $_POST['login'];
}

// Checks inputed user information
if ($login) {
	// If no username entered display error message
	if (empty($username)){
		$username_err = "<p>Please enter a username.</p>";
		echo $username_err;	
	}
	// If no password entered display error message
	if (empty($pwd)){
		$pwd_err = "<p>Please enter a password.</p>";
		echo $pwd_err;
	}
	// If a username and a password is entered 
	if( (!empty($username)) && (!empty($pwd))){
		// Check if the username is an actual user from users table
		// and if the entered password is the users password
		$sql = "SELECT * FROM user WHERE username = '$username' AND password = '$pwd'";
		$result = mysqli_query($conn,$sql); 
		// If it isn't a user or if it's the wrong password display error message
		// if it is a user and the password is correct create a session with given account
		if(!$row = mysqli_fetch_assoc($result)){
			echo "You username or password in incorrect";
		}else {
			// Assign user data from the users table into session variables
			$_SESSION['username']=$username;
			$sql = "SELECT user.uid
					FROM `user` 
					WHERE user.username = '$username'"; 
			$result = mysqli_query($conn,$sql);
			$row = mysqli_fetch_assoc($result);
			$_SESSION['uid']=$row["uid"];
			$_SESSION['receiver'] = "";
			$_SESSION['temp_comm']	= "";
			// Loads home page
			header("Location: home.php");
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Sign In</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">
body{ font: 14px sans-serif; }
	.wrapper{ width: 350px; padding: 20px; }
</style>
</head>
<body>	

<div class="wrapper">

<form action="login.php" method="POST">
	<input type="text" name="username" placeholder="Username"><br>
	<input type="password" name="pwd" placeholder="Password"><br>
    <input type="submit"  name= "login" value="Login"><br>
    <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
</form>
</div>
</body>
</html>