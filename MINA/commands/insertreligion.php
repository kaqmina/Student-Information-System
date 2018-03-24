<?php
	session_start();
	include('databaseinfo.php');
	
	$check_user = $_SESSION['login_user'];

	$name = $_REQUEST['name'];

	if(trim($name) == '') {
		$msg = "Error. Please try again with valid inputs.";
		echo "<script type='text/javascript'> alert('$msg');</script>";
		echo "ERROR: Meh..". mysqli_error($conn);
		header("Location: ../pages/religion.php#add");
	} else {
		$sql = "INSERT INTO religion (name) VALUES ('$name')";
		if(mysqli_query($conn, $sql)) {
			echo "<script type='text/javascript'> alert('Record added successfully.');</script>";
			header("Location: ../pages/religion.php");
		} else {
			$msg = "Error. Please try again with valid inputs.";
			echo "<script type='text/javascript'> alert('$msg');</script>";
			echo "ERROR: Meh..". mysqli_error($conn);
			header("Location: ../pages/religion.php#add");
		}
	}
	mysqli_close($conn);
?>