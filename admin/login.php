<?php include("includes/header.php")?>

<?php 

if($session->isSignedIn()){
    redirect("index.php");
}

if (isset($_POST["submit"])){
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $foundUser =  User::verifyUser($username, $password);

    if ($foundUser){
        $session->login($foundUser);
        redirect("index.php");
    } else {
        $message = "Your password or username are incorrect";
    }
} else {
    $message = "";
    $username = "";
    $password = "";
}

?>


<div class="col-md-4 col-md-offset-3">
    <h4 class="bg-danger"><?php echo $message; ?></h4>   
    <form id="login-id" action="" method="post">
        
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>" >

        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>"> 
        </div>
    <div class="form-group">
    <input type="submit" name="submit" value="submit" class="btn btn-primary">
    </div>
    </form>
</div>