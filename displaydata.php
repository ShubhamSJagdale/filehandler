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
      <li class="nav-item active">
        <a class="nav-link" href="fetchexceldata.php">Show Data</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Log Out</a>
      </li>
    </ul>
  </div>
</nav>

<?php
	require_once "classes/PHPExcel.php";
#$inputFileType = 'Excel5'; 
$inputFileName = '.\Downloads\book1.xlsx'; 
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);

$sheetname = 'Data Sheet #1'; 

// ******************************Sheet 2 *************************************
/**  Define a Read Filter class implementing PHPExcel_Reader_IReadFilter  */ 

class MyReadFilter implements PHPExcel_Reader_IReadFilter 
{ 
    private $_startRow = 0; 
    private $_endRow   = 0; 
    private $_columns  = array(); 

    /**  Get the list of rows and columns to read  */ 
    
    public function __construct($startRow, $endRow, $columns) { 
        $this->_startRow = $startRow; 
        $this->_endRow   = $endRow; 
        $this->_columns  = $columns; 
    } 

    public function readCell($column, $row, $worksheetName = '') { 
        //  Only read the rows and columns that were         configured 
        if ($row >= $this->_startRow && $row <= $this->_endRow) { 
            if (in_array($column,$this->_columns)) { 
                return true; 
            } 
        } 

        return false; 
    } 
} 
/*
/**  Create an Instance of our Read Filter, passing in the cell range  **/
$filterSubset = new MyReadFilter(1,5,range('A','D'));
$objReader = PHPExcel_IOFactory::createReader($inputFileType);

#$objReader->setLoadSheetsOnly($sheetname);
#echo 'Loading Sheet using configurable filter<br />';
$objReader->setReadFilter($filterSubset);

$objPHPExcel = $objReader->load($inputFileName);


echo '<hr />';

$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
#var_dump($sheetData);
echo "<br>";

foreach($sheetData as $product){
    foreach($product as $key => $val){
        echo "$key: $val";
       
            }
}



?>
</div>