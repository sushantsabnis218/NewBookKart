
<?php
    session_start();
?>
<!DOCTYPE HTML>  
<html>
    <head>
        <title>Login</title>
        <style>
        .error {color: #FF0000;}
        </style>
    </head>
    <body>
        
        <?php
            require 'dbconnection.php';

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }


           
            $username = $pass = $usertype = "";
            
            $username = test_input($_POST["username"]);
            $usertype = test_input($_POST["usertype"]);
            //if($username=="" || $usertype=="" ||$pass==""){
              //  echo "Enter valid data!!!";
                //return;
            //}
            $_SESSION['username']=$username;
            //$_SESSION['']
            
            $pass = test_input($_POST["pwd"]);
            $conn = connect();
            user_login($conn,$username,$pass,$usertype);


            

            function user_login($conn,$username,$pass,$usertype){
                if($username=="" || $usertype==""){
                    echo "Enter valid data!!!";
                    
                }
                $sql = "SELECT user_name,password,user_type FROM user";
                $result = $conn->query($sql);
                $flag_user_found = 0;
                if ($result->num_rows > 0) {
                    
                // output data of each row
                
                    while($row = $result->fetch_assoc()) {
                        
                        if($row["user_name"] == $username and $row["password"] == $pass and $row["user_type"] == $usertype){
                            echo "Logged in successfully";

                            if($usertype == 1){
                                //echo "1";
                                header("Location:BookBuyer.php");
                            }
                            elseif($usertype == 2){
                                //echo "2";
                                header("Location:BookSeller.php");
                            }
                            elseif($usertype == 3){
                                header('Location:merchant.php');
                            }
                            echo "<br><a href='index.html'><button id='btn'>Go Back</button></a><br>";
                            $flag_user_found = 1;
                            break;
                        }
                        
                    }
                    if ($flag_user_found == 0 ){
                        echo "Login Unsuccessful";
                        echo "<br><a href='index.html'><button id='btn'>Go Back</button></a><br>";
                    }
                } 
                else {
                    echo "Login Unsuccessful";
                    echo "<br><a href='index.html' ><button id='btn'>Go Back</button></a><br>";
                    }    
            }


               
                $conn->close();

        ?>        

        

    </body>
</html>