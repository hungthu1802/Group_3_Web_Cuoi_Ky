<?php
require_once "../../db.conn.php";
require_once "../Interface/IUsers.php";
require_once "../Classes/Users.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];
    $password = $_POST["password"];
}

$user = new Users();
$state = $user->GetUserByEmail($email, $password);
if($state == 1){
    if(isset($_GET["isAdmin"])&& $_SESSION["role_id"]==2){
        header("Location: ../../admin/index.php?id=".$_SESSION["user_id"]);
    }
    else if($_SESSION["role_id"]==2){
        header("Location: ../../login.php?id=".$_SESSION["user_id"]);
    }
    else{
        header("Location: ../../index.php?id=".$_SESSION["user_id"]);
    }
}
 ?>
