<?php
session_start();
require_once "../../db.conn.php";
require_once "../Interface/IFeedback.php";
require_once "../Classes/Feedback.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user_id = $_SESSION["user_id"];
    $comment = $_POST["comment"];
}

$feedback = new Feedback();
$feedback->addFeedback($user_id, $comment);
 ?>