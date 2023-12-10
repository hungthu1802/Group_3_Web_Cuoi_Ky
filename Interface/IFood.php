<?php
interface IFood{
    public function getAll();
    public function getById($food_id);
    public function addFood($menu_id, $promotion_id, $food_name, $price, $price_new);
    public function updateFood($food_id,$menu_id, $promotion_id, $food_name, $price, $price_new);
    public function deleteFood($food_id);
}
 ?>