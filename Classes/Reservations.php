<?php
class Reservations implements IReservations{
    private $db;
    private $tablename = "reservations";
    public function __construct()
    {
        $this->db = new dbModel();

    }

    public function add($user_id, $order_date, $order_time, $num_of_food, $order_status, $cart_id, $total)
    {
        $data = array("user_id"=>$user_id, "order_date"=>$order_date, "order_time"=>$order_time, "num_of_food"=>$num_of_food,
        "order_status"=>$order_status, "cart_id"=>$cart_id,"total"=>$total);
        $this->db->Create($this->tablename, $data);
    }

    public function getAll()
    {

        $result = $this->db->GetAll($this->tablename);
        return $result;
    }

    public function getById($user_id)
    {
        $result = $this->db->getByColumn($user_id, $this->tablename, "user_id");
        return $result;
    }

    public function getFoodID($food_id){
        $result = $this->db->getByColumn($food_id, $this->tablename, "food_id");
        return $result;
    }

    public function upDateState($reservation_id, $order_status)
    {
        $data = array("order_status"=>$order_status);
        $this->db->Update($this->tablename,$data,$reservation_id,"reservation_id");
    }

    public function delete($reservation_id)
    {
        $this->db->Delete($this->tablename, $reservation_id, "reservation_id");
    }

    public function getNewRe()
    {
         $result =$this->db->getLastFood($this->tablename,"reservation_id");
         return $result;
    }
}
 ?>