
<!DOCTYPE HTML>  
<html>
    <head>
        <title>Register</title>
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

            

           
            $username = $pass = $contact = $usertype = "";
            $pass1 = $pass2 = "";
            $flag = 0;
                
            $username = test_input($_POST["username"]);
            $usertype = test_input($_POST["usertype"]);
            $pass1 = test_input($_POST["pwd1"]);
            $pass2 = test_input($_POST["pwd2"]);
            if ($pass1 == $pass2){
                $pass = $pass1;
            }
            else{
                echo "Password didn't match";
                echo "<br><a href='index.html'><button>Go Back</button></a><br>";

                $flag = 1;
            }

            //$temp_contact = test_input($_POST["contact"]);
            /*
            if(validate_mobile($temp_contact)){
                $contact = $temp_contact;
            }else{
                echo "invalid contact";
                echo "<br><a href='index.html'><button>Go Back</button></a><br>";
                $flag = 1;
            }
            */
            if ($flag == 0){
                $conn = connect();
                add_user($conn,$username,$pass,$usertype);
            }


            

            function add_user($conn,$username,$password,$usertype){

                $sql = "SELECT user_name FROM user";
                $result = $conn->query($sql);
                $flag_nonexisting_user = 0;
                if ($result->num_rows > 0) {
                    
                // output data of each row
                
                    while($row = $result->fetch_assoc()) {
                        
                        if($row["user_name"] === $username){
                            echo "Username already taken";
                            echo "<br><a href='index.html'><button>Go Back</button></a><br>";
                            $flag_nonexisting_user=0;
                            break;
                        }
                        else{
                            $flag_nonexisting_user = 1;
                        }
                        
                    }
                    if ($flag_nonexisting_user == 1){
                        
                        $sql = "INSERT INTO user VALUES ('$username','$password',$usertype)";

                        if ($conn->query($sql) === TRUE) {
                            echo "Registered";
                            echo "<br><a href='index.html'><button>Login/Register</button></a><br>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                            echo "<br><a href='index.html'><button>Go Back</button></a><br>";
                        } 
                    }
                } 
                else {
                    $sql = "INSERT INTO user VALUES ('$username','$password',$usertype)";

                    if ($conn->query($sql) === TRUE) {
                    echo "Registered";
                    echo "<br><a href='index.html'><button>Login/Register</button></a><br>";
                    } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                    }    
                }


               
                $conn->close();
            }

        ?>        

        

    </body>
</html>