<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Blank Page
                <small>Subheading</small>
            </h1>
            <?php
                
                // $resultSet = User::findAllUsers();

                //  while ($row = mysqli_fetch_array($resultSet)) {
                //      echo $row['username']."<br>";
                // }

                // $foundUser = User::findUserById(1);
                // $user = User::instantiation($record);
                // echo $user->username."<br>";

                // $users = User::findAllUsers();
                // foreach ($users as $user){
                //     echo $user->username."<br>";
                // }

                $foundUser = User::findUserById(1);
                echo $foundUser->username ."";

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