<?php
    session_start();
    require 'dbconnection.php';
    include_once 'functions.php';

    $connection1=connect();
    
    
    
?>
<html>
    <head>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class=boxter>
            <?php manage_orders($connection1,$_SESSION['username']);?>
            <br><button id='btn'><a href='logout.php'>LogOut</a></button>
        </div>
    </body>
</html>