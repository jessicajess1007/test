<!DOCTYPE html>
<html>

    <head>
        <meta charset="UTF-8">
        <title>Dessert Paradiso - Customer</title>
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
			<div id="fungsi">
				<?php
					include '../connect.php';
					session_start();
					$dis='0';
					if(isset($_SESSION['meja'])){
						$noMeja=$_SESSION['meja'];
					}else{
						header('Location:meja.php');
					}
					$date=date("Ymd");
					$sql="SELECT idPesanan, status FROM ms_pesanan WHERE noMeja='$noMeja' and status > '0'";
					$result=$conn->query($sql);
					if($result->num_rows == 0) {
						while(true){
							$rand=rand(0,99);
							$idp=$date.$noMeja.$rand;
							$sql="SELECT idPesanan FROM ms_pesanan WHERE idPesanan = '$idp'";
							$result=$conn->query($sql);
							if($result->num_rows == 0) {
								break;
							}
						}
						$_SESSION['pesan'] = $idp;
					}else{
						if($row=$result->fetch_assoc()){
							$dis=$row['status'];
						}
					}
					if(isset($_POST['ask'])){
						$sql="SELECT noMeja, status FROM ms_tolong WHERE noMeja = '$noMeja' and status > '0'";
						$result=$conn->query($sql);
						if($result->num_rows > 0) {
							if($row=$result->fetch_assoc()){
								$select=$row['status'];
								if($select=='1'){
									$confirm='Waiting for our waiter\'s respond...';
								}else if($select=='2'){
									$confirm='Our waiter is coming for you.';
								}
							}
						}else{
							while(true){
								$rand=rand(0,9999);
								$idt=$date.$noMeja.$rand;
								$sql="SELECT idTolong FROM ms_tolong WHERE idTolong = '$idt'";
								$result=$conn->query($sql);
								if($result->num_rows == 0) {
									break;
								}
							}
							$sql="INSERT INTO ms_tolong VALUES('$idt','$noMeja','1')";
							if($conn->query($sql)===TRUE) {
								$confirm='Please wait for a moment :)';
							}
						}
						echo "<script type='text/javascript'>
							alert('".$confirm."');
						</script>";
					}
					if(isset($_POST['pay'])){
						$idpesan=$_POST['idPes'];
						$sql="SELECT idPesanan, status FROM ms_pesanan WHERE idPesanan='$idpesan' and status > '0'";
						$result=$conn->query($sql);
						if($result->num_rows > 0) {
							if($row=$result->fetch_assoc()){
								if($row['status']=='2'){
									$sql="UPDATE ms_pesanan SET status='3' WHERE idPesanan='$idpesan'";
									if($conn->query($sql)===TRUE) {
										echo "<script type='text/javascript'> alert('Your transaction request has being processed. Our waiter will coming for you to recieve your payment.'); </script>";
									}
								}else{
									echo "<script type='text/javascript'> alert('Your transaction request can't be done. Your order is still on progress.'); </script>";
								}
							}
						}
					}
				?>
			</div>
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
                        <a class="navbar-brand" href="">Food Society</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav main-nav  clear navbar-right ">
                            <li><a class="navactive color_animation" href="#top">WELCOME</a></li>
                            <li><a class="color_animation" href="#story">ABOUT</a></li>
                            <li><a class="color_animation" href="#pricing">PRICING</a></li>
                            <li><a class="color_animation" href="#beer">CAKE</a></li>
                            <li><a class="color_animation" href="#bread">ICE CREAM</a></li>
                            <li><a class="color_animation" href="#featured">FEATURED</a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div>
            </div><!-- /.container-fluid -->
        </nav>
				<div id="pay" class="modal" role="dialog">
					<div class="modal-dialog">
						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title">Payment Details</h4>
							</div>
							<div class="modal-body container-fluid">
								<table id="daftar" class="col-md-10 col-md-offset-1" border="3">
									<thead style="text-align:center; border-bottom:1px solid black;">
										<td>Items</td>
										<td>Unit Price</td>
										<td>Qty</td>
										<td>Subtotal</td>
									</thead>
									<tbody>
										<?php
											$idpes=$_SESSION['pesan'];
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
												<td style="text-align:right"><?php echo $row['hargaMenu'].".000"; ?></td>
												<td style="text-align:right"><?php echo $row['qty']; ?></td>
												<td style="text-align:right"><?php echo $subtotal.".000"; ?></td>
											</tr>
										<?php
												}
											}
										?>
									</tbody>
									<tfoot style="border-top-style:double">
										<td style="text-align:center" colspan="3">Total</td>
										<td id="total" style="text-align:right"><?php echo $total.".000"; ?></td>
									</tfoot>
								</table>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default">
									<form action="" method="post">
										<input type="hidden" value="<?php echo $idpes; ?>" name="idPes" />
										<input type="submit" value="Check out" name="pay" style="border:none; background-color:white;" />
									</form>
								</button>
							</div>
						</div>
					</div>
				</div>
        <div id="top" class="starter_container bg">
            <div class="fcontainer" style="padding-top:12%">
                <div class="col-md-10 col-md-offset-1">
                    <h2 class="top-title"> Dessert Paradiso</h2>
                    <h2 class="white second-title">" The Best Desert Restaurant in the city "</h2>
                    <hr style="margin:50px auto; border:2px solid white">
					<div>
						<a <?php if($dis=='0') echo "href='menu.php'"; else echo "onclick='sudahPesan(`".$dis."`)'"; ?>><button class="tombolMenu"><h1 style="padding:0px; border:none;">Choose Your Dessert</h1></button></a>
						<form action="" method="post">
							<button class="tombolMenu"><h1 style="padding:0px; border:none;"><input type="submit" value="Ask For Help" name="ask"/></h1></button>
						</form>
						<a href="#"><button class="tombolMenu" <?php if($dis=='2') echo "data-toggle='modal' data-target='#pay'"; else echo "onclick='bayar(`".$dis."`)'"; ?>><h1 style="padding:0px; border:none;">Payment</h1></button></a>
					</div>
                </div>
            </div>
        </div>

        <!-- ============ About Us ============= -->

        <section id="story" class="description_content">
            <div class="text-content container">
                <div class="col-md-6">
                    <h1>About us</h1>
                    <div class="fa fa-cutlery fa-2x"></div>
                    <p class="desc-text">Dessert Paradiso is a restaurant with the best dessert in the city are served. We're having a good cakes, ice creams, salads, and beverages. We also will serve you with the best services we had. Dessert Paradiso has a beautiful architecture and design that provides you to hang out and have fun with your friends. Our surroundings are very friendly for you to enjoy your private time yourself or with your relatives. Find your own happiness with our delicious dessert and enjoy your time at Dessert Paradiso :)</p>
                </div>
                <div class="col-md-6">
                    <div class="img-section">
                       <img src="images/kabob.jpg" width="250" height="220">
                       <img src="images/limes.jpg" width="250" height="220">
                       <div class="img-section-space"></div>
                       <img src="images/radish.jpg"  width="250" height="220">
                       <img src="images/corn.jpg"  width="250" height="220">
                   </div>
                </div>
            </div>
        </section>


       <!-- ============ Pricing  ============= -->


      <section id ="pricing" class="description_content">
             <div class="pricing background_content">
                <h1><span>Affordable</span> pricing</h1>
             </div>
            <div class="text-content container">
                <div class="container">
                    <div class="row">
					<div class="col-md-6">
                    <h1>Price</h1>
                    <div class="fa fa-cutlery fa-2x"></div>
                    <p class="desc-text">We provide you with the most affordable pricing menu that are very pocket-friendly. You don't have to worry if you want to treat your relatives. You curious? Click <a href="menu.php" color="black" id="link">here</a> to find out more!</p>
                </div>
                      <div class="col-md-6">
                    <div class="img-section">
                       <img src="images/asd.jpg" width="450" height="300">
                   </div>
                </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- ============ Our Beer  ============= -->


        <section id ="beer" class="description_content">
            <div  class="beer background_content">
                <h1>Our Special <span>Cakes</span> Menu</h1>
            </div>
            <div class="text-content container">
                <div class="col-md-5">
                   <div class="img-section" style="margin:50px">
                       <img src="images/cakes.jpg" width="400" height="300">
                   </div>
                </div>
                <br>
                <div class="col-md-6 col-md-offset-1">
                    <h1>OUR CAKES</h1>

                    <p class="desc-text"><br/>Here at Dessert Paradiso we’re all about the love of cake. New and bold flavors enter our doors every week, and we can’t help but show them off. While we enjoy the classics, we’re always passionate about discovering something new, so stop by and experience our craft at its best. Click <a href="menu.php" color="black" id="link">here</a> to find out more!</p>
                </div>
            </div>
        </section>


       <!-- ============ Our Bread  ============= -->


        <section id="bread" class=" description_content">
            <div  class="bread background_content">
                <h1>Another Dessert <span>Menu</span></h1>
            </div>
            <div class="text-content container">
                <div class="col-md-6">
                    <h1>OUR ICE CREAM</h1>
                    <div class="icon-bread fa-2x"></div>
                    <p class="desc-text">We love the taste of our creamy ice cream. It is sweetened frozen, and perfectly is eaten as your dessert. It is made from our best dairy products such as milk, cream and other ingredients. We have a lot of kinds of flavors for you to try! Click <a href="menu.php" color="black" id="link">here</a> to find out more!</p>
                </div>
                <div class="col-md-6" style="padding-top:55px; padding-left:20px;">
                    <img src="images/ic2.jpg" width="260" alt="Bread" style="margin-right:5px">
                    <img src="images/ic1.jpeg" width="260" alt="Bread">
                </div>
            </div>
        </section>



        <!-- ============ Featured Dish  ============= -->

        <section id="featured" class="description_content">
            <div  class="featured background_content">
                <h1>Our Featured Beverages <span>Menu</span></h1>
            </div>
            <div class="text-content container">
                <div class="col-md-6">
                    <h1>Have a look to our beverages!</h1>
                    <div class="icon-hotdog fa-2x"></div>
                    <p class="desc-text">We proudly serve you the best beverages we had. It is fresh and made from organic ingredients. We guarantee it will quench your thirst. Click <a href="menu.php" color="black" id="link">here</a> to find out more!</p>
                </div>
                <div class="col-md-6">
                    <ul class="image_box_story2">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="images/minum1.jpg"  alt="...">
                                    <div class="carousel-caption">

                                    </div>
                                </div>
                                <div class="item">
                                    <img src="images/minum2.jpg" alt="...">
                                    <div class="carousel-caption">

                                    </div>
                                </div>
                                <div class="item">
                                    <img src="images/minum3.JPG" alt="...">
                                    <div class="carousel-caption">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </section>



        <!-- ============ Social Section  ============= -->

        <section id="contact" class="social_connect">
            <div class="text-content container">
                <div class="col-md-6">
                    <span class="social_heading">FOLLOW</span>
                    <ul class="social_icons">
                        <li><a class="icon-twitter color_animation" href="#" target="_blank"></a></li>
                        <li><a class="icon-github color_animation" href="#" target="_blank"></a></li>
                        <li><a class="icon-linkedin color_animation" href="#" target="_blank"></a></li>
                        <li><a class="icon-mail color_animation" href="#"></a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <span class="social_heading">OR DIAL</span>
                    <span class="social_info"><a class="color_animation" href="tel:883-335-6524">(941) 883-335-6524</a></span>
                </div>
            </div>
        </section>

        <!-- ============ Contact Section  ============= -->



        <!-- ============ Footer Section  ============= -->

        <footer class="sub_footer">
            <div class="container">
                <div class="col-md-4"><p class="sub-footer-text text-center">&copy; Restaurant 2014, Theme by <a href="https://themewagon.com/">ThemeWagon</a></p></div>
                <div class="col-md-4"><p class="sub-footer-text text-center">Back to <a href="#top">TOP</a></p>
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
			var fungsi = $("#fungsi");
			var cmd = $("#top");
			setInterval(function () {
				fungsi.load("index.php #fungsi");
				cmd.load("index.php #top");
			}, 1000);
			function bayar(pil){
				if(pil=='0') alert("You haven't order yet.");
        else if(pil=='1') alert("Hold on, your orders are being processed");
				else alert("Our waiters will coming for you to help you with the billing process.");
			}
			function sudahPesan(pil){
				if(pil=='1') alert("Hold on, your orders are being processed");
				else alert("Hold on, your orders will be delivering to your table as soon as possible");
			}
		</script>
    </body>
</html>
