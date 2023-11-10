<?php include("init.php")?>

<?php 

if($session->isSignedIn()){
    redirect("index.php");
}

if (isset($_POST["submit"])){
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if ($foundUser){
        $session->login($foundUser);
        redirect("index.php");
    } else {
        $message = "Your password or username are incorrect";
    }
} else {
    $username = "";
    $password = "";
}

?>