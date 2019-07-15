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
	if(isset($_POST['save'])){
		if($_POST['moduser']=='cookhelper') {
			$jbt='2';
		}else {
			$jbt='3';
		}
		$id = $_POST['id'];
		$name = $_POST['nama'];
		$pw = $_POST['pw'];
		$sql="UPDATE ms_pegawai SET nama='$name', pw='$pw', jbt='$jbt' WHERE id='$id'";
		if($conn->query($sql)===TRUE) {
			echo "<script type='text/javascript'> alert('Update succeed'); </script>";
		}else{
			echo "<script type='text/javascript'> alert('Update failed'); </script>";
		}
	}
	if(isset($_POST['del'])){
		$id=$_POST['id'];
		$sql="DELETE FROM ms_pegawai WHERE id='$id'";
		if($conn->query($sql)===TRUE) {
			echo "<script type='text/javascript'> alert('Delete succeed'); </script>";
		}else{
			echo "<script type='text/javascript'> alert('Delete failed'); </script>";
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
			<div class="main-agileinfo">
			  <div class="agileits-top">
              <h2 style="color:#FFF; font-size:1.5em">Update/Delete User</h2>
  				<p>&nbsp; </p>
					<input type="text" id="search" onkeyup="search()" placeholder="Search by ID" style="margin:0px auto 10px; width:18%; height:15px; font-size:0.9em; text-align:center;">
					<p>&nbsp; </p>
				<form action="" method="post">
					<table id="data" class="table table-hover" style="color:#FFF; width:100%">
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Password</th>
						<th>Position</th>
						<th>Action</th>
					</tr>
					<?php
						$sql="SELECT * from ms_pegawai where jbt>'1' order by jbt asc";
						$result=$conn->query($sql);
						if($result->num_rows > 0) {
							$count=0;
							while($row=$result->fetch_assoc()){
								$count++;
					?>
					<tr id="row<?php echo $count; ?>">
						<td style="margin:2px" id="id_row<?php echo $count; ?>"><?php echo $row['id']; ?></td>
						<td style="margin:2px" id="name_row<?php echo $count; ?>"><?php echo $row['nama']; ?></td>
						<td style="margin:2px" id="pw_row<?php echo $count; ?>"><?php echo $row['pw']; ?></td>
						<td style="margin:2px; width:160px; text-align:left;" id="jbt_row<?php echo $count; ?>"><?php if($row['jbt']=='2') echo "Cookhelper"; else echo "Waiter" ?></td>
						<td style="margin:2px; width:90px; padding:15px;">
							<input type="button" id="edit_button<?php echo $count; ?>" onclick="edit_row('<?php echo $count; ?>')" value="Edit User" style=" color:#fff; background:#6439af; font-size:18px;border:none; width:100px; height:30px;">
							<input type="submit" id="save_button<?php echo $count; ?>" value="Save" style="width:100px;height:30px;padding:0px;margin:0px;display:none; font-size:18px;" name="save">
							<input type="submit" id="del_button<?php echo $count; ?>" value="Delete" style="width:100px;height:30px;padding:0px;margin:0px; display:none; font-size:18px;" name="del">
							<button id="esc_button<?php echo $count; ?>" style="border:none;width:100px;height:30px;padding:0px;margin:0px; display:none; background:#6439af;color:#fff; font-size: 18px;" onclick="location.reload()">Cancel</button>
						</td>
					</tr>
					<?php
							}
						}
					?>
					<input id="id" type="hidden" value="" name="id">
					</table>
				</form>
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
			cek=0;
			function edit_row(no){
				if(cek==0){
					document.getElementById("edit_button"+no).style.display="none";
	 			  document.getElementById("save_button"+no).style.display="block";
	 			  document.getElementById("del_button"+no).style.display="block";
					document.getElementById("esc_button"+no).style.display="block";

	 				var id=document.getElementById("id_row"+no).innerHTML;
	 				var name=document.getElementById("name_row"+no);
	 				var pw=document.getElementById("pw_row"+no);
	 				var jbt=document.getElementById("jbt_row"+no);

	 				document.getElementById("id").setAttribute("value", id);
	 				var name_data=name.innerHTML;
	 				var pw_data=pw.innerHTML;
	 				var jbt_data=jbt.innerHTML;

	 				name.innerHTML="<input type='text' name='nama' style='width:100px; height:1em; margin:0px auto; text-align:center;' value='"+name_data+"' required>";
	 				pw.innerHTML="<input type='text' name='pw' style='width:100px; height:1em; margin:0px auto; text-align:center;' value='"+pw_data+"' required>";
	 				if(jbt_data=="Cookhelper"){
	 					jbt.innerHTML="<input type='radio' name='moduser' value='cookhelper' checked> Cook Helper<br/><input type='radio' name='moduser' value='waiter'> Waiter<br/>";
	 				}else{
	 					jbt.innerHTML="<input type='radio'  name='moduser' value='cookhelper'> Cook Helper<br/><input type='radio' name='moduser' value='waiter' checked> Waiter";
	 				}
					cek=1;
				}
			}
			function search(){
				var input, filter, table, tr, td, i;
			  input = document.getElementById("search");
			  filter = input.value.toUpperCase();
			  table = document.getElementById("data");
			  tr = table.getElementsByTagName("tr");

			  // Loop through all table rows, and hide those who don't match the search query
			  for (i = 0; i < tr.length; i++) {
			    td = tr[i].getElementsByTagName("td")[0];
			    if (td) {
			      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
			        tr[i].style.display = "";
			      } else {
			        tr[i].style.display = "none";
			      }
			    }
			  }
			}
		</script>
	</body>
</html>
