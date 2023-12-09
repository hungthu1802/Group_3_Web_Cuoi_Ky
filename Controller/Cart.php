<?php
require_once "../../db.conn.php";
require_once "../Interface/ICart.php";
require_once "../Classes/Cart.php";
require_once "../Interface/ICartDetails.php";
require_once "../Classes/CartDetails.php";
if(isset($_GET["id"]) && isset($_GET["food_id"])){
    $user_id = $_GET["id"];
    $food_id = $_GET["food_id"];
    $cart = new Cart();
    $cartId= $cart->getCartByID($user_id)[0]["cart_id"];
    if(isset($_GET["create"])&& $_GET["create"]){
        $cartDetail = new CartDetails();
        $cartDetail->AddCartDetails($cartId, $food_id);
        header("Location: ../../index.php?id=".$_GET["id"]);
    }
    if(isset($_GET["delete"])){
        $cartDetail = new CartDetails();
        $cartDetail->DeleteCart($food_id);
        header("Location: ../../index.php?id=".$_GET["id"]);
    }
}
 ?>