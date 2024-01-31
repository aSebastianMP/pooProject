<?php include("includes/header.php"); ?>

<?php 
    // $photo = new Photo;
?>

<?php 

    if(empty($_GET['id'])){
        redirect("photos.php");
    } else {
        $photo = Photo::findById($_GET['id']);

        if(isset($_POST['update'])){
            if($photo){
                $photo->title = $_POST['title'];
                $photo->alternateText = $_POST['alternateText'];
                $photo->photoDescription = $_POST['photoDescription'];
                $photo->save();
            }
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
                        PHOTOS
                        <small>Subheading</small>
                    </h1>

                    <form action="" method="post">

                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="caption">Caption</label>
                            <input type="text" name="title" class="form-control" value="<?php echo $photo->title; ?>">
                        </div>
                        <div class="form-group">
                            <label for="caption">Alternate text</label>
                            <input type="text" name="alternateText" class="form-control" value="<?php echo $photo->alternateText; ?>" >
                        </div>
                        <div class="form-group">
                            <label for="caption">Description</label>
                            <textarea class="form-control"name="photoDescription" id="" cols="30" rows="10"><?php echo $photo->photoDescription; ?>
                            
                            </textarea>
                        </div>
                   </div>



                   <div class="col-md-4" >
                            <div  class="photo-info-box">
                                <div class="info-box-header">
                                   <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
                                </div>
                            <div class="inside">
                              <div class="box-inner">
                                 <p class="text">
                                   <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                                  </p>
                                  <p class="text ">
                                    Photo Id: <span class="data photo_id_box"><?php echo $photo->id; ?></span>
                                  </p>
                                  <p class="text">
                                    Filename: <span class="data"><?php echo $photo->fileName; ?></span>
                                  </p>
                                 <p class="text">
                                  File Type: <span class="data"><?php echo $photo->type; ?></span>
                                 </p>
                                 <p class="text">
                                   File Size: <span class="data"><?php echo $photo->size; ?></span>
                                 </p>
                              </div>
                              <div class="info-box-footer clearfix">
                                <div class="info-box-delete pull-left">
                                    <a href="delete_photo.php?id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>
                                </div>
                                <div class="info-box-update pull-right ">
                                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </form>

                </div>

            </div>
            <!-- /.row -->

</div>
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>