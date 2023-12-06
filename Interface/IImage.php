<?php
interface IImage{
    public function getById($food_id);
    public function addImage($image_url, $food_id);
    public function deleteImage($food_id);
}
 ?>