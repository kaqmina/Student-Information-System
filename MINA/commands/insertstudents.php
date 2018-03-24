<?php
	session_start();
	include('databaseinfo.php');
	
	$check_user = $_SESSION['login_user'];

	$lname = $_REQUEST['lname'];
	$fname = $_REQUEST['fname'];
	$mname = $_REQUEST['mname'];
	$gender = $_REQUEST['gender'];
	$bdate = $_REQUEST['bdate'];
	$nationality = $_REQUEST['nationality'];
	$regular = $_REQUEST['isregular'];
	$yearstatus = $_REQUEST['yearstatus'];
	$program = $_REQUEST['program'];

	$sql = "INSERT INTO student (lastname, firstname, middlename, gender, birthdate, nationality_id, regular, yearstatus, program_id) VALUES ('$lname','$fname', '$mname', $gender, '$bdate', '$nationality', $regular, $yearstatus, '$program')";
	if(mysqli_query($conn, $sql)) {
		echo "Records added successfully.";
		header("Location: ../pages/students.php");
	} else {
		$msg = "Error. Please try again with valid inputs.";
		echo "<script type='text/javascript'> alert('$msg');</script>";
		echo "ERROR: Meh..". mysqli_error($conn);
		header("Location: ../pages/students.php");
	}

	mysqli_close($conn);
?>