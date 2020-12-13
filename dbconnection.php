<?php
  function connect(){
    $servername = "127.0.0.1";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "BookKart_Ver1";

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_errno) {
        echo "Connection failed: ". $conn -> connect_error;
    }
    else{

        return $conn;
    }
    
  }


?>

