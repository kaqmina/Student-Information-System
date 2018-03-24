<?php
	session_start();
	include('databaseinfo.php');
	
	$check_user = $_SESSION['login_user'];

	$sql_session = mysqli_query($conn, "SELECT uname FROM account WHERE uname = '$check_user'");
	$row = mysqli_fetch_array($sql_session);
	$log_session = $row['uname'];
	if(!isset($log_session)) {
		mysql_close($conn);
		header('Location: ../pages/login.php');
	}
?>
