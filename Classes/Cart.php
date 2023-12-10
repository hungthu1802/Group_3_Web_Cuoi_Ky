<?php
class Cart implements ICart{
    private $cart_id;
    private $db;
    private $tablename = "shopping_cart";
    public function __construct()
    {
        $this->db = new dbModel();
    }
    public function createCart($user_id)
    {
        $data = array("user_id" => $user_id);
        $this->db->Create($this->tablename, $data);
    }
    public function getCartByID($user_id)
    {
        $cart = $this->db->GetByEmail($this->tablename,$user_id,"user_id");
        return $cart;
    }
}
 ?>