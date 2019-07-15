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
		while(true){
			$rand1=rand(10,99);
			$rand2=rand(1000,9999);
			$rand3=rand(1000,9999);
			$id=$rand1.$rand2.$rand3;
			$sql="SELECT idMenu FROM ms_menu WHERE idMenu = '$id'";
			$result=$conn->query($sql);
			if($result->num_rows == 0) {
				$newNamaImg=$id;
				break;
			}
		}
		$namaImg = $_POST['id'];
		$menu = $_POST['modmenu'];
		$name = $_POST['nama'];
		$desc = $_POST['desc'];
		$prz = (int)$_POST['prz'];
		if(file_exists($_FILES['file']['tmp_name']) || is_uploaded_file($_FILES['file']['tmp_name'])){
			$ekstensi_diperbolehkan	= array('png','jpg');
			$nama = $_FILES['file']['name'];
			$x = explode('.', $nama);
			$ekstensi = strtolower(end($x));
			$ukuran	= $_FILES['file']['size'];
			$file_tmp = $_FILES['file']['tmp_name'];
			$eksImg='';
			if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
				if($ukuran < 10000000){
					move_uploaded_file($file_tmp, '../CustomerUI/images/'.$newNamaImg.'.'.$ekstensi);
					$eksImg=$ekstensi;
				}else{
					echo "<script type='text/javascript'> alert('File size is too big'); </script>";
				}
			}else{
				echo "<script type='text/javascript'> alert('File extension prohibited'); </script>";
			}
			$sql="UPDATE ms_menu SET ekstensi='$eksImg', jenis='$menu', namaMenu='$name', keterangan='$desc', hargaMenu=$prz WHERE idMenu='$namaImg'";
			if($conn->query($sql)===TRUE) {
				$sql="UPDATE ms_menu SET idMenu='$newNamaImg' WHERE ekstensi='$eksImg' and jenis='$menu' and namaMenu='$name' and keterangan='$desc' and hargaMenu=$prz";
				if($conn->query($sql)===TRUE) {
					echo "<script type='text/javascript'> alert('Update menu succeed'); </script>";
				}else{
					echo "<script type='text/javascript'> alert('Update menu failed'); </script>";
				}
			}else{
				echo "<script type='text/javascript'> alert('Update menu failed'); </script>";
			}
		}else{
			$sql="UPDATE ms_menu SET jenis='$menu', namaMenu='$name', keterangan='$desc', hargaMenu=$prz WHERE idMenu='$namaImg'";
			if($conn->query($sql)===TRUE) {
				echo "<script type='text/javascript'> alert('Update menu succeed'); </script>";
			}else{
				echo "<script type='text/javascript'> alert('Update menu failed'); </script>";
			}
		}
  }

	if(isset($_POST['del'])){
		$id=$_POST['id'];
		$sql="DELETE FROM ms_menu WHERE idMenu='$id'";
		if($conn->query($sql)===TRUE) {
			echo "<script type='text/javascript'> alert('Delete menu succeed'); </script>";
		}else{
			echo "<script type='text/javascript'> alert('Delete menu failed'); </script>";
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
              <h2 style="color:#FFF; font-size:1.5em">Update/Delete Menu</h2>
  				<p>&nbsp; </p>
					<input type="text" id="search" onkeyup="search()" placeholder="Search by Name" style="margin:0px auto 10px; width:18%; height:15px; font-size:0.9em; text-align:center;">
					<p>&nbsp; </p>
				<form action="" method="post" enctype="multipart/form-data">
					<table id="data" class="table table-hover" style="color:#FFF; width:100%">
					<tr>
						<th>Images</th>
						<th>Name</th>
						<th>Description</th>
						<th>Price</th>
						<th>Category</th>
						<th>Action</th>
					</tr>
					<?php
						$sql="SELECT * from ms_menu order by jenis asc";
						$result=$conn->query($sql);
						if($result->num_rows > 0) {
							$count=0;
							$menu = new Menu;
							while($row=$result->fetch_assoc()){
								$count++;
								$menu->id=$row['idMenu'];
								$menu->eks=$row['ekstensi'];
								$menu->nama=$row['namaMenu'];
								$menu->ket=$row['keterangan'];
								$menu->hrg=$row['hargaMenu'];
								$menu->jns=$row['jenis'];
					?>
					<tr id="row<?php echo $count; ?>">
						<td style="margin:2px;vertical-align:top;" id="img_row<?php echo $count; ?>"><img id="<?php echo $menu->id; ?>" src="../CustomerUI/images/<?php echo $menu->id.".".$menu->eks; ?>" style="width:75px;height:65px;vertical-align:top"></td>
						<td style="margin:2px; width:200px;vertical-align:top;" id="name_row<?php echo $count; ?>"><?php echo $menu->nama; ?></td>
						<td style="margin:2px; padding:10px;vertical-align:top;" id="desc_row<?php echo $count; ?>"><?php echo $menu->ket; ?></td>
						<td style="margin:2px;vertical-align:top;" id="prz_row<?php echo $count; ?>"><?php echo $menu->hrg; ?></td>
						<td style="margin:2px; width:130px; text-align:center;vertical-align:top;" id="jenis_row<?php echo $count; ?>"><?php if($menu->jns=='cakes') echo "Cakes"; else if($menu->jns=='icecream') echo "Ice Cream"; else if($menu->jns=='salad') echo "Salad"; else echo "Beverages"; ?></td>
						<td style="margin:2px; width:90px;vertical-align:top;">
							<input type="button" id="edit_button<?php echo $count; ?>" onclick="edit_row('<?php echo $count; ?>')" value="Edit Menu" style="font-size:1em; color:#fff; background:#6439af; border:none; width:100px; height:30px;">
							<input type="submit" id="save_button<?php echo $count; ?>" value="Save" style="width:100px;height:30px;padding:0px;margin:0px;display:none;" name="save">
							<input type="submit" id="del_button<?php echo $count; ?>" value="Delete" style="width:100px;height:30px;padding:0px;margin:0px; display:none" name="del">
							<button id="esc_button<?php echo $count; ?>" style="border:none;width:100px;height:30px;padding:0px;margin:0px; display:none; background:#6439af;color:#fff; font-size:1em;" onclick="location.reload()">Batal</button>
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

				 var id=document.getElementById("img_row"+no).childNodes[0].id;
				 var img=document.getElementById("img_row"+no);
				 var name=document.getElementById("name_row"+no);
				 var desc=document.getElementById("desc_row"+no);
				 var prz=document.getElementById("prz_row"+no);
				 var jenis=document.getElementById("jenis_row"+no);

				 document.getElementById("id").setAttribute("value", id);
				 var name_data=name.innerHTML;
				 var desc_data=desc.innerHTML;
				 var prz_data=prz.innerHTML;
				 var jenis_data=jenis.innerHTML;

				 img.innerHTML+="<input type='file' name='file' id='fileToUpload' style='vertical-align:top;height:20px; width:90px; border:none'>";
				 name.innerHTML="<input type='text' name='nama' style='vertical-align:top;width:100px; height:1em; margin:0px auto;' value='"+name_data+"' required>";
				 desc.innerHTML="<textarea name='desc' style='vertical-align:top;width:100%; height:8em; font:inherit; padding:1px;overflow-y:scroll; border:none; border-bottom:1px solid #fff; resize:none; background-color:transparent; color:#fff' required>"+desc_data+"</textarea>";
				 prz.innerHTML="<input type='text' name='prz' style='vertical-align:top;width:20px; height:1em; margin:0px auto;' value='"+prz_data+"' required>";
				 if(jenis_data=="Cakes"){
					jenis.innerHTML="<input type='radio' name='modmenu' value='cakes' checked> Cakes<br><input type='radio' name='modmenu' value='icecream'> Ice Cream<br><input type='radio' name='modmenu' value='salad'> Salad<br><input type='radio' name='modmenu' value='beverages'> Beverages";
				 }else if(jenis_data=="Ice Cream"){
					jenis.innerHTML="<input type='radio' name='modmenu' value='cakes'> Cakes<br><input type='radio' name='modmenu' value='icecream' checked> Ice Cream<br><input type='radio' name='modmenu' value='salad'> Salad<br><input type='radio' name='modmenu' value='beverages'> Beverages";
				 }else if(jenis_data=="Salad"){
					jenis.innerHTML="<input type='radio' name='modmenu' value='cakes'> Cakes<br><input type='radio' name='modmenu' value='icecream'> Ice Cream<br><input type='radio' name='modmenu' value='salad' checked> Salad<br><input type='radio' name='modmenu' value='beverages'> Beverages";
				 }else{
					jenis.innerHTML="<input type='radio' name='modmenu' value='cakes'> Cakes<br><input type='radio' name='modmenu' value='icecream'> Ice Cream<br><input type='radio' name='modmenu' value='salad'> Salad<br><input type='radio' name='modmenu' value='beverages' checked> Beverages";
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
				td = tr[i].getElementsByTagName("td")[1];
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
