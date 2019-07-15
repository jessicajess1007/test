<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<?php
	include '../connect.php';
	require('variabel.php');
	session_start();
	if(!isset($_SESSION['pegawai'])){
		header('Location:index.php');
	}
	$pegawai = $_SESSION['pegawai'];
?>
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
			<div class="main-agileinfo">
			  <div class="agileits-top">
        <h2 style="color:#FFF;font-size:2em">Report</h2>
			  <form style="color:#FFF;" action="" method="post">
					<?php
						$dateTo=date("Y-m-d");
						$dateFrom=date("Y-m-d");
						$sql="SELECT DATE(MIN(tglPesan)) FROM ms_pesanan";
						$result=$conn->query($sql);
						if($result->num_rows > 0) {
							if($row=$result->fetch_assoc()){
								$dateFrom=$row['DATE(MIN(tglPesan))'];
							}
						}
					?>
  				Report from :
  				<input type="date" name="fromDate" max="<?php echo $dateTo; ?>" min="<?php echo $dateFrom; ?>">
					to :
					<input type="date" name="toDate" max="<?php echo $dateTo; ?>" min="<?php echo $dateFrom; ?>">
					<input type="submit" name="query" value="Search" style="display:inline-block; width:80px; vertical-align: middle;height:30px; margin: 2px auto; padding:2px;">
				</form>
                <table style="color:#FFF; width:60%; margin:0px auto">
  				<tr>
    				<th>Menu Name</th>
   					<th>Sales</th>
                </tr>
				<?php
					if(isset($_POST['query'])){
						$tglFrom=$_POST['fromDate'];
						$tglTo=$_POST['toDate'];
						$sql="SELECT DISTINCT(mm.namaMenu), sum(tp.qty) from tr_pesanan tp, ms_menu mm, ms_pesanan mp where mm.idMenu=tp.idMenu AND tp.idPesanan=mp.idPesanan AND DATE(tglPesan) BETWEEN '$tglFrom' AND '$tglTo' GROUP by tp.idMenu ORDER by SUM(tp.qty) DESC";
						$result=$conn->query($sql);
						if($result->num_rows > 0) {
							while($row=$result->fetch_assoc()){
				?>
                <tr>
                    <td style="text-align:left"><?php echo $row['namaMenu']; ?></td>
                    <td><?php echo $row['sum(tp.qty)']; ?></td>
                </tr>
				<?php
							}
						}
					}
				?>
                </table>
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
