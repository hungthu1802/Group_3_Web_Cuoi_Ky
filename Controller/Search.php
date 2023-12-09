<?php
require_once "../../db.conn.php";
require_once "../Interface/IFood.php";
require_once "../Classes/Food.php";
// Kiểm tra xem form đã được gửi hay chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $searchTerm = $_POST["search"];
    $userId = $_POST["id"];

    if (!empty($searchTerm)) {
        $searchTerm = strtolower(trim($searchTerm));
        $food= new Food();
        $foodAll = $food->getAll();
        if(!$foodAll){
            header("Location: ../../index.php?id=$userId");
        }
        foreach($foodAll as $item){
            $stringFood = strtolower(trim($item["food_name"]));
            if($stringFood == $searchTerm){
                header("Location: ../../index.php?id=$userId#". $item["food_id"]);
            }
        }
    } else {
        header("Location: ../../index.php?id=$userId");
    }
}
?>
