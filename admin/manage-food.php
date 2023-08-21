<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br /><br />

        <!-- Button to Add Admin -->
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <form action="" style="display: inline;">
            <input name="search" placeholder="Search for Food.." style="border:0;background: none;outline: none;
                    margin-left: 1%; color:white; background-color: rgba(0,0,0,0.8); height: 5%; padding: 1%" onkeyup="showFood(this.value)">
        </form>
        <br /><br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['unauthorize'])) {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        ?>
        <table class="tbl-full" id="food">

            <script>
                function showFood(str) {
                    var xhttp;
                    if (str.length == 0) {
                        document.getElementById("food").innerHTML = "<?php test() ?>";
                    } else {
                        xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                document.getElementById("food").innerHTML = this.responseText;
                            }
                        };
                        xhttp.open("GET", "foodSearch.php?search=" + str, true);
                        xhttp.send();
                    }
                }
            </script>

        </table>
    </div>

</div>

<?php include('partials/footer.php'); ?>