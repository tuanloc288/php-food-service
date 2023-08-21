<?php include('partials-front/menu.php'); ?>

<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">CONTACT US</h2>
        <div class="card-body">
            <fieldset>
                <legend>Feedback</legend>
                <form action="" method="POST">
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="Hai Loc Dat" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="phone" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                    <div class="order-label">Opinion</div>
                    <textarea name="opinition" rows="10" placeholder="..." class="input-responsive" required></textarea>

                    <button type="submit" name="submit" value="Send" class="btn btn-primary">Send</button>
                </form>
            </fieldset>
            <?php
            if (isset($_POST['submit'])) {
                echo '<script> alert("Send opinion successful!!")</script>';
            }
            ?>
        </div>
</section>
<?php include('partials-front/footer.php'); ?>