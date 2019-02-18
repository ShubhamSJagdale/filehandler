<?php
	session_start();
	$username = $_POST["username"];
	$password = $_POST["password"];
	$_SESSION["username"] = $username;
	$server = "localhost";
	$user = "root";
	$pass = "";
	$database = "file";
	$con = mysqli_connect($server,$user,$pass,$database);
	if ($con)
	{
			$sql = "SELECT email, password FROM users";
			$result = $con->query($sql);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()){
				if ($username == $row["email"])
				{
					 if ($password == $row["password"])
					 {
					 	echo "right";
					 	mysqli_close($con);
					 	header("Location:homepage.php");
					 }
					 elseif ($password != $row["password"]) {
						 echo '<script type="text/javascript">'; 
						 echo 'alert("Email or password is not matching..!");'; 
						 echo 'window.location.href = "login.html";';
						 echo '</script>';

					 }
				}
			}
		}
			mysqli_close($con);
	}
		else
		{
			echo "failed".mysql_error();
		}
?>
<html>