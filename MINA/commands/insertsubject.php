<?php
	session_start();
	include('databaseinfo.php');

	$check_user = $_SESSION['login_user'];

	$code = $_REQUEST['code'];
	$title = $_REQUEST['title'];
	$unit = $_REQUEST['units'];

	if(trim($code) == '' || trim($title) == '' || trim($unit) == '') {
		$msg = "Error. Please try again with valid inputs.";
		echo "<script type='text/javascript'> alert('$message');</script>";
		echo "ERROR: Meh..". mysqli_error($conn);
		header("Location: ../pages/subjects.php");
	} else {
		$sql = "INSERT INTO subject (code, title, unit) VALUES ('$code','$title', $unit)";
		if(mysqli_query($conn, $sql)) {
			echo "<script type='text/javascript'> alert('Records added successfully.');</script>";
			header("Location: ../pages/subjects.php");
		} else {
			$msg = "Error. Please try again with valid inputs.";
			echo "<script type='text/javascript'> alert('$message');</script>";
			echo "ERROR: Meh..". mysqli_error($conn);
			header("Location: ../pages/subjects.php");
		}
	}
	
	mysqli_close($conn);
?>