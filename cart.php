<?php
include('partials-front/menu.php');


?>
<div class="cart">

    <div class="yourCart">
        <?php
        $sql = "SELECT * FROM tbl_cart WHERE userName= '$_SESSION[user]'";
        $total = 0;
        $numberofProduct = 0;
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $sql2 = "SELECT * FROM tbl_cart_info WHERE cartID= $row[cartID]";
                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);
                if ($count2 > 0) {
                    while ($row2 = mysqli_fetch_assoc($res2)) {
                        $sql3 = "SELECT * FROM tbl_food WHERE id = '$row2[productID]'";
                        $qty = (int)$row2['qty'];
                        if ($qty >= 3) {
                            $discount1 = 0.1;
                        } else $discount1 = 0;
                        $res3 = mysqli_query($conn, $sql3);
                        $count3 = mysqli_num_rows($res3);
                        if ($count3 > 0) {
                            while ($row3 = mysqli_fetch_assoc($res3)) {
                                cartComponent($row3['id'], $row3['image_name'], $row3['title'], $row3['price'], $row3['description'], $qty);
                                $numberofProduct = $numberofProduct + $qty;
                                $total =  (($qty * (int)$row3['price']) - ($qty * (int)$row3['price']) * $discount1) + $total;
                            }
                        }
                    }
                }
            }
        } else {
            echo "<p class='error text-center'> Giỏ hàng của bạn chưa có món ăn nào!! </p>";
        }
        if (isset($_POST['remove'])) {
            if ($_GET['action'] == 'remove') {
                foreach ($_SESSION['cart'] as $key => $value) {
                    $sql4 = "DELETE FROM tbl_cart_info WHERE productID = $_GET[id]";

                    $res3 = mysqli_query($conn, $sql4);

                    if ($value["product_id"] == $_GET['id']) {
                        unset($_SESSION['cart'][$key]);
                        echo "<script> alert('Product has been removed');
                                    window.location = 'http://localhost/DoAnWeb2/cart.php';
                                </script>";
                    }
                }
            }
        }

        ?>
    </div>

    <div class="information">
        <form action="confirmOrder.php" method="POST">
            <div class="customer-info">

                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Trinh Tuan Loc" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="number" name="contact" placeholder="E.g. 0123456789" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. orderfood@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, city, country" class="input-responsive" required></textarea>

                </fieldset>
            </div>

            <div class="cart-info">
                <fieldset>
                    <legend>Cart Details</legend>
                    <div class="order-label">Total foods:
                        <?php
                        echo $numberofProduct;
                        ?>
                    </div>
                    <?php
                        $sql3 = "SELECT * FROM tbl_cart WHERE userName= '$_SESSION[user]'";
                        $res3 = mysqli_query($conn, $sql3);
                        $count3 = mysqli_num_rows($res3);
                        if ($count3 > 0) {
                            while ($row3 = mysqli_fetch_assoc($res3)) {
                                $sql4 = "SELECT * FROM tbl_cart_info WHERE cartID= $row3[cartID]";
                                $res4 = mysqli_query($conn, $sql4);

                                $count4 = mysqli_num_rows($res4);
                                if($count4 > 0){    
                                    while($row4 = mysqli_fetch_assoc($res4)){
                                        $sql5 = "SELECT * FROM tbl_food WHERE id = '$row4[productID]'";
                                        $qty2 = (int)$row4['qty'];
                                        $res5 = mysqli_query($conn, $sql5);
                                        $count5 = mysqli_num_rows($res5);
                                        if ($count5 > 0) {
                                            while ($row5 = mysqli_fetch_assoc($res5)) {
                                                echo "<div class='order-label'> $row5[title]: $row4[qty]"; 
                                
                                                if ($qty2 >= 3) {
                                                    echo    "<p style='display:inline;color:#7bed9f'> 
                                                                Discount: 10% 
                                                            </p> </div>";
                                                } else echo "<p style='display:inline;color:#7bed9f'> 
                                                                Discount: 0% 
                                                            </p> </div>";
                                            }
                                        }
                                    }
                                }   
                            }
                        }
                    ?>
                            
                    <div class="order-label" style="border-top: 1px solid white;margin: 2% 0;padding-top:2%">Total price: <?php echo $total ?>đ </div>
                    <button type="submit" name="confirmOrder" value="Confirm Order" class="btn btn-primary">Confirm order</button>

                </fieldset>

            </div>
        </form>
    </div>
</div>


<?php include('partials-front/footer.php'); ?>