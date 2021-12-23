<?php
	header('Content-Type: text/html; charset=utf-8');
	$dbhost = "localhost";
	$charset = 'utf8';
	$dbname = "web";
	$dbuser = "root";
	$dbpass = "root";
	$tbname = "gey";
	$email = $_POST['em'];
	$psd = $_POST['pass'];

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if(!$conn){
		die("BAD CONNECTION: " . mysqli_connect_error());
	}
	$sql = "SELECT * FROM gey WHERE email='$email' AND psd='$psd'";
	$res=mysqli_query($conn, $sql);
	$rownum = mysqli_num_rows($res);
	if($rownum) {
		echo"<script type='text/javascript'>alert('LOGIN SUCCESSFUL!');location='./Homepage.html';</script>";
	}else{
		echo"<script type='text/javascript'>alert('LOGIN FAILED!');location='./Login.html';</script>";
	}
	$conn = null;
?>