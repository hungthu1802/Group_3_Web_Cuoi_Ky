<?php
interface IContact{
    public function getContact($user_id);
    public function setContact($user_id, $phone_number,$address);
}
 ?>