<?php
	session_start();
	//include('session.php');
	include('databaseinfo.php');
	//$dbname = mysql_select_db(  "school", $conn);
	
	$check_user = $_SESSION['login_user'];

	$id = $_REQUEST['idedit'];
	$code = $_REQUEST['codeedit'];
	$title = $_REQUEST['titleedit'];
	$year = $_REQUEST['yearedit'];

	if(trim($code) == '' || trim($title) == '' || trim($year) == '') {
		$msg = "Error. Please try again with valid inputs.";
		echo "<script type='text/javascript'> alert('$message');</script>";
		echo "ERROR: Meh..". mysqli_error($conn);
		header("Location: ../pages/programs.php");
	} else {
		$sql = "UPDATE program SET code = '$code', title = '$title', year = $year WHERE id = $id";
	if(mysqli_query($conn, $sql)) {
		echo "<script type='text/javascript'> alert('Records edited successfully..');</script>";
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