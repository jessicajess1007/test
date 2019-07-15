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

	if(!isset($namaImg)){
		while(true){
			$rand1=rand(10,99);
			$rand2=rand(1000,9999);
			$rand3=rand(1000,9999);
			$id=$rand1.$rand2.$rand3;
			$sql="SELECT idMenu FROM ms_menu WHERE idMenu = '$id'";
			$result=$conn->query($sql);
			if($result->num_rows == 0) {
				$namaImg=$id;
				break;
			}
		}
	}

	if(isset($_POST['addmenu'])){
		$ekstensi_diperbolehkan	= array('png','jpg');
		$nama = $_FILES['file']['name'];
		$x = explode('.', $nama);
		$ekstensi = strtolower(end($x));
		$ukuran	= $_FILES['file']['size'];
		$file_tmp = $_FILES['file']['tmp_name'];
		$eksImg='';
		if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
			if($ukuran < 10000000){
				move_uploaded_file($file_tmp, '../CustomerUI/images/'.$namaImg.'.'.$ekstensi);
				$eksImg=$ekstensi;
			}else{
				echo "<script type='text/javascript'> alert('File size is too big'); </script>";
			}
		}else{
			echo "<script type='text/javascript'> alert('File extension prohibited'); </script>";
		}
		$menu = $_POST['modmenu'];
		$name = $_POST['menuname'];
		$desc = $_POST['descrip'];
		$prz = (int)$_POST['price'];
		$sql="INSERT INTO ms_menu VALUES('$namaImg', '$eksImg', '$menu', '$name', '$desc', $prz)";
		if($conn->query($sql)===TRUE) {
			echo "<script type='text/javascript'> alert('Add menu succeed'); </script>";
		}else{
			echo "<script type='text/javascript'> alert('Add menu failed'); </script>";
		}
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
			<div id="main-agileinf">
			  <div class="agileits-top">
              <h2 style="color:#FFF; font-size:2em">Add Menu</h2>
              <form action="" method="post" style="color:#FFF" enctype="multipart/form-data">
  <input type="radio" name="modmenu" value="cakes" checked> Cake
  <input type="radio" name="modmenu" value="icecream"> Ice Cream
  <input type="radio" name="modmenu" value="salad"> Pudding & Salad<br>
  <input type="radio" name="modmenu" value="beverages"> Drink & Baverages<br><br>

                Menu Name:<br>
  <input type="text" name="menuname" style="text-align:center;" required><br>
  				Description:<br>
	<textarea name="descrip" style="vertical-align:top;width:100%; height:6em; text-align:center; font:inherit; margin-top:30px;padding:1px;overflow-y:scroll; border:none; border-bottom:1px solid #fff; resize:none; background-color:transparent; color:#fff" required></textarea><br><br>
  				Price:<br>
  <input type="text" name="price" style="text-align:center;" required>

    Select image to upload:
    <input type="file" name="file" id="fileToUpload" style="margin-top:50px; width:250px; height:50px; border:none;" required>
                <input type="submit" name="addmenu" value="Add Menu">
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
