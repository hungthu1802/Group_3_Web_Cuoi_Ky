<?php
require_once "../../db.conn.php";
require_once "../Interface/IUsers.php";
require_once "../Classes/Users.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_name = $_POST["user_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $phone_number = $_POST["phone_number"];
}

$user = new Users();
$user->CreateUser($user_name, $password,$email, $phone_number);
 ?>