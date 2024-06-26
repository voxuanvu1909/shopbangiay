<?php
    require_once("./config/db.class.php");

    class User
    {
        public $userID;
        public $userName;
        public $email;
        public $password;

        public function __construct(){}

        public function makeNewWithParameter($u_name, $u_email, $u_pass){
            $obj = new User(); 
            return $obj;
            // $this->userName = $u_name;
            // $this->email = $u_email;
            // $this->password = $u_pass;
        }

        public static function makeNewWithParameter1($u_name, $u_pass) {
            $obj = new User(); 
            return $obj;
        }

        public function save(){
            $db = new Db();
            $sql = "INSERT INTO users (UserName, Email, Password) VALUES ('".mysqli_real_escape_string($db->connect(),
            $this->userName)."', '".mysqli_real_escape_string($db->connect(),
            $this->email)."', '".md5(mysqli_real_escape_string($db->connect(), $this->password))."')";
            $result = $db->query_excute($sql);
            return $result;
        }

        public static function checkLogin($username, $password){
            $password = md5($password);
            $db = new Db();
            $sql = "SELECT * FROM users where UserName='$username' AND Password = '$password'";
            $result = $db->query_excute($sql);
            return $result;
        }
    }
?>