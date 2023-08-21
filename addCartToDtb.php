<?php
include('config/constants.php');

if (isset($_POST['add'])) {

    if (!isset($_SESSION['user'])) {
        echo '<script> alert("Please login to use cart");
            window.location = "index.php" ;
        </script>';
    } else {
        // Insert into cart
        if (isset($_SESSION['cart'])) {
            $item_array_id = array_column($_SESSION['cart'], "product_id");

            if (in_array($_POST['product_id'], $item_array_id)) {
                echo '<script> alert("Product already been added to the cart"); </script>';
                echo '<script> window.location= "index.php"; </script>';
            } else {
                // INSERT INTO DTB
                $sql1 = "SELECT * FROM tbl_cart WHERE userName= '$_SESSION[user]'";
                $res1 = mysqli_query($conn, $sql1);
                $count1 = mysqli_num_rows($res1);
                $cartID;
                if ($count1 > 0) {
                    while ($row = mysqli_fetch_assoc($res1)) {
                        $cartID = $row['cartID'];
                    }
                }
                $sql = "INSERT INTO tbl_cart_info SET
                    cartID = '$cartID',
                    productID = '$_POST[product_id]',
                    qty = 1
                ";
                $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                $count = count($_SESSION['cart']);
                $item_array = array(
                    'product_id' => $_POST['product_id']
                );

                $_SESSION['cart'][$count] = $item_array;
                echo '<script> alert("Add to cart successful")
                            window.location = "index.php";
                    </script>';
            }
        } else {
            $_SESSION['cartID'] = rand(1, 500);
            $_SESSION['orderID'] = rand(1, 500);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );
            $_SESSION['cart'][0] = $item_array;
            echo '<script> alert("Add to cart successful")
                            window.location = "index.php";
                    </script>';
            // INSERT INTO DTB
            $sql1 = "INSERT INTO tbl_cart SET
                cartID = '$_SESSION[cartID]',
                userName = '$_SESSION[user]'
            ";
            $res1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));

            $sql2 = "INSERT INTO tbl_cart_info SET
                 cartID = '$_SESSION[cartID]',
                productID = '$_POST[product_id]',
                qty = 1
            ";

            $res2 = mysqli_query($conn,$sql2) or die(mysqli_error($conn));
        }
    }
}
