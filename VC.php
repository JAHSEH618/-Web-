<?php
	header('Content-Type: text/html; charset=utf-8');
	$email = $_POST['em'];
	$c = produ();
	use PHPMailer\PHPMailer\PHPMailer; 
	use PHPMailer\PHPMailer\Exception; 

	require '../PHP/src/Exception.php'; 
	require '../PHP/src/PHPMailer.php'; 
	require '../PHP/src/SMTP.php';

	session_start();
	$_SESSION['vc'] = $c; 

	$mail = new PHPMailer(true);
	try {
		$mail->CharSet = "UTF-8";
		$mail->SMTPDebug = 0;
		$mail->isSMTP();
		$mail->Host = 'smtp.163.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'jahse_hliu@163.com';
		$mail->Password = 'SUYQIAFSZZCWIQGY';
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;
		$mail->setFrom('jahse_hliu@163.com', 'GEYKUME');
		$mail->addAddress($email);
		$mail->addReplyTo('jahse_hliu@163.com', 'info');
		$mail->isHTML(true);
		$mail->Subject = 'VERIFY CODE';
		$mail->Body = $c . date(' Y-m-d H:i:s');
		$mail->AltBody = 'If email client does not support HTML then show this content';
		$mail->send();
		echo 'MAIL SENT SUCCESSFULLY!';
	}catch(Exception $e){
		echo 'MAIL SENT FAILED:', $mail->ErrorInfo;
	}



	function produ() {
		$arr1 = range('a','z');
		$arr2 = range('A','Z');
		$arr3 = range(0,9);
		$arr = array_merge($arr1,$arr2,$arr3);
		shuffle($arr);
		$code = $arr[0].$arr[1].$arr[2].$arr[3];
		return $code;
	}
?>