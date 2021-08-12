<?php
include('../config/constants.php');
if (isset($_GET['id']) && isset($_GET['image_name'])) {

    //get id and image name
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    //remove the image if available
    if($image_name!=""){
        $path="../images/food/".$image_name;
        $remove=unlink($path);

        if($remove==false){
            $_SESSION['upload'] ="<div class='error'>Failed to remove Image File</div>";
            header('location:' . SITEURL . 'admin/manage-food.php');
            die();
        }
    }
    //delete food from  database
    $sql="DELETE FROM tbl_food WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    //redirect to manage food with session
    if($res==true){
        $_SESSION['delete'] ="<div class='success'>Food Deleted Successfully</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
    else{
        $_SESSION['delete'] ="<div class='error'>Failed to delete food</div>";
        header('location:' . SITEURL . 'admin/manage-food.php');
    }
} 
else {
    $_SESSION['unauthorize'] = "<div class='error'>Unauthorized access</div>";
    header('location:' . SITEURL . 'admin/manage-food.php');
}
?>