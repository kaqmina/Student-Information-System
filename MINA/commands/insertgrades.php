<?php
	session_start();
	//include('session.php');
	include('databaseinfo.php');
	//$dbname = mysql_select_db(  "school", $conn);
	
	$check_user = $_SESSION['login_user'];

	$id = $_REQUEST['studid'];
	$subject = $_REQUEST['subject'];
	$syear = $_REQUEST['syear'];
	$semester = $_REQUEST['semester'];
	$grade = $_REQUEST['grade'];
	$classcode = $_REQUEST['classcode'];


	if(trim($classcode) == '' || trim($grade) == '' || trim($syear) == '') {
	$msg = "Error. Please try again with valid inputs.";
	echo "<script type='text/javascript'> alert('$msg');</script>";
	echo "ERROR: Meh..". mysqli_error($conn);
	header("Location: ../pages/grades.php");
	} else {
		$sql = "INSERT INTO grade (student_id, subject_id, schoolyear, semester, grade, classcode) VALUES ($id, $subject, $syear, $semester, $grade, '$classcode')";
		if(mysqli_query($conn, $sql)) {
			echo "<script type='text/javascript'> alert('Records added successfully.');</script>";
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