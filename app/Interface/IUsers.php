<?php
interface IUsers{
    public function GetUserByEmail($user_name, $password);
    public function CreateUser($user_name, $password,$email,$phone_number);
    public function GetUserById($user_id);
}
 ?>