<?php
	$username = $_POST["username"];
	$email = $_POST["email"];
	$password = $_POST["password"];

	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "file";
	$con = mysqli_connect($server,$user,$pass,$database);

	if ($con)
	{
		#echo "Success";
		mysqli_query($con,"INSERT INTO `users` (`userid`, `username`, `email`, `password`) VALUES (NULL, '$username', '$email', '$password') ");
		mysqli_close($con);
	}
	else
	{
		echo "failed".mysql_error();
	}
?>