<?php
require_once "../../db.conn.php";
require_once "../Interface/IPromotion.php";
require_once "../Classes/Promotion.php";
if($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_GET['update'])){
    $promotion_name = $_POST["promotion_name"];
    $description = $_POST["description"];
    $saleoff = $_POST["saleoff"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $promotion = new Promotion();
    $promotion->addPromotion($promotion_name, $description,$saleoff, $start_date, $end_date);
}
else{
    $promotion_id = $_GET['id'];
    $promotion_name = $_POST["promotion_name"];
    $description = $_POST["description"];
    $saleoff = $_POST["saleoff"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $promotion = new Promotion();
    $promotion->updatePromotion($promotion_id, $promotion_name,$description,$saleoff, $start_date,$end_date);
}
if(isset($_GET['id'])){
    $promotion_id = $_GET['id'];
    if(isset($_GET['delete'])){
        $promotion = new Promotion();
        $promotion->deletePromotion($promotion_id);
    }
}
 ?>