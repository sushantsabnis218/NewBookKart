<html>
    <head>
        <title>Registration</title>
    </head>
    <body>
        
        <form method=post name=reg_form>
            Enter name:<input type=text name=reg_user></input></br>
            Enter password:<input type=password name=reg_pass></input></br>
            <input type=submit></input></br>
        </form>
        <?php
           echo "Username:".$_POST['reg_user']
        ?>
    </body>
</html>