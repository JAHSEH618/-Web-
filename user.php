<?php
	$mysql_server_name="localhost";
	$mysql_username="root";
	$mysql_password="root";
	$mysql_database="web";

	$conn=mysql_connect($mysql_server_name, $mysql_username, $mysql_password);
	if(!$conn) {
		echo "Connection failed!".mysql_error();
	}

	$action = isset($_POST['action']) ? $_POST['action'] : '';
	$email = isset($_POST['em']) ? $_POST['em'] : '';
	$psd = isset($_POST['pass']) ? $_POST['pass'] : '';
	$fName = isset($_POST['fName']) ? $_POST['fName'] : '';
	$lName = isset($_POST['lName']) ? $_POST['lName'] : '';

	if($action=='login') {
		login($email, $psd, true);
	}elseif ($action=='create') {
		create($email, $fName, $lName, $psd);
	}elseif ($action=='showAll') {
		showAll();
	}elseif ($action=='modifyPsd') {
		modifyPsd($email, $psd);
	}else {
		$result = array("result"=>"error_request");
		$json = json_encode($result);
		echo $json;
	}

	close_conn();


	function login($email, $psd, $normal) {
		global $conn;

		if($conn) {
			$result = mysql_query("SELECT email, psd from gey");
			$success = false;
			while($row = mysql_fetch_array($result)) {
				if($email == $row['email'] && $psd == $row['psd']) {
					$success = true;
				}
			}
			if ($normal) {
				$login_result = array('login_result'=>$success);
				$json = json_encode($login_result);
				echo $json;
			}
		}
		return $success;
	}

	function create($email, $fName, $lName, $psd) {
		global $conn;
		if($conn) {
			$result=mysql_query("SELECT email from gey");
			$exist=false;
			while($row=mysql_fetch_array($result)) {
				if($email == $row['email']) {
					$exist = true;
					$create_result = array("register_result"=>false,"error_code"=>0);
					$json = json_encode($create_result);
					echo $json;
				}
			}

			if(!$exist) {
				$success = mysql_query("INSERT INTO gey VALUES('$email', '$fName', '$lName', '$psd')");
				if($success) {
					$create_result = array("register_result"=>$success);
					$json = json_encode($create_result);
					echo $json;
				}else{
					$create_result = array("register_result"=>$success,"error_code"=>1);
					$json = json_encode($create_result);
					echo $json;
				}
			}
		}
	}
	
	function close_conn() {
		global $conn;
		mysql_close();
	}
?>