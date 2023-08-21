<?php include('partials/menu.php');


?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <br /><br /><br />

        <?php
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>
        <br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Order ID</th>
                <th>Cart ID</th>
                <th>Total</th>
                <th>Order date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>

            <?php
            //Get all the orders from database
            $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; // DIsplay the Latest Order at First
            //Execute Query
            $res = mysqli_query($conn, $sql);
            //Count the Rows
            $count = mysqli_num_rows($res);

            $sn = 1; //Create a Serial Number and set its initail value as 1

            if ($count > 0) {
                //Order Available
                while ($row = mysqli_fetch_assoc($res)) {
                    //Get all the order details
                    $orderID = $row['id'];
                    $cartID = $row['cartID'];
                    $total = $row['total'];
                    $order_date = $row['order_date'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];

            ?>

                    <tr>
                        <td><?php echo $sn++; ?> </td>
                        <td><?php echo $orderID ?></td>
                        <td><?php echo $cartID; ?></td>
                        <td><?php echo $total; ?>đ</td>
                        <td><?php echo $order_date; ?></td>

                        <td>
                            <?php
                            // Ordered, On Delivery, Delivered, Cancelled

                            if ($status == "Ordered") {
                                echo "<label>$status</label>";
                            } elseif ($status == "On Delivery") {
                                echo "<label style='color: orange;'>$status</label>";
                            } elseif ($status == "Delivered") {
                                echo "<label style='color: green;'>$status</label>";
                            } elseif ($status == "Cancelled") {
                                echo "<label style='color: red;'>$status</label>";
                            }
                            ?>
                        </td>

                        <td><?php echo $customer_name; ?></td>
                        <td><?php echo $customer_contact; ?></td>
                        <td><?php echo $customer_email; ?></td>
                        <td><?php echo $customer_address; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $orderID; ?>" class="btn-secondary">Update Order</a>
                            <a href="#sn<?php echo $sn - 1 ?>" class="btn-danger"> View cart </a>
                        </td>
                    </tr>

            <?php

                }
            } else {
                //NO ORDER
                echo "<tr><td colspan='12' class='error'>These is no order</td></tr>";
            }
            ?>


        </table>
    </div>
    <?php

        $sql1 = "SELECT * FROM tbl_order ORDER BY id DESC"; // DIsplay the Latest Order at First
        //Execute Query
        $res1 = mysqli_query($conn, $sql1);
        //Count the Rows
        $count1 = mysqli_num_rows($res1);

        $sn1 = 1; //Create a Serial Number and set its initail value as 1

        if ($count1 > 0) {
            //Order Available
            while ($row1 = mysqli_fetch_assoc($res1)) {
                //Get all the order details
                $orderID1 = $row1['id'];
                viewCartDetail($orderID1, $sn1++);
            }
        }

    ?>
</div>



<!-- <div class="bg-modal">
    <fieldset class="modal-content">
            <legend>Food detail</legend>
            <div class="close">

                +

            </div>

            <div class="food-menu-box">

                <div class='food-menu-img'>
                    <img src="../images/food/Food-Name-1067.jpg" class='img-responsive img-curve'>
                </div>

                <div class='food-menu-desc'>
                    <h4 class="food-title"> Test title </h4>
                    <p class='food-detail'>
                        Test detail
                    </p>
                    <p class='food-price'> Test price đ</p>
                    <p class="qty"> 2 </p>
                </div>

            </div>

            <div class="food-menu-box">

                <div class='food-menu-img'>
                    <img src="../images/food/Food-Name-109.jpg" class='img-responsive img-curve'>
                </div>

                <div class='food-menu-desc'>
                    <h4 class="food-title"> Test title 2 </h4>
                    <p class='food-detail'>
                        Test detail 2
                    </p>
                    <p class='food-price'> Test price 2đ</p>
                    <p class="qty"> 2.2 </p>
                </div>

            </div>

    </fieldset>
</div> -->

<?php include('partials/footer.php'); ?>