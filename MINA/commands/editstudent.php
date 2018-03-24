<?php
	session_start();
	include('databaseinfo.php');
	
	$check_user = $_SESSION['login_user'];

	$id = $_REQUEST['idedit'];
	$lname = $_REQUEST['lnameedit'];
	$fname = $_REQUEST['fnameedit'];
	$mname = $_REQUEST['mnameedit'];
	$gender = $_REQUEST['genderedit'];
	$bb = $_REQUEST['bdateedit'];
	$nationality = $_REQUEST['nationalityedit'];
	$regular = $_REQUEST['isregularedit'];
	$yearstatus = $_REQUEST['yearstatusedit'];
	$program = $_REQUEST['programedit'];

	$bdate = trim($bb);
	echo $gender;

	$sql = "UPDATE student SET lastname = '$lname', firstname = '$fname', middlename = '$mname', gender = $gender, birthdate = '$bdate', nationality_id=$nationality, regular = $regular, yearstatus = $yearstatus, program_id = $program WHERE id = $id";

	if(mysqli_query($conn, $sql)) {
		echo "Records added successfully.";
		//header("Location: ../pages/students.php");
	} else {
		$msg = "Error. Please try again with valid inputs.";
		echo "<script type='text/javascript'> alert('$msg');</script>";
		echo "ERROR: Meh..". mysqli_error($conn);
		//header("Location: ../pages/students.php");
	}
	mysqli_close($conn);
?>