<?php
	if(isset($_POST['sm'])){
		session_start();
		$no=(int)$_POST['meja'];
		if($no!=null){
			$_SESSION['meja']=$no;
		}else{
			echo "<script>alert('Input table number')</script>";
		}
		if(isset($_SESSION['meja'])){
			header('Location:index.php');
		}
	}
?>
<!doctype html>
<html>
<head>
<title>Dessert Paradiso</title>
<link href='http://fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>
<link rel="icon" href="img.png" type="image/x-icon">
<style>
body {
	background:url(images/kayu.jpg) no-repeat center fixed;
	background-size:cover;
	font-family:gill sans mt;
	font-size:3.5em;
}
#bungkus {
	
	padding-top:-10%;
	text-align:center;
	padding-left:20%;
}
#isi {
	background:#ffffff80;
	width:75%;
	padding:70px 10px;
	border-radius:4px;
}
input[type=text] {
	border-radius:7px;
	text-align:center;
	font-size:40px;
	width:8%;
	font-family:gill sans mt;
	padding:15px;
	background-color:#ffffff80;
    border: none;
	border-bottom: 2px solid black;
}
input[type=text]:focus {
    background-color:#997754;
}
#form {
	padding-top:20px;
}
input[type=submit] {
	font-family:gill sans mt;
	font-size:20px;
    background-color: #6b452e;
    border: none;
    color: white;
    padding: 10px 20px;
    text-decoration: none;
    margin: 4px 2px;
    cursor: pointer;
	border-radius:8px;
}
.top-title{
    color: white;
    font-family: 'Playball', cursive;
    font-size: 80px;
	margin:20px 0;
	text-align: center;
	padding:25px 0;
 }

</style>
</head>
	<body>
	<p class="top-title">Dessert Paradiso</p>
	<div id="bungkus">
	
	<div id="isi">
	<div id="tulisan">
	Enter the table number :<br/>
	(Filled only by our employees)
	<div id="form">
		<form action="" method="post">
			<input type="text" name="meja" required/>
			<input type="submit" name="sm"/>
		</form>
	</div>
	</div>
	</div>
	</div>
	</body>
</html>
