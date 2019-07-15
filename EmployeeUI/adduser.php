<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
	include '../connect.php';
	require('variabel.php');
	session_start();
	if(!isset($_SESSION['pegawai'])){
		header('Location:index.php');
	}
	$pegawai = $_SESSION['pegawai'];

	if(isset($_POST['submit'])) {
		if($_POST['moduser']=="cookhelper") {
			$jbt='2';
		}
		else {
			$jbt='3';
		}
		$status='1';
		while(true){
			$id=rand(10000,99999);
			$sql="SELECT id FROM ms_pegawai WHERE id = '$id'";
			$result=$conn->query($sql);
			if($result->num_rows == 0) {
				$newNamaImg=$id;
				break;
			}
		}
		$sql = "INSERT INTO ms_pegawai (id, nama, pw, jbt, status) VALUES (?,?,?,?,?)";
		$stmt = $conn ->prepare($sql);
		$stmt->bind_param("sssss", $id, $_POST['name'], $_POST['psw'], $jbt, $status);
		if($stmt->execute()===TRUE){
			echo "<script>alert('New User Added\\nEmployee ID : ".$id."')</script>";
		}else{
			echo "<script>alert('Gagal menambah user baru')</script>";
		}
		$stmt -> close();
		$conn -> close();
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Dessert Paradiso - Manager</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Magical Login Form template Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free web designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />

		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- Custom Theme files -->
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<!-- //Custom Theme files -->
		<!-- web font -->
		<link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>
		<link rel="icon" href="img.png" type="image/x-icon">
		<!-- //web font -->
	</head>
	<body>
		<!-- main -->
		<div class="main-w3layouts wrapper">
		<a href="menu.php"><p class="top-title">Dessert Paradiso</p></a>
        <div id="user"><table border="0" style="margin:0px auto;"><tr><td><p style="color:#FFF">Welcome, <?php echo $pegawai->nama; ?></p></td><td><a href="logout.php"><button id="logout">Logout</button></a></td></tr></table></div><p>&nbsp;</p>
			<div id="main-agilein">
			  <div class="agileits-top">
              <h2 style="color:#FFF;font-size:2em">Add User</h2>

			  <form action="" method="post" style="color:#FFF">
  <input type="radio" name="moduser" value="cookhelper" checked> Cook Helper
  <input type="radio" name="moduser" value="waiter"> Waiter
  	               <b><br><br>
				Name :<br>
  <input type="text" name="name" required><br>
  				User password :<br>
  <input type="password" name="psw" required></b>

                <input type="submit" name="submit" value="Add User">  		</form>
			  </div>
			</div>
			<!-- copyright -->
			<div class="w3copyright-agile">
				<p>© 2017 Magical Login Form . All rights reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a></p>
			</div>
			<!-- //copyright -->

		</div>
		<!-- //main -->
	</body>
</html>
