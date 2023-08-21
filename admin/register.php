<?php include('../config/constants.php'); ?>

<html>

<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body style="background-image: url(../images/menu-burger.jpg);background-size: cover;">

    <!-- Register form start here -->
    <form action="" method="POST" class="login" style="display:block; position:absolute">
        <h1> Register </h1>
        <input type="text" name="username" placeholder="Enter Username" required>
        <input type="password" name="password" placeholder="Enter Password" required>
        <input type="submit" name="registerSubmit" value="Register" class="register">
        <p style="color:white"> Already have an account? <a href="../index.php" style="color: goldenrod;"> Login </a></p>
    </form>
    </form>
    <!-- Register Form Ends HEre -->
</body>

</html>

<?php

//CHeck whether the Submit Button is Clicked or NOt
if (isset($_POST['registerSubmit'])) {
    //Process for Login
    //1. Get the Data from Register form
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    //2. SQL to check whether the username exists or not
    $sql = "SELECT * from tbl_account WHERE username = '$username'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $_SESSION['register'] = "";
    } else { 
        // 3. Username not existed so we an create
        $sql1 = "INSERT INTO tbl_account SET 
            accountType='Customer',
            username = '$username',
            password = '$password'
        ";

        $res1 = mysqli_query($conn, $sql1);
        
        header('location:'.SITEURL.'index.php');
        echo '<script> alert("Registration successful")</script>';
    }
}


?>

<?php 
            if(isset($_SESSION['register'])){
                echo "<script> alert('Username already exists');
                    window.location.href = 'register.php';
                    </script>";
                unset($_SESSION['register']);
            }
        ?>