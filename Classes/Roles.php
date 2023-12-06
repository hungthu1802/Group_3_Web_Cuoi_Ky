<?php
class Roles implements IRoles{
    private $role_id;
    private $tablename = 'roles';
    private $db;
    private $role_name;
    public function __construct($role_id)
    {
        $this->role_id = $role_id;
        $this->db = new dbModel();
    }
    public function getRole(){
        $roles= $this->db->GetByEmail($this->tablename, $this->role_id, "role_id");
        return $roles["role_name"];   
}
}
 ?>