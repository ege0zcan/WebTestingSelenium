<?php
	include "config.php";
	
	session_start();
	
	if(isset($_POST['submitCred'])){
		
		
		$user = mysqli_real_escape_string($mysqli,$_POST['bil_id']);
		$pass = mysqli_real_escape_string($mysqli,$_POST['pass']);
		
		
		if ($user != "" && $pass != ""){
			
			$user=strtolower($user);
			
			$cred_query = "SELECT uid, password FROM students WHERE uid='".$user."' and password='".$pass."'";
			
			$result = mysqli_query($mysqli,$cred_query);
			$flag = mysqli_fetch_row($result);
			
			
			if($flag === null  ){
				echo '<script language="javascript">';
				echo 'alert("Girdiğiniz bilgilerle eşleşen bir hesap bulunamadı.")';
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
			echo 'alert("Lütfen kullanıcı adı ve şifre bilgilerinizi giriniz.")';
			echo '</script>';
		}
		
	}
?>


<html>
<head>
<title>Bilkent STARS Giris</title>
	<link rel = "stylesheet" type = "text/css" href = "style.css">
	<script type="text/javascript">
	function checkCred()
	{
		var bil_id = document.forms["login_form"]["bil_id"].value;
		var pass = document.forms["login_form"]["pass"].value;
		if (bil_id==null || pass=="")
		{
			alert("ID bos olamaz");
			return false;
		}
		else if (pass==null || bil_id=="")
		{
			alert("Sifre bos olamaz");
			return false;
		}
		return true;
	}
	</script>
<body>
	<div class = "loginbox">
		<img src="bilkent.png" class = "logo">
			<h1> Bilkent Universitesi <h1>
			<h2> Guvenli Giris Kapisi <h2>
				<form name="login_form" method="post" action="">
					<p> Bilkent ID </p>
					<input type = "text" name="bil_id" placeholder="Enter Bilkent ID" >
					<label for="id">Personel Sicil No veya Ogrenci No</label>
					<p> Password </p>
					<input type = "password" name="pass" placeholder="Enter Password" >
					<input type = "submit" name="submitCred" placeholder="Login" >
					<a href= "resetpage_tr.html"> Sifre Sifirla? </a><br>
				</form>
	</div>
	<div class = "topbar">
		<form>
				<a href= "#" class = "onservices"> Bilkent University Online Services </a><br>
				<a href= "index.php" class = "lang"> English </a><br>
				<a href= "#" class = "log"> Giris </a><br>
		</form>
	</div>
	<div class = "botbar">
		<h1>  @2020 Bilkent Computer Center <h1>
	</div>
	<div class = "warningbox">
		<h1> Giris problemi yasiyorsaniz bilgisayarinizin zaman dilimi ayarini kontrol ediniz. <h1>
		<h1> Turkiye artik yaz saati uygulamasini kullanmamaktadir. Bilgisayarinizin zaman dilimini <b>UTC+3</b> olarak ayarlamalisiniz. <h1>
	</div>
	<div class = "infobox">
		<h1> Bilkent Bilgisayar Merkezi kullanici kimlik dogrulamasi icin bu ortak giris sayfasini kullanmaktadir. Bilkent Universitesi'nin cogu cevrimici servisi icin bu kapi yoluyla erisim saglanmaktadir.  <h1>
		<a href= "resetpage_tr.html"> STARS ya da BAIS sifrenizi unuttuysaniz burayi tiklayiniz. </a><br>
	</div>
</body>
</head>
</html>
