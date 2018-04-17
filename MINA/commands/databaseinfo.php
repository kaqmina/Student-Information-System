<?php
	//define('DB_SERVER', 'localhost');
    //define('DB_USERNAME', 'encoder');
    //define('DB_PASSWORD', 'encoder');
    //define('DB_DATABASE', 'school');


	//$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

	$servername = "localhost";
	$username = "root";
	$dbname = "school";
	$password = "root";
	
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if(mysqli_connect_errno())
	{
		echo "Failed to connect. Please make sure you are connected to the server.";
	}
?>