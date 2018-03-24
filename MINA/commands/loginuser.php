<?php
	$invalid='';
	if(isset($_POST['submit'])) {
		if(empty($_POST['uname']) || empty($_POST['pword'])) {
			$invalid = "Incorrect username or password.";
		} else {
			include('databaseinfo.php');
			$uname = $_REQUEST['uname'];
			$pword = $_REQUEST['pword'];

			$sql = "SELECT * FROM account WHERE uname = '$uname' AND pword = '$pword'";
			$result = mysqli_query($conn, $sql);
			$rows = mysqli_num_rows($result);

			if($rows == 1) {
				session_start();
				$_SESSION['login_user'] = $uname;
				header("Location: ../pages/home.php");
			} else {
				$invalid = "Incorrect username or password.";
			}
			mysqli_close($conn);
		}
	}
?>