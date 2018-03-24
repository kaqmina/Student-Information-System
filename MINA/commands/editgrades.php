<?php
	session_start();
	//include('session.php');
	include('databaseinfo.php');
	//$dbname = mysql_select_db(  "school", $conn);
	
	$check_user = $_SESSION['login_user'];

	$id = $_REQUEST['idedit'];
	$syear = $_REQUEST['syearedit'];
	$semester = $_REQUEST['semesteredit'];
	$grade = $_REQUEST['gradeedit'];
	$classcode = $_REQUEST['classcodeedit'];

	
	if(trim($syear) == '' || trim($grade) == '' || trim($classcode) == '') {
	$msg = "Error. Please try again with valid inputs.";
	echo "<script type='text/javascript'> alert('$msg');</script>";
	echo "ERROR: Meh..". mysqli_error($conn);
	header("Location: ../pages/grades.php");
	} else {
		$sql = "UPDATE grade SET schoolyear = $syear, grade = $grade, classcode = '$classcode', semester = $semester WHERE id = $id";
		if(mysqli_query($conn, $sql)) {
			echo "<script type='text/javascript'> alert('Records added successfully..');</script>";
			header("Location: ../pages/grades.php");
		} else {
			$msg = "Error. Please try again with valid inputs.";
			echo "<script type='text/javascript'> alert('$msg');</script>";
			echo "ERROR: Meh..". mysqli_error($conn);
			header("Location: ../pages/grades.php");
		}
	}
	
	mysqli_close($conn);
?>