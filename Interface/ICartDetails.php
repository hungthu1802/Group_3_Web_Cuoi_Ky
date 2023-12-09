<?php
interface ICartDetails{
    public function AddCartDetails($cart_id,$food_id);
    public function GetCartDetails($cart_id);
    public function DeleteCart($food_id);
    public function Update($cart_id,$isPay, $reservation_id);
    public function GetColumn();
}
 ?>