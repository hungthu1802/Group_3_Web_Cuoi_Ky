<?php
interface IFeedback{
    public function __construct();
    public function addFeedback( $user_id, $comment);
    public function getFeedback();
}
 ?>