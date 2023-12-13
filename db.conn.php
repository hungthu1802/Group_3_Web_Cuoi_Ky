<?php
class dbModel{
    private $db;
    private $servername = "127.0.0.1"; // Tên máy chủ MySQL
    private $username = "root"; // Tên người dùng MySQL
    private $password = ""; // Mật khẩu MySQL
    private $dbname = "herber"; // Tên cơ sở dữ liệu MySQL

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this-> password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Lỗi kết nối đến cơ sở dữ liệu: " . $e->getMessage());
        }
    }

    public function GetAll($tablename){
        try{
            $sql = "SELECT * FROM $tablename";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
        catch(PDOException $e){
            echo "Lỗi:".$e->getMessage();
        }
    }
    public function GetByEmail($tablename, $email, $columname){
        try{
            $email= trim($email);
            $sql = "SELECT * FROM $tablename WHERE $columname = '$email' LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
        catch(PDOException $e){
            echo "Lỗi:".$e->getMessage();
        }
    }
    public function Create($tablename, $data){
        try{
            $columns = implode(', ', array_keys($data));//Lấy các key của data
            $placeholders = ':' . implode(', :', array_keys($data));// Tạo placeholders để insert vào bảng
            $sql = "INSERT INTO $tablename ($columns) VALUES ($placeholders)";
            $stmt = $this->db->prepare($sql);
    
        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
            
        }
        $stmt->execute();
        return 1;
        
        }
        catch(PDOException $e){
            die("Lỗi thêm dữ liệu vào bảng: ".$e->getMessage());
        }
    }
    public function Update($tablename, $data, $id, $columname){
        try{
            $array = [];
            foreach($data as $key => $value){
                $nameSet = "$key = :$key";
                array_push($array, $nameSet);
            }
            $columns = implode(', ', $array);
            $sql = "UPDATE $tablename SET $columns  WHERE $columname = :id";
            $stmt = $this->db->prepare($sql);
        
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            
            }
            catch(PDOException $e){
                die("Lỗi thêm dữ liệu vào bảng: ".$e->getMessage());
            }
    }

    public function UpdateState($tablename, $data, $id, $columname, $id2, $columname2){
        try{
            $array = [];
            foreach($data as $key => $value){
                $nameSet = "$key = :$key";
                array_push($array, $nameSet);
            }
            $columns = implode(', ', $array);
            $sql = "UPDATE $tablename SET $columns  WHERE $columname = :id AND $columname2 = :id2";
            $stmt = $this->db->prepare($sql);
        
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':id2', $id2);
            $stmt->execute();
            
            }
            catch(PDOException $e){
                die("Lỗi thêm dữ liệu vào bảng: ".$e->getMessage());
            }
    }
    public function Delete($tablename, $id, $columname){
        try{
            $sql = "DELETE FROM $tablename WHERE $columname = :id LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
        catch(PDOException $e){
            echo "Lỗi:".$e->getMessage();
        }
    }

    public function getByColumn($id, $tablename, $columname){
        try{
            $id= trim($id);
            $sql = "SELECT * FROM $tablename WHERE $columname = '$id'";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
        catch(PDOException $e){
            echo "Lỗi:".$e->getMessage();
        }
    }

    public function getLastFood($tablename, $columname){
        try{
            $sql = "SELECT * FROM $tablename
            ORDER BY $columname DESC
            LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        }
        catch(PDOException $e){
            echo "Lỗi:".$e->getMessage();
        }
    }

}
 ?>