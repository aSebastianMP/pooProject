<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Blank Page
                <small>Subheading</small>
            </h1>
            <?php
                // $userTest = new User();
                // $userTest->username = "STROG";
                // $userTest->password = "123";
                // $userTest->firstName = "Sebastian";
                // $userTest->lastName = "Marquez";

                // $userTest->create();

                // $userTest = User::findUserById(2);
                // $userTest->lastName = "Fulano";
                // $userTest->update(); }

                $userTest = User::findUserById(2);
                $userTest->delete();
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