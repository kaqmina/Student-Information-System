<?php
	session_start();
	include('../commands/databaseinfo.php');
	
	$check_user = $_SESSION['login_user'];

	$id = $_REQUEST['idedit'];
	$yeartaken = $_REQUEST['yeartakenedit'];
	$semester = $_REQUEST['semesteredit'];
	$ismajor = $_REQUEST['ismajoredit'];
	$program = $_REQUEST['programedit'];
	$subject = $_REQUEST['subjectedit'];

	$sql = "UPDATE curriculum SET yeartaken = $yeartaken, semester = $semester, ismajor = $ismajor, program_id = $program, subject_id = $subject WHERE id = " .$id;
	if(mysqli_query($conn, $sql)) {
		echo "Records added successfully.";
		header("Location: ../pages/curriculum.php");
	} else {
		$msg = "Error. Please try again with valid inputs.";
		echo "<script type='text/javascript'> alert('$message');</script>";
		echo "ERROR: Meh..". mysqli_error($conn);
		header("Location: ../pages/curriculum.php");

	}

	mysqli_close($conn);
?>