<?php include('partials-front/menu.php'); ?>
<!-- Navbar Section Ends Here -->



<!-- CAtegories Section Starts Here -->
<section class="categories">
    <div class="container">
        <h2 class="text-center">Explore Foods</h2>
        <?php
        //display all categories that are active
        $sql = "SELECT *FROM tbl_category WHERE active='Yes'";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);
        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];

        ?>
                <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id;?>">
                    <div class="box-3 float-container">
                        <?php
                        if($image_name==""){
                            //image not available
                            echo "<div class = 'error'>Image Not Found</div>";

                        }
                        else{
                            ?>
                          <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive ed img-curve">
                            <?php
                        }
                        ?>
                        

                        <h3 class="float-text text-white"><?php echo $title; ?></h3>
                    </div>
                </a>
        <?php
            }
        } else {
            echo "<div class'error'>Category Not Found</div>";
        }

        ?>





        <div class="clearfix"></div>
    </div>
</section>
<!-- Categories Section Ends Here -->


<!-- social Section Starts Here -->

<?php include('partials-front/footer.php'); ?>