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
	if(isset($_POST['help'])){
		$idtolong=$_POST['idtolong'];
		$sql="UPDATE ms_tolong SET status='2' WHERE idTolong='$idtolong'";
		if($conn->query($sql)===TRUE) {
			echo "<script type='text/javascript'> alert('Go to the calling table'); </script>";
		}else{
			echo "<script type='text/javascript'> alert('Failed.'); </script>";
		}
	}
	if(isset($_POST['done'])){
		$idtolong=$_POST['idtolong'];
		$sql="DELETE FROM ms_tolong WHERE idTolong='$idtolong'";
		if($conn->query($sql)===TRUE) {
			echo "<script type='text/javascript'> alert('Help already done.'); </script>";
		}else{
			echo "<script type='text/javascript'> alert('Failed'); </script>";
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Dessert Paradiso - Waiter</title>
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
			<div class="main-agileinfo" style="float:left; margin:1% 0 7% 10%; width:36%; padding:15px">
			  <div id="order" class="agileits-top" style="margin:0px; padding:0px;">
				<?php
					$sql="SELECT idPesanan, noMeja from ms_pesanan where status='3'";
					$result=$conn->query($sql);
					$idpes='';
					$nomeja='';
					if($result->num_rows > 0) {
						if($row=$result->fetch_assoc()){
							$idpes=$row['idPesanan'];
							$nomeja=$row['noMeja'];
						}
					}
				?>
					<form action="" method="post">
					  <p>Receipt</p>
					  <p style="text-align:right; font-size:14px">Table no. <?php echo $nomeja ?></p>
					  <p>&nbsp;</p>
					  <table width="100%" border="1" bgcolor="white" bordercolor="#000000;">
					    <tr>
					      <th width="130" bgcolor="#FFFFCC" scope="col">Item</th>
						  <th width="54" bgcolor="#FFFFCC" scope="col">Harga satuan</th>
					      <th width="54" bgcolor="#FFFFCC" scope="col">Qty</th>
                          <th width="54" bgcolor="#FFFFCC" scope="col">Price</th>
				        </tr>
						<?php
						$sql="SELECT m.namaMenu, m.hargaMenu, p.qty from ms_menu m, tr_pesanan p where m.idMenu=p.idMenu and p.idPesanan='$idpes'";
						$result=$conn->query($sql);
						$total=0;
						if($result->num_rows > 0) {
							while($row=$result->fetch_assoc()){
								$subtotal=$row['hargaMenu']*$row['qty'];
								$total+=$subtotal;
						?>
					    <tr>
					      <td><?php echo $row['namaMenu']; ?></td>
					      <td bgcolor="#FFCCFF" style="text-align:right"><?php echo $row['hargaMenu']; ?></td>
                          <td style="text-align:right"><?php echo $row['qty']; ?></td>
						  <td bgcolor="#FFCCFF" style="text-align:right"><?php echo $subtotal.".000"; ?></td>
				        </tr>
						<?php
							}
						}
						?>
					    <tr>
					      <td>&nbsp;</td>
						  <td>&nbsp;</td>
					      <td>Total</td>
                          <td bgcolor="#CCFF00" style="text-align:right"><?php echo $total.".000"; ?></td>
				        </tr>

				      </table>
					  <input type="hidden" value="<?php echo $idpes; ?>" name="idPes">
					  <input type="submit" name="pay" value="Print">
				  </form>
				</div>
			</div>
			<div class="main-agileinfo" style="float:right; margin:1% 15% 7% 0; width:30%;">
				<div id="nomor" class="agileits-top">
				<?php
					$sql2="SELECT * from ms_tolong where status>'0' ORDER BY status DESC";
					$result2=$conn->query($sql2);
					$idhelp='';
					$nomeja2='00';
					$status='Wait';
					$cmd='';
					if($result2->num_rows > 0) {
						if($row2=$result2->fetch_assoc()){
							$idhelp=$row2['idTolong'];
							$nomeja2=$row2['noMeja'];
							$cek=$row2['status'];
							if($cek=='1'){
								$status='Help';
								$cmd='help';
							}else{
								$status="Done";
								$cmd="done";
							}
						}
					}
				?>
			    <p>Table</p>
			    <p>&nbsp;</p>
			    <div style="font-size:82px; display:inline; color:#FFF; font-family:tw cen mt"><?php echo $nomeja2; ?></div>
					  <p>&nbsp;</p>
					  <p>Need Your help!</p>
					  <p>Go and ask them</p>
					  <p>what they need :)</p>
                      <form action="" method="post">
					  <input type="hidden" value="<?php echo $idhelp; ?>" name="idtolong">
                      <input type="submit" style="margin:3px;" name="<?php echo $cmd; ?>" value="<?php echo $status; ?>">
                      </form>
			  </div>
			</div>
			<!-- copyright -->
			<div class="w3copyright-agile" style="clear:both;">
				<p>© 2017 Magical Login Form . All rights reserved | Design by <a href="http://w3layouts.com/" target="_blank">W3layouts</a></p>
			</div>
			<!-- //copyright -->

		</div>
		<!-- //main -->
		<script type="text/javascript">
			var nomor = $("#nomor");
			var order = $("#order");
			setInterval(function () {
				order.load("waiter.php #order");
				nomor.load("waiter.php #nomor");
			}, 10000);
			function printStruk(){
				var windowPrint = window.open('', 'PRINT', 'height=600,width=800');
				var nama = "Dessert Paradiso";

		    windowPrint.document.write('<html><head><title>'+nama+'</title>');
		    windowPrint.document.write('</head><body >');
		    windowPrint.document.write('<h1>'+nama+'</h1>');
		    windowPrint.document.write(document.getElementById("order").innerHTML);
		    windowPrint.document.write('</body></html>');

		    windowPrint.document.close();
		    windowPrint.focus();

		    windowPrint.print();
		    windowPrint.close();

				$("#order").load("waiter.php #order");
			}
		</script>
	</body>
</html>
<?php
	if(isset($_POST['pay'])){
		$idpesan=$_POST['idPes'];
		if($idpesan!=''){
			$sql="UPDATE ms_pesanan SET status='0' WHERE idPesanan='$idpesan'";
			if($conn->query($sql)===TRUE) {
				echo "<script type='text/javascript'> printStruk(); </script>";
			}
		}else{
			echo "<script type='text/javascript'> alert('Tidak berhasil'); </script>";
		}
	}
?>
