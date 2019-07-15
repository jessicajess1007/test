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
	if(!isset($_SESSION['pegawai'])){
		header('Location:index.php');
	}
	$pegawai = $_SESSION['pegawai'];
	if(isset($_POST['jadi'])){
		$idpes=$_POST['idpesan'];
		$sql="UPDATE ms_pesanan SET status='2' WHERE idPesanan='$idpes'";
		if($conn->query($sql)===TRUE) {
			echo "<script type='text/javascript'> alert('Menu in the cooking processed.'); </script>";
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Dessert Paradiso - Cook Helper</title>
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
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	</head>
	<body>
		<!-- main -->
		<div class="main-w3layouts wrapper">
		<p class="top-title" style="cursor:default;">Dessert Paradiso</p>
        <div id="user"><table border="0" style="margin:0px auto;"><tr><td><p style="color:#FFF">Welcome, <?php echo $pegawai->nama; ?></p></td><td><a href="logout.php"><button id="logout">Logout</button></a></td></tr></table></div><p>&nbsp;</p>
			<div class="main-agileinfo">
			  <div id="pesan" class="agileits-top">
              <h3 style="color:#FFF">Order</h3>
              <p>&nbsp;</p>

  				<table style="background-color:#ffffffcc; width:100%">
  				<tr style="background-color:purple; color:white">
					<th>Table Number</th>
    				<th>Menu Name</th>
   					<th>Qty</th>
                    <th>Progress</th>
                </tr>
				<?php
					include '../connect.php';
					$sql="SELECT idPesanan, noMeja FROM ms_pesanan where status='1'";
					$result1=$conn->query($sql);
					if($result1->num_rows > 0) {
						while($row1=$result1->fetch_assoc()){
							$count=0;
							$idPesan=$row1['idPesanan'];
							$sql="SELECT COUNT(idPesanan) AS counter FROM tr_pesanan where idPesanan='$idPesan'";
							$result=$conn->query($sql);
							if($result->num_rows > 0) {
								if($row=$result->fetch_assoc()){
									$count=$row['counter'];
								}
							}
				?>
                <tr>
                    <td rowspan="<?php echo $count; ?>" style="text-align:center;"><?php echo $row1['noMeja']; ?></td>
					<?php
						$sql="SELECT m.namaMenu, tp.qty FROM tr_pesanan tp, ms_menu m where m.idMenu=tp.idMenu and tp.idPesanan='$idPesan'";
						$result2=$conn->query($sql);
						if($result2->num_rows > 0) {
							$baris=0;
							while($row2=$result2->fetch_assoc()){
								$baris++;
								if($baris>1) echo "<tr>"; ?>
								<td style="padding:1px;"><?php echo $row2['namaMenu']; ?></td>
								<td style="padding:1px;text-align:center;"><?php echo $row2['qty']; ?></td>
					<?php
								if($baris==1){
					?>
								<td rowspan="<?php echo $count; ?>">
									<form action="" method="post">
										<input type="hidden" name="idpesan" value="<?php echo $row1['idPesanan']; ?>"/>
										<input type="submit" style="margin:3px;padding:2px;" value="Make this Menu" name="jadi"/>
									</form>
								</td>
					<?php
								}
								if($baris>1) echo "</tr>";
							}
						}
					?>
                </tr>
				<?php
						}
					}
				?>
                </table>
  				<p>&nbsp;</p>
			  </div>
			</div>
			<!-- copyright -->
			<div class="w3copyright-agile">
				<p>© 2017 Magical Login Form . All rights reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a></p>
			</div>
			<!-- //copyright -->

		</div>
		<!-- //main -->
		<script>
			var pesan = $("#pesan");
			setInterval(function () {
				pesan.load("order.php #pesan");
			}, 10000);
		</script>
	</body>
</html>
