<?php 
            include('../config/constants.php');

            $q = $_REQUEST["search"];
            $str = "<tr>
                        <th>S.N.</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    ";
                $sql1 = "SELECT id from tbl_category WHERE title LIKE '$q'";
                $res1 = mysqli_query($conn, $sql1);
                $count1 = mysqli_num_rows($res1);
                $sql2 = "";

                if ($count1 > 0) {
                    $row1 = mysqli_fetch_assoc($res1);
                    $sql2 = "SELECT * FROM tbl_food WHERE category_id = '" . $row1['id'] . "' or description LIKE '$q' or title LIKE '$q'";
                } else $sql2 = "SELECT * FROM tbl_food WHERE description LIKE '$q' or title LIKE '$q'";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Count Rows
                $count2 = mysqli_num_rows($res2);
                $sn1 = 1;

                //Check whether food available of not
                if ($count2 > 0) {
                    while ($row1 = mysqli_fetch_assoc($res2)) {
                        //get the values from individual columns
                        $id1 = $row1['id'];
                        $title1 = $row1['title'];
                        $price1 = $row1['price'];
                        $image_name1 = $row1['image_name'];
                        $featured1 = $row1['featured'];
                        $active1 = $row1['active'];

                        $str = $str . "
                                            <tr>
                                            <td>$sn1. </td>
                                            <td>$title1</td>
                                            <td>$price1 đ </td>
                                            <td>
                                                    <img src='" . SITEURL . "images/food/$image_name1' width='100px'>
                                            </td>
                                            <td>$featured1</td>
                                            <td>$active1</td>
                                            <td>
                                                <a href='" . SITEURL . "admin/update-food.php?id=$id1' class='btn-secondary'> Update Food</a>
                                                <a href='" . SITEURL . "admin/delete-food.php?id=$id1&image_name=$image_name1' class='btn-danger'>Delete Food</a>
                                            </td>
                                        </tr>
                                    ";

                        $sn1++;
                    }
                }
                echo $str;
    ?>
