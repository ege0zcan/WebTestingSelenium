<?php
	include "config.php";
	session_start();
	
	function logOut() {
		echo "You are logging out of the system...";
		session_destroy();
		header('Location: index.php');
	}
	

	$user = $_SESSION['user_name'];
	$userPrint = strtoupper($user);
	$c_id = $_SESSION['password'];

	if(!isset($user)){
		header('Location: index.php');
	}
	
	if(array_key_exists('Logout',$_POST)){
		logOut();
	}
	
	
	?>

<!doctype html>
<html>
<head></head>
<body>
<center> <h1>Welcome <?php echo $userPrint ?> </h1></center>


<form method="post">  <center>
<input type="submit" name="Logout" id="Logout" value="Logout" /><br/>
</form>



</body>
</html>
