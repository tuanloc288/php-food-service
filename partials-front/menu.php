<?php include('config/constants.php'); 
    
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>
    <script type="text/javascript" src="DoAn.js"></script>
    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style.css">
    <script src="https://kit.fontawesome.com/7b231e7deb.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="index.php" title="Logo">
                    <img src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITEURL; ?>index.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITEURL; ?>foods.php">Foods</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                    <?php 
                        if(isset($_SESSION['user'])){
                            if(isset($_SESSION['cartID'])){
                                echo "
                                <li>
                                    <a href='".SITEURL."cart.php?cart_id=$_SESSION[cartID]'><img src='images/shopping-cart.png' style='height:25px;width:25px'></a>
                                ";
                            }
                            else {
                                echo "
                                <li>
                                    <a href='".SITEURL."cart.php'><img src='images/shopping-cart.png' style='height:25px;width:25px'></a>
                            ";
                            }
                            if(isset($_SESSION['cart'])){
                                $count = count($_SESSION['cart']);
                                foreach($_SESSION['cart'] as $key => $value){
                                    echo "<script> console.log('$value[product_id] , ') </script>";
                                }
                                echo "
                                        <span> $count </span>
                                    </li>
                                ";
                            }
                            else{ 
                                echo "
                                        <span> 0 </span>
                                    </li>
                                ";
                            }
                            echo "
                                <li><a href='admin/logout.php'> Logout </a></li>
                            ";
                        }
                        else echo " <li onclick='dangnhap()'> <a style='cursor:pointer'> Login </a></li>";
                    ?>
                </ul>
                <form action="admin/login.php"  method="POST" class="login">
                    <h1> Login </h1>
                    <input type="text" name="username" placeholder="Enter Username" required>
                    <input type="password" name="password" placeholder="Enter Password" required>
                    <input type="button" name="" value="Close" onclick="dong()">
                    <input type="submit" name="submit" value="Login">
                    <p style="color:white"> Don't have an account? <a href="admin/register.php" style="color: goldenrod;"> Register here </a></p>
                </form>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->