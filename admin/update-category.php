<?php
include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_category WHERE id=$id";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                //get all data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
            } else {
                //redirect to manage-category with session msg
                $_SESSION['no-category-found'] = "<div class='error'>Category Not Found.</div>";
                header('lcation:' . SITEURL . 'admin/manage-category.php');
            }
        } else {
            header('location:' . SITEURL . 'admin/manage-category.php');
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td><input type="text" name="title" value="<?php echo $title ?>"></td>

                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                        if ($current_image != "") {
                            //display the image
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                        <?php
                        } else {
                            echo "<div class='error'>Image Not Added.</div>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if ($featured == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if ($featured == "No") {
                                    echo "checked";
                                } ?> type="radio" name="featured" value="No">No
                    </td>

                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if ($active == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="Yes">Yes
                        <input <?php if ($active == "No") {
                                    echo "checked";
                                } ?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>

                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //update the new image if selected
            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                if ($image_name != "") {
                    //upload new image and remove the current
                    //auto rename our image
                    //get the extension of our image(jpg,png,gif,etc) eg."food1.jpg"
                    $ext = end(explode('.', $image_name)); //breaking image name
                    $image_name = "Food_Category_" . rand(000, 999) . '.' . $ext;
                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/" . $image_name;   //e.g. Food_Category_678.jpg

                    //finally upload the image
                    $upload = move_uploaded_file($source_path, $destination_path);
                    //check whether the image is uploaded or not
                    //and if image is not upladed then will stop the process and redirect error msg
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload image.</div>";
                        header('location:' . SITEURL . 'admin/manage-category.php');
                        //stop the process
                        die();
                    }

                    //remove the current image if available

                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;
                        $remove = unlink($remove_path);

                        //check whether the image is removed or not if failed to remove display msg and stop the process
                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image</div>";
                            header('location:' . SITEURL . 'admin/manage-category.php');
                            die();
                        }
                    }
                    
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }


            //Update the database
            $sql2 = "UPDATE tbl_category SET
            title='$title',
            image_name='$image_name',
            featured='$featured',
            active='$active'
            WHERE id=$id
            

            ";
            $res2 = mysqli_query($conn, $sql2);
            //redirect to manage category with message
            if ($res2 == true) {
                $_SESSION['update'] = "<div class='success'>Category updated successfully.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to update category.</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        }

        ?>
    </div>
</div>



<?php
include('partials/footer.php');
?>