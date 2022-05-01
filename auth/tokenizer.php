<?php
    class Tokenizer {
        
        private $conn;
        private $table = 'usersToken';

        //fields
        public $id;
        public $userId;
        public $token;
        public $expiresIn;

        public function __construct($db) {
            $this -> conn = $db;
        }

        public function generateToken($pass) {
            $time = md5(date("Y-m-d H:i:s"));
            $pass = md5($pass);
            echo $time."-".$pass;
            
        }
    }
?>