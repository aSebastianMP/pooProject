<?php include("includes/init.php"); ?>
<?php

    if(!$session->isSignedIn()){
        redirect("login.php");
    }
?>

<?php
    if(empty($_GET['photoId'])){
        redirect("photos.php");
    }

    $photo = Photo::findById($_GET['$photoId']);

    if($photo){
        $photo->delete_photo();
    } else{
        redirect("photos.php");
    }
?>