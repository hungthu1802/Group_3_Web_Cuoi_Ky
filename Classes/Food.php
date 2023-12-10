<?php
class Food implements IFood{
    private $db;
    private $tablename = "food";
    private $food_id;
    private $food_name;
    private $menu_id;
    private $promotion_id;
    private $price;
    public function __construct()
    {
        $this->db = new dbModel();
    }
    public function getAll()
    {
        $result = $this->db->GetAll($this->tablename);
        return $result;
    }

    public function getByMenu($menu_id){
        $result = $this->db->getByColumn($menu_id,$this->tablename, "menu_id");
        return $result;
    }

    public function getById($food_id)
    {
        $result = $this->db->GetByEmail($this->tablename, $food_id, "food_id");
        return $result;
    }

    public function addFood($menu_id, $promotion_id, $food_name, $price, $price_new)
    {
        $data = array('menu_id'=> $menu_id, "promotion_id"=>$promotion_id, "food_name"=>$food_name,"price"=>$price, "price_new"=>$price_new);
        $this->db->Create($this->tablename, $data);
        header("Location: ../../admin/index.php");
    }

    public function updateFood($food_id, $menu_id, $promotion_id, $food_name, $price, $price_new)
    {
        $data = array('menu_id'=> $menu_id, "promotion_id"=>$promotion_id, "food_name"=>$food_name,"price"=>$price, "price_new" => $price_new);
        $this->db->Update($this->tablename, $data,$food_id,"food_id");
    }

    public function deleteFood($food_id)
    {
        $this->db->Delete($this->tablename, $food_id, "food_id");
    }
}
 ?>