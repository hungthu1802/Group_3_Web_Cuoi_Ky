<?php
interface ICart{
    public function createCart($user_id);
    public function getCartByID($user_id);
}
 ?>