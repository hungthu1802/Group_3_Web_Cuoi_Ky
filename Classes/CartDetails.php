<?php
class CartDetails implements ICartDetails{
    private $db;
    private $tablename = "cart_items";
    public function __construct()
    {
        $this->db = new dbModel();
    }
    public function AddCartDetails($cart_id, $food_id)
    {
        $data = array("cart_id"=>$cart_id, "food_id"=>$food_id, "isPay"=>"N");
        $this->db->Create($this->tablename, $data);
    }
    public function GetCartDetails($cart_id)
    {
        $cart = $this->db->getByColumn($cart_id, $this->tablename, "cart_id");
        return $cart;
    }

    public function GetCartByRe($reservation_id)
    {
        $cart = $this->db->getByColumn($reservation_id, $this->tablename, "reservation_id");
        return $cart;
    }

    public function GetCartByFood($food_id)
    {
        $cart = $this->db->getByColumn($food_id, $this->tablename, "food_id");
        return $cart;
    }

    public function DeleteCart($food_id)
    {
        $this->db->Delete($this->tablename,$food_id,"food_id");
    }

    public function Update($cart_id, $isPay, $reservation_id){
        $data = array("isPay"=>$isPay, "reservation_id" => $reservation_id);
        $this->db->Update($this->tablename,$data, $cart_id, "cart_item_id");
    }

    public function UpdateState($cart_id, $isPay, $reservation_id){
        $data = array("isPay"=>$isPay);
        $this->db->UpdateState($this->tablename, $data, $cart_id, "cart_item_id",$reservation_id, "reservation_id");
    }

    public function GetColumn()
    {
        $result = $this->db->getByColumn("N", $this->tablename, "isPay");
        return $result;
    }
}
 ?>