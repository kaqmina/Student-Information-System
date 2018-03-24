<?php
	session_start();
	include('../commands/databaseinfo.php');

	$check_user = $_SESSION['login_user'];

	$id = $_REQUEST['id'];
	$yeartaken = $_REQUEST['yeartaken'];
	$semester = $_REQUEST['semester'];
	$ismajor = $_REQUEST['ismajor'];
	$program = $_REQUEST['program'];
	$subject = $_REQUEST['subject'];

	$sql = "INSERT INTO curriculum (yeartaken,semester,ismajor,program_id,subject_id) VALUES ($yeartaken, $semester, $ismajor, $program, $subject)";
	if(mysqli_query($conn, $sql)) {
		echo "Records added successfully.";
		header("Location: ../pages/curriculum.php");
	} else {
		$msg = "Error. Please try again with valid inputs.";
		echo "<script type='text/javascript'> alert('$msg');</script>";
		echo "ERROR: Meh..". mysqli_error($conn);
		header("Location: ../pages/curriculum.php");

	}

	mysqli_close($conn);
?>