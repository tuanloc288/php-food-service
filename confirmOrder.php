<?php
    include('config/constants.php');

    if (isset($_POST['confirmOrder'])) {
        if (!isset($_SESSION['cart'])) {
            echo '<script> alert("Empty cart!!") </script>';
        } else {
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $order_date = date("Y-m-d h:i:sa");
            $customer_name = $_POST['full-name'];
            $customer_contact = $_POST['contact'];
            $customer_email = $_POST['email'];
            $customer_address = $_POST['address'];
            $sql3 = " INSERT INTO tbl_order SET
                id = '$_SESSION[orderID]',
                cartID = '$_SESSION[cartID]',
                total = NULL,
                order_date = '$order_date',
                status = 'Ordered',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'
            ";
            $res3 = mysqli_query($conn,$sql3);

            $sql = "SELECT * FROM tbl_cart WHERE userName= '$_SESSION[user]'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $sql1 = "SELECT * FROM tbl_cart_info WHERE cartID = '$row[cartID]'";
                    $res1 = mysqli_query($conn,$sql1);

                    $count1 = mysqli_num_rows($res1);
                    if($count1 > 0){
                        while($row1 = mysqli_fetch_assoc($res1)){
                            $qty = $row1['qty'];
                            $sql2 = "SELECT * FROM tbl_food WHERE id = '$row1[productID]'";
                            $res2 = mysqli_query($conn,$sql2);

                            $count2 = mysqli_num_rows($res2);
                            if($count2 > 0){
                                while($row2 = mysqli_fetch_assoc($res2)){
                                    $sql5 = "SELECT * FROM tbl_order WHERE cartID = '$_SESSION[cartID]'";
                                    $res5 = mysqli_query($conn,$sql5);

                                    $count3 = mysqli_num_rows($res5);
                                    if($count3 > 0){
                                        while($row3 = mysqli_fetch_assoc($res5)){
                                            $total = $qty * $row2['price'];
                                            $sql6 = "INSERT INTO tbl_order_info SET 
                                                orderID = '$_SESSION[orderID]',
                                                cartID = '$row3[cartID]',
                                                productID = '$row2[id]',
                                                title = '$row2[title]',
                                                qty = '$qty',
                                                price = '$row2[price]', 
                                                total = '$total'
                                            ";
                                            $res6 = mysqli_query($conn,$sql6);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $sql6 = "SELECT SUM(total) AS totalCost FROM tbl_order_info WHERE orderID = '$_SESSION[orderID]'" ;
            $res6 = mysqli_query($conn,$sql6);

            if($res6 == true){
                while($row6 = mysqli_fetch_assoc($res6)){
                    $totalCost = (int)$row6['totalCost'];
                    $sql7 = "UPDATE tbl_order SET total = '$totalCost' WHERE id = '$_SESSION[orderID]'";
                    $res7 = mysqli_query($conn,$sql7);
                    if($res7 == true){
                        echo '<script> alert("Order confirmed !!")
                            window.location = "index.php";
                        </script>';
                        $sql4 = "DELETE FROM tbl_cart WHERE userName = '$_SESSION[user]'";
                        $res4 = mysqli_query($conn, $sql4);
                        unset($_SESSION['cart']);
                    }
                    else {
                        echo '<script> alert("Order failed !!")</script>';
                    }
                }
            }
        }
    }
