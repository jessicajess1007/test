<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php	
	include '../connect.php';
	require 'variabel.php';
	session_start();
	$cek = "";
	if(isset($_POST['ok'])){
		$id = $_POST['id'];
		$pw = $_POST['pw'];
		$sql = "SELECT * FROM ms_pegawai WHERE id = '$id' and pw = '$pw'";
		$result=$conn->query($sql);
		if($result->num_rows > 0) {
			if($row=$result->fetch_assoc()){
				$cek = "y";
				$pegawai = new Pegawai;
				$pegawai->id = $row["id"];
				$pegawai->nama = $row["nama"];
				$pegawai->jbt = $row["jbt"];
				$pegawai->status = $row["status"];
				$_SESSION['pegawai'] = $pegawai;
				if($pegawai->jbt=='1'){
					header('Location:menu.php');
				}else if($pegawai->jbt=='2'){
					header('Location:order.php');
				}else{
					header('Location:waiter.php');
				}
			}
		}else{
			$cek = "n";
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Dessert Paradiso - Employee</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Magical Login Form template Responsive, Login form web template,Flat Pricing tables,Flat Drop downs  Sign up Web Templates, Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free web designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
		<link rel="icon" href="img.png" type="image/x-icon">
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- Custom Theme files -->
		<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
		<!-- //Custom Theme files -->
		<!-- web font -->
        <link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>
		
		<!-- //web font -->
	</head>
	<body>
		<!-- main -->
		<div class="main-w3layouts wrapper">
			<p class="top-title">Dessert Paradiso</p>
			<div id="main-agilein">
				<div class="agileits-top"> 
					<form action="" method="post" id="login"> 
						<input class="text" type="text" name="id" placeholder="ID Employee" required="Fill your name">
						<input class="text" type="password" name="pw" placeholder="Password" required="Fill your password">
						<?php if ($cek == "n"){ ?>
							<p style="color:red; margin:10px auto">Invalid ID & Password</p>
						<?php } ?>
						<div class="wthree-text"> 
							<ul> 
								<li>
									<label class="anim">
										<input type="checkbox" class="checkbox">
										<span> Remember me ?</span> 
									</label> 
								</li>
							</ul>
							<div class="clear"> </div>
						</div>   
						<input type="submit" name="ok" value="LOGIN">
					</form>
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