<?php
class History implements IHistory{
    private $tablename = "history";
    private $db;
    public function __construct()
    {
        $this->db=new dbModel();
    }
    public function Create($reservation_id, $cart_item_id)
    {
        $data = array("reservation_id" => $reservation_id, "cart_item_id"=>$cart_item_id);
        $this->db->Create($this->tablename, $data);
    }

    public function getByID($reservation_id)
    {
        $result = $this->db->getByColumn($reservation_id, $this->tablename, "reservation_id");
        return $result;
    }
}
 ?>