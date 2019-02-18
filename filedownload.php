<?php
 session_start();
  	if (!(isset($_SESSION['username']) || $_SESSION['username'] != '')){
    header ("Location: login.html");
  }

  // Code To download file
if(!empty( $_POST['filename'])){
    $fileName = basename($_POST['filename']);
    $filePath = 'Downloads/'.$fileName;
    if(!empty($fileName) && file_exists($filePath)){
        // Define headers
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: binary");
        
        // Read the file
        readfile($filePath);
        exit;
    }else{
        echo 'The file does not exist.';
    }
} 
?>