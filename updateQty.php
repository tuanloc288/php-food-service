<?php
    include('config/constants.php');

    if(isset($_POST['update'])){
        $sql = "UPDATE tbl_cart_info SET
            qty = '$_POST[qty]'
            WHERE productID = $_GET[id]
        ";

        $res = mysqli_query($conn,$sql);
        if($res == true){
            echo "<script> alert('Update successful!!') </script>";
            header('location:'.SITEURL.'cart.php');
        }
    }
?>