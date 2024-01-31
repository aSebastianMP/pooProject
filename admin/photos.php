<?php include("includes/header.php"); ?>

<?php 
    $photos = Photo::findAll();
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
                        PHOTOS
                        <small>Subheading</small>
                    </h1>

                    <div class="col-md-12">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>File name</th>
                                    <th>Type</th>
                                    <th>Size</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach ($photos as $photo) : 
                            ?>
                                <tr>
                                    <td><img src="<?php echo $photo->picturePath(); ?>" alt="http:/placehold.it">
                                    <div class="picture_link">
                                        <a href="delete_photo.php?id=<?php echo $photo->id ?>">Delete</a>
                                        <a href="edit_photo.php?id=<?php echo $photo->id ?>">Edit</a>
                                        <a href="">View</a>
                                    </div>
                                    <td><?php echo $photo->id; ?></td>
                                    <td><?php echo $photo->title; ?></td>
                                    <td><?php echo $photo->fileName; ?></td>
                                    <td><?php echo $photo->type; ?></td>
                                    <td><?php echo $photo->size; ?></td>
                                </tr>
                            <?php endforeach; 
                            ?> 
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <!-- /.row -->

</div>
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>