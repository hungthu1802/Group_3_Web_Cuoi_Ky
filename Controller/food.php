<?php
require_once "../../db.conn.php";
require_once "../Interface/IFood.php";
require_once "../Classes/Food.php";
require_once "../Interface/IImage.php";
require_once "../Classes/Image.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $food_name = $_POST["food_name"];
    $menu_id = $_POST["menu_id"];
    $promotion_id = $_POST["promotion_id"];
    $price = $_POST["price"];
    $files = $_POST["files"];
    $food = new Food();
    $food->addFood($menu_id,$promotion_id,$food_name,$price);
    $db = new dbModel();
    $food_id = $db->getLastFood("food","food_id")[0];
    $image = new Image();
    foreach($files as $file){
        $image->addImage($file, $food_id["food_id"]);
    }
}
 ?>