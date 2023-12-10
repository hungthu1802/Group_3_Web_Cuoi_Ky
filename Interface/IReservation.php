<?php
interface IReservations{
    public function add($user_id, $order_date,$order_time, $num_of_food, $order_status, $cart_id, $total);
    public function getAll();
    public function getById($reservation_id);
    public function upDateState($reservation_id, $order_status);
    public function delete($reservation_id);
    public function getNewRe();
}
 ?>