
    <?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php 

                //Get the Search Keyword
                $search = $_POST['search'];
            
            ?>


            <h2>Foods on your search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 

                //SQL Query to Get foods based on search keyword
                $sql1 = "SELECT id from tbl_category WHERE title LIKE '%$search%'";
                $res1 = mysqli_query($conn, $sql1);
                $count1 = mysqli_num_rows($res1);
                $sql;

                if($count1 > 0){
                    $row1=mysqli_fetch_assoc($res1);
                    $sql = "SELECT * FROM tbl_food WHERE category_id = '" . $row1['id'] . "' or description LIKE '%$search%' or title LIKE '%$search%'"  ;
                }
                else $sql = "SELECT * FROM tbl_food WHERE description LIKE '%$search%' or title LIKE '%$search%'"  ;

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check whether food available of not
                if ($count > 0) {
                    //Food Available
                    while ($row = mysqli_fetch_assoc($res)) {
                        //Get all the values
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        component($id, $image_name, $title, $price, $description);
                    }
                ?>
    
                <?php
                } else {
                    //Food Not Available 
                    echo "<div class='error'>Food not available.</div>";
                }
                ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>