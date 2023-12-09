<?php
require_once "../../db.conn.php";
require_once "../Interface/IFood.php";
require_once "../Classes/Food.php";
require_once "../Interface/IImage.php";
require_once "../Classes/Image.php";
require_once "../Interface/IPromotion.php";
require_once "../Classes/Promotion.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $food_name = $_POST["food_name"];
    $menu_id = $_POST["menu_id"];
    $promotion_id = $_POST["promotion_id"];
    $price = $_POST["price"];
    $files = $_POST["files"];
    $promotion = new Promotion();
    if($promotion_id > 0){
        $saleoff= $promotion->getPromotionById($promotion_id)[0]["saleoff"];
        $price_new =$price - ($price * $saleoff / 100);
        $food = new Food();
        $food->addFood($menu_id,$promotion_id,$food_name,$price, $price_new);
    }
    else{
        $price_new =$price;
        $food = new Food();
        $food->addFood($menu_id,$promotion_id,$food_name,$price, $price_new);
    }
    $db = new dbModel();
    $food_id = $db->getLastFood("food","food_id")[0];
    $image = new Image();
    foreach($files as $file){
        $image->addImage($file, $food_id["food_id"]);
    }
}

if(isset($_GET["delete"])){
        $food_id = $_GET["id"];
        $food = new Food();
        $image = new Image();
        $lst = $image->getByColumn($food_id);
        foreach($lst as $item){
            $image->deleteImage($food_id);
        }
        $food->deleteFood($food_id);
        header("Location: ../../admin/index.php");
}

if(isset($_GET["update"])){
    $food_name = $_GET["food_name"];
    $menu_id = $_GET["menu_id"];
    $promotion_id = $_GET["promotion_id"];
    $price = $_GET["price"];
    $food_id = $_GET["id"];
    if($promotion_id > 0){
        $saleoff= $promotion->getPromotionById($promotion_id)[0]["saleoff"];
        $price_new =$price - ($price * $saleoff / 100);
        $food = new Food();
        $food->updateFood($food_id,$menu_id,$promotion_id,$food_name,$price, $price_new);
    }
    else{
        $price_new =$price;
        $food = new Food();
        $food->updateFood($food_id,$menu_id,$promotion_id,$food_name,$price, $price_new);
    }
    header("Location: ../../admin/index.php");
}
 ?>