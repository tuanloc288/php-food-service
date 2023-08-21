<?php
//Start Session
session_start();




//Create Constants to Store Non Repeating Values
define('SITEURL', 'http://localhost/DoAnWeb2/'); //Update the home URL of the project if you have changed port number or it's live on server
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'doanweb2');

$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn)); //Database Connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); //SElecting Database 

if (isset($_SESSION['user'])) {
    $sql = "SELECT * FROM tbl_cart WHERE userName= '$_SESSION[user]'";
    $index = 0;
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $sql1 = "SELECT * From tbl_cart_info WHERE cartID = '$row[cartID]' ";
            $res1 = mysqli_query($conn, $sql1);

            $count1 = mysqli_num_rows($res1);

            if ($count1 > 0) {
                while ($row1 = mysqli_fetch_assoc($res1)) {
                    $item_array = array(
                        'product_id' => $row1['productID']
                    );

                    $_SESSION['cart'][$index++] = $item_array;
                }
            }
        }
    }
}

function component($id, $productImage, $productTitle, $productPrice, $productDetail)
{
    $element = "
            <form action='addCartToDtb.php' method='POST' style='display: inline;'>
                <div class='food-menu-box' style='margin: 1%'>
                    <div class= 'food-menu-img'>
                        <img src='" . SITEURL . "images/food/$productImage' class='img-responsive img-curve'>
                    </div>

                    <div class='food-menu-desc'>
                        <h4> $productTitle </h4>
                        <p class='food-price'> $productPrice đ</p>
                        <p class='food-detail'>
                                $productDetail
                        </p>
                        <br>
                        <div>
                            <a href='" . SITEURL . "order.php?food_id=$id' class='btn btn-primary' >Order Now</a>
                            
                                <input type='hidden' name='product_id' value='$id'>
                                <button type='submit' name='add' class='btn btn-secondary'> Add to cart
                                        <i> <img src='images/shopping-cart.png' style='height:17px;width:17px'> </i></button>
                            
                        </div>
                    </div>
                </div>
            </form>
        ";
    echo $element;
}

function cartComponent($productID, $productImage, $productTitle, $productPrice, $productDetail, $qty)
{
    $element = "
        <form action='updateQty.php?id=$productID' method='POST'>
            <div class='food-menu-box' style='width:44% !important'>
                <div class= 'food-menu-img'>
                    <img src='" . SITEURL . "images/food/$productImage' class='img-responsive img-curve'>
                </div>

                <div class='food-menu-desc'>
                    <h4> $productTitle </h4>
                    <p class='food-price'> $productPrice đ</p>
                    <p class='food-detail'>
                            $productDetail
                    </p>
                    <br>
                    <div>
                        <input type='number' name='qty' value ='$qty' style='margin:1%'>
                        <button type='submit' name='update' class='btn btn-secondary' style='margin:1%;'> Update quantity </button>
                        </form>
                        <form action='cart.php?action=remove&id=$productID' method='POST'>
                            <button class='btn btn-primary' type='submit' name='remove'> Remove </button>
                        </form>
                    </div>
                </div>
                
            </div>
        ";
    echo $element;
}

function viewCartDetail($id, $sn)
{
    $s = "
            <div id='sn$sn' class='modal'>
                <fieldset class='modal-content'>
                    <legend>Food detail</legend>
                    <a href='#' class='close'> + </a>
        ";

    $sql = "SELECT * FROM tbl_order_info WHERE orderID = '$id'";
    global $conn;
    $rs = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($rs);
    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($rs)) {
            $qty = $row['qty'];
            $sql2 = "SELECT * FROM tbl_food WHERE id = '$row[productID]'";
            $rs2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($rs2);
            if ($count2 > 0) {
                while ($row2 = mysqli_fetch_assoc($rs2)) {
                    $s = $s . "
                        <div class='food-menu-box'>
            
                            <div class='food-menu-img'>
                                <img src='" . SITEURL . "images/food/$row2[image_name]' class='img-responsive img-curve'>
                            </div>
            
                            <div class='food-menu-desc'>
                                <h4 class='food-title'> $row2[title] </h4>
                                <p class='food-detail'>
                                    $row2[description]
                                </p>
                                <p class='food-price'> $row2[price] đ</p>
                                <p class='qty'> $qty </p>
                            </div>
        
                        </div>
                    ";
                }
            }
        }
    }
    $s = $s . "
            </fieldset>
        </div>
    ";
    echo $s;
}

function test()
{
    global $conn;
    $str = "";
    $str = $str . "<tr><th>S.N.</th><th>Title</th><th>Price</th><th>Image</th><th>Featured</th><th>Active</th><th>Actions</th></tr>";
    $sql = "SELECT * FROM tbl_food";
    $rs = mysqli_query($conn, $sql);

    $c = mysqli_num_rows($rs);
    $sn = 1;
    if ($c > 0) {
        while ($row = mysqli_fetch_assoc($rs)) {
            $id = $row['id'];
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];

            $str = $str . "<tr><td>$sn. </td><td>$title</td><td>$price đ </td><td><img src='" . SITEURL . "images/food/$image_name' width='100px'></td><td>$featured</td><td>$active</td><td><a href='" . SITEURL . "admin/update-food.php?id=$id' class='btn-secondary'> Update Food</a><a href='" . SITEURL . "admin/delete-food.php?id=$id&image_name=$image_name' class='btn-danger'>Delete Food</a></td></tr>";
            $sn++;
        }
    }
    echo $str;
}
