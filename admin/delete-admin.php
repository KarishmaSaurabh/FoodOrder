<?php

include ('../config/constants.php');

//get the id of admin to be deleted
    $id=$_GET['id'];
    $sql="DELETE FROM tbl_admin WHERE id=$id";
    $res=mysqli_query($conn,$sql);
    if($res==TRUE){
        //create session variable to display message
       $_SESSION['delete']="<div class='success'> Admin Deleted Successfully</div>";
       //redirect to mange-admin page
       header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
       //create session variable to display message
       $_SESSION['delete']="<div class='error'>Failed to Delete Admin. Try Again</div>";
       //redirect to mange-admin page
       header('location:'.SITEURL.'admin/manage-admin.php');
    }

?>