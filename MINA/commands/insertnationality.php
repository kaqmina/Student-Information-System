<?php
	session_start();
	include('databaseinfo.php');
	
	$check_user = $_SESSION['login_user'];

	$name = $_REQUEST['name'];

	if(trim($name) == '') {
		$msg = "Error. Please try again with valid inputs.";
		echo "<script type='text/javascript'> alert('$message');</script>";
		echo "ERROR: Meh..". mysqli_error($conn);
		header("Location: ../pages/nationality.php");
	} else {
		$sql = "INSERT INTO nationality (name) VALUES ('$name')";
		if(mysqli_query($conn, $sql)) {
			echo "<script type='text/javascript'> alert('Record added successfully.');</script>";
			header("Location: ../pages/nationality.php");
		} else {
			$msg = "Error. Please try again with valid inputs.";
			echo "<script type='text/javascript'> alert('$message');</script>";
			echo "ERROR: Meh..". mysqli_error($conn);
			header("Location: ../pages/nationality.php");
		}
	}
	mysqli_close($conn);
?>