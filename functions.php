
<html>

<head>
    
<style>
        table,th,td{
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
            text-align: left;
        }
    </style>
</head>
<body>

        <?php
            //require 'dbconnection.php';
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                if($data===""){
                   // echo "Please enter valid data!!!";
                    return;
                }
                return $data;
            }

            function display_books($conn){
                //echo "Inside display";
                $sql = "SELECT bookID , book_name , book_qty , priceof1 FROM books ";
                $result = $conn->query($sql);

                if (isset($result->num_rows) && $result->num_rows >0) {
                    
                    echo "<table> <tr> <th>Book ID</th> <th>Title</th> <th>Quantity Available</th> <th>Price of 1 Copy</th></tr>";
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>".$row["bookID"]."</td><td>".$row["book_name"]."</td><td>".$row["book_qty"]."</td> <td>".$row["priceof1"]."</td></tr>";
                    }
                    echo "</table>";
                }
                else {
                    echo "<table> <tr> <th>Book ID</th> <th>Title</th> <th>Quantity</th> </tr>";
                }
                //echo "GOing to purchase again";
                //$conn->close();
            }

            function purchase_book($conn,$user){
                //echo "Inside purchase";
                display_books($conn);
                $bid = $qty = "";
                $flag_book_available = 0;
                
                    echo "<br><br><form method=post >Enter the BookID of the book:<input type=text name=bid></input><br><br>Enter the Quantity of the book:<input type=text name=quantity></input><br><input type=submit value='Check Availibility' id='btn'></form>";
                if (isset($_POST['bid']) && isset($_POST['quantity'])){
                    $bid = test_input($_POST["bid"]);
                    $qty = test_input($_POST["quantity"]);
                    if($bid=="" || $qty==""){
                        echo "Enter valid data :)";
                    
                    }
                    //echo "in here right now";
                }
                //echo "gotya";
                $sql = "SELECT * FROM books";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                        
                        while($row = $result->fetch_assoc()) {
                            if ($row["bookID"]==$bid){
                                $flag_book_available = 1;
                                echo "<h2>Book Available</h2><br>";
                                //echo $row["book_qty"];
                                //echo $qty;
                                if ($row["book_qty"] >= $qty && $qty!=0){
                                    $pricetopay=$row["priceof1"]*$qty;
                                    echo "<h2>Price to pay : Rs.".$pricetopay."</h2>" ;
                                    $book_name=$row['book_name'];
                                ?>
                                    <html>
                                        <form method=post >
                                            <input type=submit value="Place order" name=placeOrder id='btn' action="<?php $is_pressed=true;?>">
                                        </form>
                                    </html>
                                <?php
                
                                    if($is_pressed){
                                        echo "Order under review...Thanks for choosing BookKart :)!";
                                        $insert_order_query="INSERT into orders(book_name,quantity,user_name,order_type,pricetopay) values('$book_name','$qty','$user','Buy',$pricetopay)";

                                        $conn->query($insert_order_query);
                                        $conn->commit();
                                        //return true;
                                        
                                    }
                                }
                                else{
                                    echo "Quantity not available";
                                }
                            }
                        }
                        

                        if ($flag_book_available == 0 && isset($_POST['bid']) && isset($_POST['quantity'])){
                            echo "Book not available";
                        }

                }
                else {
                        echo "0 results";
                }
                $conn->close();
                  
            }
            function sell_book($conn,$user){
                echo "Welcome ".$user." !";
                ?>
                <form method=post >
                    
                    Enter book name: <br><input type=text name="book_name" id=tbox><br><br>
                    Enter quantity: <br> <input type=text name=book_quant id=tbox><br><br>
                    Enter price of single book: <br><input type=text name=book_price id=tbox><br><br>
                    <input type=submit name=submitted id=btn>
                    
                </form>
            <?php
                    if(isset($_POST['submitted'])){
                        $book_name=$_POST['book_name'];
                        $book_quant=$_POST['book_quant'];
                        $priceof1=$_POST['book_price'];
                        if($book_name=="" || $book_quant=="" || $priceof1==""){
                            echo "Enter valid data :)";
                            return;
                        }
                        $insert_query="INSERT INTO orders(book_name,quantity,user_name,order_type,priceof1) values('$book_name',$book_quant,'$user','Sell',$priceof1)";
                        $conn->query($insert_query);
                        $conn->commit();
                        echo " Selling order (Book Name :".$book_name.") will be reviewed!!!";
                    }
            }
            function add_book($conn,$book_name,$book_quant,$priceof1){
                $insert_query="INSERT INTO books(book_name,book_qty,priceof1) values('$book_name',$book_quant,$priceof1);";
                $conn->query($insert_query);
                $conn->commit();
                echo " Selling order (Book Name :".$book_name.") is added!!!";
            }
            function delete_book($conn,$book_id){
                    $delete_book_query="DELETE FROM books WHERE bookID=$book_id";
                    
                    $conn->query($delete_book_query);
                    //echo "BOOK with ID ".$book_id." deleted";
                    $conn->commit();
            }
            function display_orders($conn){
                //echo "Inside display orders";
                $sql = "SELECT * FROM orders ";
                $result = $conn->query($sql);

                if (isset($result->num_rows) && $result->num_rows >0) {
                    
                    echo "<table> <tr> <th>Order ID</th> <th>BookName</th> <th>Quantity</th> <th>User Name</th> <th>Order Type</th> <th>Date/Time</th> <th>Priceof1</th> <th>PriceToPay</th> <th>Status</th> </tr>";
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        //$pricetopay=$row["pricetopay"]*$row["quantity"];
                        echo "<tr><td>".$row["orderID"]."</td><td>".$row["book_name"]."</td><td>".$row["quantity"]."</td> <td>".$row["user_name"]."</td> <td>".$row["order_type"]."</td> <td>".$row["order_date"]."</td><td>".$row['priceof1']."</td><td>".$row['pricetopay']."</td><td>".$row["order_status"]."</td></tr>";
                    }
                    echo "</table>";
                }
                else {
                    echo "<table> <tr> <th>Order ID</th> <th>BookName</th> <th>Quantity</th> <th>User Name</th> <th>Order Type</th> <th>Date/Time</th> <th>Status</th> </tr>";
                }
                //$conn->close();
                
            }
            function manage_orders($conn,$user){
                echo "Welcome ".$user." !<br>";
                echo "<b>Note</b>:Please refresh your page after processing..So you can see the changes in database...:)";
                display_orders($conn);
                //echo "Inside manage orders";
                ?>
                
                <form method=post>
                    Enter order id for processing:<input type=text name=order_process><br>
                    <input type=submit value=Process id='btn'>
                </form>
                <?php
                    
                    if (isset($_POST['order_process']) && array_key_exists('order_process',$_POST)){
                        
                        $order_id=$_POST['order_process'];
                        $order_id=test_input($order_id);
                        if($order_id=="" && isset($_POST['order_process'])){
                            echo "Please enter something...";
                            return;
                        }
                        $check_order_process="SELECT * FROM orders where orderID=$order_id";
                        $result_check=$conn->query($check_order_process) or die($conn->error);
                        $order_is_processed_or_not=$result_check->fetch_assoc();
                        $is_order_processed=$order_is_processed_or_not['order_status'];
                        if($is_order_processed=="1"){
                            echo "<h2>Order Already processed!!!</h2>";
                            return;
                        }else{
                            $order_process_query = "UPDATE orders SET order_status=1 where orderID=$order_id";
                            $conn->query($order_process_query);
                            $conn->commit();
                        }
                        //echo "inside order process";
                        
                        
                        $order_type_query = "SELECT * from orders";
                        $order_type=$conn->query($order_type_query);
                        while ($row=$order_type->fetch_assoc()){
                            if($row['orderID']==$order_id ){    
                                if($row['order_type']=="Buy"){
                                    //delete a book from the books table or decrement the quantity of the book
                                   // echo "INside the order buy<br>";
                                    $book_name=$row['book_name'];
                                    $select_book_info="SELECT * from books where book_name='$book_name';";
                                    $book_res=$conn->query($select_book_info);
                                    $book_info=$book_res->fetch_assoc();
                                    //echo $book_info['book_name'];
                                    $quantity_in_books=$book_info['book_qty'];
                                    $quantity_in_orders=$row['quantity'];
                                    $remaining_books=(int)($quantity_in_books-$quantity_in_orders );
                            
                                    if($remaining_books == 0){
                                        
                                        //delete the book
                                        //echo "Deleted book;";
                                        delete_book($conn,$book_id);
                                    }
                                    else{
                                        //decrement the book quantity
                                       // echo "decremented the book quantity<br>";
                                        $update_quant_query="UPDATE books SET book_qty=$remaining_books WHERE book_name='$book_name'";
                                        $conn->query($update_quant_query);
                                        $conn->commit();
                                        
                                    }
                                }
                        
                                elseif($row['order_type']=="Sell"){
                                    //add the book to the books table as it will be a selling order
                                    //echo "Inside add the book to the books table";
                                    $book_name=$row['book_name'];
                                    $quantity=$row['quantity'];
                                    $priceof1=$row['priceof1'];
                                    add_book($conn,$book_name,$quantity,$priceof1);
                                    
                                }
                            }
                        }
                        echo "Note:Order processed...Please refresh!";
                        return true;
                    }
                    else{
                        echo "<h3>Please enter data...</h3>";
                        return;
                    }       
            }        
        ?>

</body>
</html>