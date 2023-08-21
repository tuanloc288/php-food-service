<?php include('partials-front/menu.php');
?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
            <input type="search" name="search" placeholder="Search for Food.." required>
            <input type="submit" name="submit" value="Search" class="btn btn-primary">
        </form>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        //Display Foods that are Active
        $sql = "SELECT * FROM tbl_food WHERE active='Yes'";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Count Rows
        $count = mysqli_num_rows($res);

        $items_per_page = 6;
        $totalpages = ceil($count / $items_per_page);
        if (isset($_GET['page']) && !empty($_GET['page'])) {
            $page = $_GET['page'];
        } else {
            $page = 1;
        }
        $offset = ($page - 1) * $items_per_page;
        $query = "SELECT * FROM tbl_food LIMIT $items_per_page OFFSET $offset";
        $result = mysqli_query($conn, $query);
        $row_count = mysqli_num_rows($result);
        //CHeck whether the foods are availalable or not
        //Foods Available
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $title = $row['title'];
            $description = $row['description'];
            $price = $row['price'];
            $image_name = $row['image_name'];
            component($id, $image_name, $title, $price, $description);
        }?>
        <div class="clearfix"></div>
        <div class="text-center" style="margin-top: 5% !important;">
        <?php
        for ($i = 1; $i <= $totalpages; $i++) {
            if ($i == $page) {
                echo '<a class="active">' . $i . '</a>';
            } else { ?>
                <a href="<?php echo SITEURL; ?>foods.php?page= <?php echo $i; ?>"><?php echo $i; ?></a>
        <?php
            }
        }
        ?>
        </div>
    </div>

</section>
<!-- fOOD Menu Section Ends Here -->

<?php include('partials-front/footer.php'); ?>