<?php
	session_start();
	include('databaseinfo.php');

	$check_user = $_SESSION['login_user'];

	$name = $_REQUEST['nameedit'];
	$id = $_REQUEST['idedit'];

	if(trim($name) == '') {
		echo "ERROR: Meh..". mysqli_error($conn);
		header("Location: ../pages/nationality.php");
	} else {
		$sql = "UPDATE nationality SET name = '$name' WHERE id = $id";
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