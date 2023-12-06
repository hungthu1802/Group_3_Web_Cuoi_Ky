<?php
class Contact implements IContact{
    private $db;
    private $tablename = "contacts";
    private $contact_id;
    private $user_id;
    private $phone_number;
    private $address;
    public function __construct(){
        $this->db = new dbModel();
    }
    public function getContact($user_id)
    {
        $result = $this->db->GetByEmail($this->tablename,$user_id, "user_id");
        return $result;
    }
    public function setContact($user_id, $phone_number, $address)
    {
        $this->user_id = $user_id;
        $this->phone_number = $phone_number;
        $this->address = $address;
        $data = array("user_id" => $user_id, "phone_number" => $phone_number, "address" => $address);
        $this->db->Create($this->tablename, $data);
    }
}
 ?>