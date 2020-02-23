<?php
	include "config.php";
	
	session_start();
	
	if(isset($_POST['submitCred'])){
		
		
		$user = mysqli_real_escape_string($mysqli,$_POST['bil_id']);
		$pass = mysqli_real_escape_string($mysqli,$_POST['pass']);
		
		
		if ($user != "" && $pass != ""){
			
			$user=strtolower($user);
			
			$cred_query = "select uid, password from students where uid='".$user."' and password='".$pass."'";
			
			$result = mysqli_query($mysqli,$cred_query);
			$flag = mysqli_fetch_row($result);
			
			
			if($flag === null  ){
				echo '<script language="javascript">';
				echo 'alert("No such user with the given password in the system")';
				echo '</script>';
			}else{
				
				$_SESSION['user_name'] = $user;
				$_SESSION['password'] = $pass;
				header('Location: main.php');
			}
			
		}
		else
		{
			echo '<script language="javascript">';
			echo 'alert("Please enter a username and a password")';
			echo '</script>';
		}
		
	}
?>


<html>
<head>
	<title>Bilkent STARS Login</title>
	<link rel = "stylesheet" type = "text/css" href = "style.css">
	<script type="text/javascript">
	function checkCred()
	{
		var bil_id = document.forms["login_form"]["bil_id"].value;
		var pass = document.forms["login_form"]["pass"].value;
		if (bil_id==null || pass=="")
		{
			alert("ID can't be blank");
			return false;
		}
		else if (pass==null || bil_id=="")
		{
			alert("Password can't be blank");
			return false;
		}
		return true;
	}
	</script>
<body>
	<div class = "loginbox">
		<img src="bilkent.png" class = "logo">
			<h1> Bilkent University <h1>
			<h2> Secure Login Gateway <h2>
				<form name="login_form" method="post" action="">
					<p> Bilkent ID </p>
					<input type = "text" name="bil_id" placeholder="Enter Bilkent ID" >
					<label for="id">Personnel ID number or Student ID number</label>
					<p> Password </p>
					<input type = "password" name="pass" placeholder="Enter Password" >
					<input type = "submit" name="submitCred" placeholder="Login" >
					<a href= "resetpage.html"> Reset password? </a><br>
				</form>
	</div>
	<div class = "topbar">
		<form>
				<a href= "#" class = "onservices"> Bilkent University Online Services </a><br>
				<a href= "index_tr.php" class = "lang"> Turkce </a><br>
				<a href= "#" class = "log"> Login </a><br>
		</form>
	</div>
	<div class = "botbar">
		<h1> @2020 Bilkent Computer Center <h1>
	</div>
	<div class = "warningbox">
		<h1> If you are having problems logging in, please check the time zone setting on your computer. <h1>
		<h1> Turkey no longer uses daylight saving time (DST). Your computer time zone setting should be set as <b>UTC+3</b>. <h1>
	</div>
	<div class = "infobox">
		<h1> Bilkent Computer Center uses this common login gateway page for user authenticaton. Most Bilkent University online services are accessed through this Secure Login Gateway. <h1>
		<a href= "resetpage.html"> If you have forgotten your STARS or BAIS password, please click here. </a><br>	
	</div>
</body>
</head>
</html>
