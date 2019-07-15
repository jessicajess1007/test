<?php
	include '../connect.php';
	session_start();
	$idPesan=$_SESSION['pesan'];
	$noMeja=$_SESSION['meja'];
	if(isset($_POST['order'])){
		$cek=0;
		$count=0;
		$sql="INSERT INTO ms_pesanan(`idPesanan`, `noMeja`, `status`) VALUES('$idPesan','$noMeja','1')";
		if($conn->query($sql)===TRUE) {
			$cek=1;
		}else{
			$cek=0;
		}
		while(isset($_POST['id'.$count]) && $cek==1){
			$idMenu=$_POST['id'.$count];
			$qtyMenu=$_POST['qty'.$count];
			$sql="INSERT INTO tr_pesanan VALUES('$idPesan','$idMenu','$qtyMenu')";
			if($conn->query($sql)===TRUE) {
				$cek=1;
			}else{
				$cek=0;
			}
			$count++;
		}
		if($cek==1){
			echo "<script>
				alert('Thank you for ordering :) Plesase be patient while our staff will cooking and preparing your order');
			</script>";
			header( "refresh:0;url=index.php" );
		}else{
			echo "<script>alert('Gagal')</script>";
		}
	}
?>
<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Dessert Paradiso</title>
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css" media="screen" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style-portfolio.css">
        <link rel="stylesheet" href="css/picto-foundry-food.css" />
        <link rel="stylesheet" href="css/jquery-ui.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link rel="icon" href="img.png" type="image/x-icon">
    </head>

    <body>

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="row">
                <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php">Dessert Paradiso</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav main-nav  clear navbar-right ">
                            <li><a class="color_animation inactive" data-toggle="modal" data-target="#ask" onclick="listOrder()" style="font-size:20px;">Your Order</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </div><!-- /.container-fluid -->
        </nav>
		<div id="ask" class="modal" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Your Order</h4>
					</div>
					<div class="modal-body container-fluid">
						<table id="daftar" class="col-md-10 col-md-offset-1" border="3">
							<thead style="text-align:center; border-bottom:1px solid black;">
								<td>Items</td>
								<td>Qty</td>
								<td>Prize</td>
							</thead>
							<tbody id="isidaftar">
							</tbody>
							<tfoot style="border-top-style:double">
								<td style="text-align:center" colspan="2">Total</td>
								<td id="total" style="text-align:right"></td>
							</tfoot>
						</table>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default"><form action="" method="post" id="formpesan"><div id="simpan"></div><input type="submit" value="Order" name="order" style="border:none; background-color:white;" /></form></button>
					</div>
				</div>
			</div>
		</div>
        <!-- ============ About Us ============= -->
	

		<div id="a">
            <div class="text-content container" id="menumenu" style=" width:100%;">
                <div>
					<ul id="filter-list" class="clearfix">
                        <li class="filter active" data-filter="all" class="tablinks" onclick="openCity(event, 'favourites')">Favourites</li>
                        <li class="filter" data-filter="cakes" class="tablinks" onclick="openCity(event, 'cakes')">Cakes</li>
                        <li class="filter" data-filter="icecream" class="tablinks" onclick="openCity(event, 'icecream')">Ice Cream</li>
                        <li class="filter" data-filter="salad" class="tablinks" onclick="openCity(event, 'salad')">Salad & Pudding</li>
                        <li class="filter" data-filter="beverages" class="tablinks" onclick="openCity(event, 'beverages')">Beverages</li>
                    </ul><!-- @end #filter-list -->
					
					<div id="w" style="max-width: 1100px;">
					<h1 id="favourites" class="tabcontent" align="center">Favourites</h1>
                    <h1 id="cakes" class="tabcontent" align="center" style="display:none">Cakes</h1>
					<h1 id="icecream" class="tabcontent" align="center" style="display:none">Ice Cream</h1>
					<h1 id="salad" class="tabcontent" align="center" style="display:none">Salad & Pudding</h1>
					<h1 id="beverages" class="tabcontent" align="center" style="display:none">Beverages</h1>
					<div class="fa fa-cutlery fa-2x"></div>
					<table id="portfolio" class="table row">
					<?php 
						include '../connect.php';
						$sql="SELECT * FROM ms_menu";
						$result=$conn->query($sql);
						$count=0;
						if($result->num_rows > 0) {
							while($row=$result->fetch_assoc()){
								$count++;
					?>
					<tr class="item <?php echo $row['jenis']; ?>">
						<td><img src="images/<?php echo $row['idMenu'].".".$row['ekstensi']; ?>" width="200" height="200"></td>
						<td><p class="desc-text judul"><?php echo $row['namaMenu']; ?></p><p class="desc-text"><?php echo $row['keterangan']; ?></td>
						<td class="lebar"><p class="desc-text harga"><?php echo $row['hargaMenu']; ?>K</p></td>
						<td class="lebar"><div class="input-group">
								<span class="input-group-btn">
								<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[<?php echo $count; ?>]">
								<span class="glyphicon glyphicon-minus"></span>
								</button>
								</span>
								<input type="text" id="<?php echo $row['idMenu']; ?>" name="quant[<?php echo $count; ?>]" class="form-control input-number" value="0" min="0" max="20" style="width:50px;">
								<span class="input-group-btn">
								<button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[<?php echo $count; ?>]">
								<span class="glyphicon glyphicon-plus"></span>
								</button>
								</span>
							  </div></td>
					</tr>
					<?php		
							}
						}
					?>
					</table>
					</div>
                </div>
                
            </div>
			</div>
     



        <!-- ============ Footer Section  ============= -->

        <footer class="sub_footer">
            <div class="container">
                <div class="col-md-4"><p class="sub-footer-text text-center">&copy; Restaurant 2014, Theme by <a href="https://themewagon.com/">ThemeWagon</a></p></div>
                <div class="col-md-4"><p class="sub-footer-text text-center">Back to <a href="#pricing">TOP</a></p>
                </div>
                <div class="col-md-4"><p class="sub-footer-text text-center">Built With Care By <a href="#" target="_blank">Us</a></p></div>
            </div>
        </footer>


        <script type="text/javascript" src="js/jquery-1.10.2.min.js"> </script>
        <script type="text/javascript" src="js/bootstrap.min.js" ></script>
        <script type="text/javascript" src="js/jquery-1.10.2.js"></script>     
        <script type="text/javascript" src="js/jquery.mixitup.min.js" ></script>
        <script type="text/javascript" src="js/main.js" ></script>
		
		<script>
			function listOrder(){
				var ids = new Array();
				var name = new Array();
				var values = new Array();
				var hrg = new Array();
				var nilai = document.getElementsByClassName("input-number");
				var nama = document.getElementsByClassName("judul");
				var price = document.getElementsByClassName("harga");
				var sum = nilai.length;
				var count = 0;
				for(i=0;i<sum;i++){
					if(nilai[i].value > 0){
						ids.push(nilai[i].id);
						name.push(nama[i].innerHTML);
						values.push(parseInt(nilai[i].value));
						hrg.push(parseInt(price[i].innerHTML.substring(0,2)));
						count++;
					}
				}
				var tabel=document.getElementById("daftar");
				var jumlah=document.getElementById("total");
				var pesan=document.getElementById("formpesan");
				var old_kirim = document.getElementById("simpan");
				var old_badan=document.getElementById("isidaftar");
				var new_badan=document.createElement("tbody");
				var new_kirim=document.createElement("div");
				var baris, kolom1, kolom2, kolom3, badan, isi1, isi2, isi3, subtotal, form1, form2;
				var total=0;
				for(i=0;i<ids.length;i++){
					isi1=document.createTextNode(name[i]);
					isi2=document.createTextNode(values[i]);
					subtotal=values[i]*hrg[i];
					total+=subtotal;
					isi3=document.createTextNode(subtotal+".000");
					form1=document.createElement("input");
					form2=document.createElement("input");
					form1.setAttribute("type", "hidden");
					form1.setAttribute("name", "id"+i);
					form1.setAttribute("value", ids[i]);
					form2.setAttribute("type", "hidden");
					form2.setAttribute("name", "qty"+i);
					form2.setAttribute("value", values[i]);
					new_kirim.appendChild(form1);
					new_kirim.appendChild(form2);
					baris=document.createElement("tr");
					kolom1=document.createElement("td");
					kolom2=document.createElement("td");
					kolom3=document.createElement("td");
					kolom1.appendChild(isi1);
					kolom2.appendChild(isi2);
					kolom3.appendChild(isi3);
					kolom2.setAttribute("style", "text-align:right;");
					kolom3.setAttribute("style", "text-align:right;");
					baris.appendChild(kolom1);
					baris.appendChild(kolom2);
					baris.appendChild(kolom3);
					new_badan.appendChild(baris);
				}
				jumlah.innerHTML=total+".000";
				new_badan.setAttribute("id", "isidaftar");
				new_kirim.setAttribute("id", "simpan");
				daftar.replaceChild(new_badan, old_badan);
				pesan.replaceChild(new_kirim, old_kirim);
			}
		</script>

    </body>
</html>