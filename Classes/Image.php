<?php
class Image implements IImage{
    private $db;
    private $tablename = "Image";
    public function __construct()
    {
        $this->db = new dbModel();
    }
    public function getById($food_id)
    {
        $result = $this->db->getImage($food_id, $this->tablename,"food_id");
        return $result;
    }

    public function addImage($image_url, $food_id)
    {
        $data = array("image_url" => $image_url, "food_id" => $food_id);
        $this->db->Create($this->tablename,$data);
    }

    public function deleteImage($food_id)
    {
        
    }
}
 ?>