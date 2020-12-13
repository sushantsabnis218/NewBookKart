<?php
    session_start();
    require 'dbconnection.php';
    include_once 'functions.php';

    $connection1=connect();
    
    /*
?>
<html>
    Want to Buy a BOOK?<br>
    Please click the Button!<br>
    <form method=post action="<?php echo $_SERVER["PHP_SELF"];?>">
        <input type=submit value="ShowBooks" name=showbooks>
    </form>
    
    <button><a href="logout.php" >LogOut</a></button>
<?php
    if(array_key_exists('showbooks',$_POST)  && isset($_POST['showbooks'])){
        purchase_book($connection1,$_SESSION['username']);
        
    }
 */
   ?>
   <html> 
        <head>
            <link rel="stylesheet" href="styles.css">
        </head>
       <body>
           <div class=boxter>
               <?php echo purchase_book($connection1,$_SESSION['username']);?>
               <br><button id='btn'><a href='logout.php' >LogOut</a></button>
            </div>



</html>