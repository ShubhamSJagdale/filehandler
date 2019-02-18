<?php
  		session_start();
      echo $_SESSION['username'];
       if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')){
    header ("Location: login.html");
  }
  		$username = $_SESSION['username'];

      $target_dir = "Downloads/";
      $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
      $uploadOk = 1;
      $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


      // Check if image file is a actual image or fake image
    /*  if(isset($_POST["submit"])) {
          $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
          if($check !== false) {
              echo "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;
          } else {
              echo "File is not an image.";
              $uploadOk = 0;
          }
      }
      // Check if file already exists
      if (file_exists($target_file)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
      }*/
      // Check file size
      if ($_FILES["fileToUpload"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
      }
      // Allow certain file formats
      if($FileType != "xlsx" ) {
          echo "Sorry, only .xlsx files are allowed."."<br>";
          $uploadOk = 0;
      }
      // Check if $uploadOk is set to 0 by an error
      if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
      } else {
          if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
              echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
              $filename = basename( $_FILES["fileToUpload"]["name"]);
              $server = "localhost";
			  $user = "root";
			  $pass = "";
			  $database = "file";
			  $con = mysqli_connect($server,$user,$pass,$database);
			  if ($con)
						{
							echo "Success";

							$user =mysqli_query($con,"select userid from users where email ='$username'");
							$useri = mysqli_fetch_object($user);
							$userid = $useri->userid;
							echo $userid;
							echo $filename;
							mysqli_query($con,"INSERT INTO `filenames` (`fileid`, `userid`, `filename`) VALUES (NULL, '$userid', '$filename') ");
							mysqli_close($con);
						}
						else
						{
							echo "failed".mysql_error();
						}

					          } else {
					              echo "Sorry, there was an error uploading your file.";
					          }
					      }
					?>