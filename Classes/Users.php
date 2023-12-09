<?php
    class Users implements IUsers{
        private $db;
        private $user_id;
        private $tablename = 'users';
        private $user_name;
        private $password;
        private $email;
        private $phone_number;
        public function __construct()
        {
            $this->db = new dbModel();
        }
        public function GetUserByEmail($email, $password){
            $result = $this->db->GetByEmail($this->tablename,$email,"email");
            foreach($result as $row){
                if(password_verify($password, $row["password"])){
                    session_start();
                    $_SESSION["user_name"] = $row["user_name"];
                    $_SESSION["email"] = $row["email"];
                    $_SESSION["user_id"] = $row["user_id"];
                    $_SESSION["phone_number"] = $row["phone_number"];
                    $_SESSION["role_id"] = $row["role_id"];
                    return 1;
                }
                else{
                    echo '<script>alert("Sai mật khẩu!");
                    window.href="login.php";
                    </script>';
                }
            }
        }

        public function CreateUser($user_name, $password,$email,$phone_number)
        {
            $role_id = 1;
           $data = array('user_name'=>$user_name, 'password' => password_hash($password, PASSWORD_DEFAULT),'email'=> $email, 'role_id'=>$role_id,'phone_number'=>$phone_number);
           $state = $this->db->Create($this->tablename, $data);
           if($state == 1){
            session_start();
            $_SESSION["user_name"] = $user_name;
            echo '<script>alert("Đăng ký thành công!");</script>';
            header("Location: ../../login.php");
           }
        }

        public function GetUserById($user_id)
        {
            $result = $this->db->GetByEmail($this->tablename,$user_id,"user_id");
            return $result;
        }

        public function GetUserNew(){
            $user = $this->db->getLastFood($this->tablename, "user_id");
            return $user;
        }
    }
 ?>