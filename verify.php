<?php
	header('Content-Type: text/html; charset=utf-8');
	$dbhost = "localhost";
	$charset = 'utf8';
	$dbname = "web";
	$dbuser = "root";
	$dbpass = "root";
	$tbname = "gey";
	$email = $_POST['em'];
	$vc = $_POST['vc'];

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if(!$conn){
		die("BAD CONNECTION: " . mysqli_connect_error());
	}

	$checkexist = "SELECT * FROM gey WHERE email='$email'";
	$res1 = mysqli_query($conn, $checkexist);
	$num = mysqli_num_rows($res1);
	if(!$num) {
		echo"<script type='text/javascript'>alert('NO SUCH USER!');location='./CREATACC.html';</script>";
	}

	session_start();
	$check = $_SESSION['vc'];

	if($vc==$check) {
		echo"<script type='text/javascript'>alert('LOGIN SUCCESSFUL!');location='./Homepage.html';</script>";
	}else {
		echo"<script type='text/javascript'>alert('WRONG CODE!');location='./VC.html';</script>";
	}
?>