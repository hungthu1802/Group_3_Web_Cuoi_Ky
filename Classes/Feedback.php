<?php
class Feedback implements IFeedback{
    private $db;
    private $tablename = 'feedbacks';
    private $feedback_id;
    private $user_id;
    private $comment;
    
    public function __construct(){
        $this->db = new dbModel();
        
    }
    public function addFeedback( $user_id, $comment)
    {
        $this->user_id = $user_id;
        $this->comment = $comment;
        $data = array('user_id' => $this->user_id, 'comment' => $this->comment);
        $this->db->Create($this->tablename, $data);
        header("Location: ../../feedback.php");
    }
    public function getFeedback(){
        $result = $this->db->GetAll($this->tablename);
        return $result;
    }
}
 ?>