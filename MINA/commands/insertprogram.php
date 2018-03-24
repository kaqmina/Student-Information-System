<?php
	session_start();
	//include('session.php');
	include('databaseinfo.php');
	//$dbname = mysql_select_db(  "school", $conn);
	
	$check_user = $_SESSION['login_user'];

	$code = $_REQUEST['code'];
	$title = $_REQUEST['title'];
	$year = $_REQUEST['year'];

	if(trim($code) == '' || trim($title) == '' || trim($year) == '') {
		$msg = "Error. Please try again with valid inputs.";
		echo "<script type='text/javascript'> alert('$message');</script>";
		echo "ERROR: Meh..". mysqli_error($conn);
		header("Location: ../pages/programs.php");
	} else {
		$sql = "INSERT INTO program (code, title, year) VALUES ('$code','$title', $year)";
		if(mysqli_query($conn, $sql)) {
			echo "<script type='text/javascript'> alert('Records added successfully..');</script>";
			header("Location: ../pages/programs.php");
		} else {
			$msg = "Error. Please try again with valid inputs.";
			echo "<script type='text/javascript'> alert('$message');</script>";
			echo "ERROR: Meh..". mysqli_error($conn);
			header("Location: ../pages/programs.php");
		}
	}
	
	mysqli_close($conn);
?>