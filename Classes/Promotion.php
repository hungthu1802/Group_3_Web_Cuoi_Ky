<?php
class Promotion implements IPromotion{
    private $db;
    private $tablename = "promotions";
    private $promotion_name;
    private $description;
    private $start_date;
    private $end_date;
    private $saleoff;
    public function __construct()
    {
        $this->db = new dbModel();
    }
    public function addPromotion($promotion_name, $description,$saleoff, $start_date, $end_date)
    {
        $this->promotion_name = $promotion_name;
        $this->description = $description;
        $this->saleoff = $saleoff;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $data = array('promotion_name'=>$promotion_name, 'description'=>$description,'saleoff'=>$saleoff, 'start_date' => $start_date, 'end_date'=>$end_date);
        $this->db->Create($this->tablename, $data);
        header("Location: ../../admin/promotion.php");
    }

    public function getPromotion()
    {
        $promotionall = $this->db->GetAll($this->tablename);
        return $promotionall;
    }

    public function getPromotionById($promotion_id)
    {
        $result = $this->db->GetByEmail($this->tablename, $promotion_id, "promotion_id");
        return $result;
    }

    public function updatePromotion($promotion_id, $promotion_name, $description,$saleoff, $start_date, $end_date)
    {
        $data = array('promotion_name'=>$promotion_name, 'description'=>$description,'saleoff'=>$saleoff, 'start_date' => $start_date, 'end_date'=>$end_date);
        $this->db->Update($this->tablename, $data, $promotion_id, "promotion_id");
        header("Location: ../../admin/promotion.php");
    }

    public function deletePromotion($promotion_id)
    {
        $this->db->Delete($this->tablename, $promotion_id, "promotion_id");
        header("Location: ../../admin/promotion.php");
    }
}
?>