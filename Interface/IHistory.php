<?php
interface IHistory{
    public function Create($reservation_id,$cart_item_id);
    public function getByID($reservation_id);
}
 ?>