<?php include('../config/constants.php'); ?>

<?php

//CHeck whether the Submit Button is Clicked or NOt
if (isset($_POST['submit'])) {
    //Process for Login
    //1. Get the Data from Login form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    //2. SQL to check whether the user with username and password exists or not
    $sql = "SELECT * FROM tbl_account WHERE username='$username' AND password = '$password'";

    //3. Execute the Query
    $res = mysqli_query($conn, $sql);

    //4. COunt rows to check whether the user exists or not
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        //User AVailable and Login Success
        $_SESSION['temp'] = "";
        while ($row = mysqli_fetch_assoc($res)) {
            if ($row['accountType'] == 'Administrator'){
                //REdirect to HOme Page/Dashboard
                $_SESSION['admin'] = "";
                header('location:' . SITEURL . 'admin/index.php');
            }
            else {
                header('location:'.SITEURL.'index.php');   
                $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it
            }
        }
    } else {
        //User not Available and Login FAil
        $_SESSION['login'] = "";
        header('location:' . SITEURL . 'index.php');
    }
}

?>