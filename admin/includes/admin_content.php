<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Blank Page
                <small>Subheading</small>
            </h1>
            <?php
                //    $userTest = new User();
                //    $userTest->username = "DavidW1";
                //    $userTest->password = "123";
                //    $userTest->firstName = "David";
                //    $userTest->lastName = "Wallace";
                //    $userTest->create();

                //  $userTest = User::findUserById(10);
                //  $userTest->firstName = "Not Jhon";
                //  $userTest->lastName = "Not Doe";
                //  $userTest->update(); 

                //  $userTest = User::findUserById(5);
                //  $userTest->delete();

                //  $userTest = User::findById(4);

                //  $userTest->username = "Temp name";
                //  $$userTest->save();

                //  $userTest = new User();
                //  $userTest->username = "Test latest one";
                //  $userTest->save();

                //  $userTest = User::findAll();

                //  foreach($userTest as $user){
                //      echo $user->username;
                //  }

                // $photos = Photo::findAll();
                // foreach($photos as $photo){
                //     echo $photo->title;
                // }

                // $photos = new Photo();
                // $photos->title = "Image title test";
                // $photos->photoDescription = "This is a test";
                // $photos->fileName = "imageTest.jpg";
                // $photos->type = "image";
                // $photos->size = "10";
                
                // $photos->create();

                // echo INCLDUES_PATH;

                // $userTest = User::findById(4);
                // echo $userTest->username;


                $photos = Photo::findById(8);
                echo $photos->fileName;



            ?>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->