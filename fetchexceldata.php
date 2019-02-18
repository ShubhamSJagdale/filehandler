
<?php
  session_start();
  if (!(isset($_SESSION['username']) && $_SESSION['username'] != '')){
    header ("Location: login.html");
  }
  $username = $_SESSION['username'];
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  	<form action = "" method="POST">
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">File Handler</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="download.php">Download <span class="sr-only">(current)</span></a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="uploadhome.php">Upload<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Log Out</a>
      </li>
    </ul>
  </div>
</nav>

<div class="form-group" mt-5>
    <h2>Enter File Name to download files </h2>
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea1" name = "filename" rows="1"></textarea>
    <label class="col-md-4 control-label" for="singlebutton"></label>
    <div class="col-md-4">
  
    <button type="submit" class="btn btn-success" mt-4">Submit</button">
  </div>
    </div>



<?php
	require_once "classes/PHPExcel.php";
   # $tmpfname = $_POST['filename'];
    $filename = '.\Downloads\book1.xlsx';
    $inputFileType = PHPExcel_IOFactory::identify($filename);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objReader->setReadDataOnly(true);
    $objPHPExcel = $objReader->load($filename);
    $worksheet = $objReader->getSheet(1);
    $lastRow = $objReader->getHighestRow();
    
    echo "<table border= '1' >";
    for ($row = 1; $row <= $lastRow; $row++) {
       echo "<tr><td><br>";
       echo $worksheet->getCell('A'.$row)->getValue();
       echo "</td><td><br>";
       echo $worksheet->getCell('B'.$row)->getValue();
       echo "</td><tr>";
    }
    echo "</table>";  
?>

	</div>
	</div>
</body>
</html>