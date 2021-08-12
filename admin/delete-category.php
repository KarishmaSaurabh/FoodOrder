<?php

   include('../config/constants.php');

  //check whether id and image_name value is set or not
  if(isset($_GET['id']) AND isset($_GET['image_name'])){
      //get the value  and delete
      $id=$_GET['id'];
      $image_name=$_GET['image_name'];

      //remove the physical image file if available
        if($image_name!=""){
          $path="../images/category/".$image_name;
          //remove the image
          $remove=unlink($path);
          
          if($remove==false){
              $_SESSION['remove']="<div class='error'>Failed to remove image</div>";
              header('location:'.SITEURL.'admin/manage-category.php');
              die();
          } 
        }
      //delete data from database
      //redirect to manage-category page with message
     $sql="DELETE FROM tbl_category WHERE id=$id";
     $res=mysqli_query($conn,$sql);
     if($res==true){
      $_SESSION['delete']="<div class='success'>Category Deleted Successfully</div>";
      header('location:'.SITEURL.'admin/manage-category.php');
     }
     else{
      $_SESSION['delete']="<div class='error'>Failed to Delete Category</div>";
      header('location:'.SITEURL.'admin/manage-category.php');
     }

      
  }
  else{
    //   redirect to manage-category page
    header('location:'.SITEURL.'admin/manage-category.php');
  }
?>