<?php
interface IPromotion{
    public function addPromotion($promotion_name, $description,$saleoff, $start_date, $end_date);
    public function getPromotion();
    public function getPromotionById($promotion_id);
    public function deletePromotion($promotion_id);
    public function updatePromotion($promotion_id, $promotion_name, $description,$saleoff, $start_date, $end_date);
}
 ?>