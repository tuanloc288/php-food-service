<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>
        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="user" value="<?php echo $user; ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php

//CHeck whether the Submit Button is Clicked on Not
if (isset($_POST['submit'])) {
    //echo "CLicked";
    $username = $_GET['user'];
    //1. Get the DAta from Form
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);


    //2. Check whether the user with current ID and Current Password Exists or Not
    $sql = "SELECT * FROM tbl_account WHERE username='$username'";

    //Execute the Query
    $res = mysqli_query($conn, $sql);
    $count1 = mysqli_num_rows($res);

    if ($count1 > 0) {
        //CHeck whether data is available or not
        $sql1 = "SELECT * FROM tbl_account WHERE password= '$current_password'";
        $res1 = mysqli_query($conn, $sql1);

        $count = mysqli_num_rows($res1);

        if ($count == 1) {
            //User Exists and Password Can be CHanged
            //echo "User FOund";

            //Check whether the new password and confirm match or not
            if ($new_password == $confirm_password) {
                //Update the Password
                $sql2 = "UPDATE tbl_account SET 
                                password='$new_password' 
                                WHERE username= '$username'
                            ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether the query exeuted or not
                if ($res2 == true) {
                    //Display Succes Message
                    //REdirect to Manage Admin Page with Success Message
                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                    //Redirect the User
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                } else {
                    //Display Error Message
                    //REdirect to Manage Admin Page with Error Message
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password. </div>";
                    //Redirect the User
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
            } else {
                //REdirect to Manage Admin Page with Error Message
                $_SESSION['pwd-not-match'] = "<div class='error'>Password did not match. </div>";
                //Redirect the User
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            //User Does not Exist Set Message and REdirect
            $_SESSION['user-not-found'] = "<div class='error'>Current password is wrong. </div>";
            //Redirect the User
            header('location:' . SITEURL . 'admin/manage-admin.php');
        }
    } 
    else {
        //User Does not Exist Set Message and REdirect
        $_SESSION['user-not-found'] = "<div class='error'>User not found. </div>";
        //Redirect the User
        header('location:' . SITEURL . 'admin/manage-admin.php');
    }

    //3. CHeck Whether the New Password and Confirm Password Match or not

    //4. Change PAssword if all above is true
}


?>


<?php include('partials/footer.php'); ?>