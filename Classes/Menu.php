<?php
class Menu implements IMenu{
    private $db;
    private $tablename = "menu";
    public function __construct()
    {
        $this->db= new dbModel();
    }
    public function GetAll()
    {
        $result = $this->db->GetAll($this->tablename);
        return $result;
    }

    public function GetByID($menu_id)
    {
        $result = $this->db->GetByEmail($this->tablename, $menu_id, "menu_id");
        return $result;
    }
}
 ?>