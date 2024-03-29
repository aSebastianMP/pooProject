<?php include("includes/header.php"); ?>
<?php

    if(!$session->isSignedIn()){
        redirect("login.php");
    }
?>

<?php
    $message = "";
    if(isset($_POST['submit'])){
        $photo = new Photo();
        $photo->title = $_POST['title'];
        $photo->setFile($_FILES['fileUpload']);

        if($photo->save()){
            $message = "Photo succesfully uploaded";
        }
    }
?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            
            <?php include("includes/top_nav.php")?>

            <?php include("includes/side_nav.php")?>
            
            
        </nav>
        <div id="page-wrapper">
        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        UPLOADS
                        <small>Subheading</small>
                    </h1>
                    <div class="col-md-6">
                    <?php echo $message; ?>
                    <form action="uploads.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="file" name="fileUpload">
                        </div>
                        <input type="submit" name="submit">
                    </form>
                    </div>

                    
                </div>
            </div>
            <!-- /.row -->

</div>
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>