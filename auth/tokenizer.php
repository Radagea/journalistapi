<?php
    /*
        Class: Tokenizer
        Description: This class for generate token, get user from token
    */

    class Tokenizer {
        
        private $conn;
        private $table = 'usersToken';

        //fields
        public $id;
        public $userId;
        public $token;
        public $expiresAt;

        public function __construct($db) {
            $this -> conn = $db;
        }

        public function generateToken($user,$rememberMe) {
            $time = md5(date("Y-m-d H:i:s"));
            $pass = md5($user->password);
            $mail = md5($user->email);
            $rand = rand(1,100);
            $this->token = $time."-".md5($pass.$rand.$mail);
            $this->userId = $user -> id;


            $date = new DateTime();

            if ($rememberMe) {
                $date->add(new DateInterval('P10D'));
            } else {
                $date->add(new DateInterval('P1D'));
            }
            $this->expiresAt = $date->format('Y-m-d H:i:s');
        }

        public function databaseFunction() {
            if (!($this->thereIsToken())) {
                $this->insertToken();
            } else {
                $this->updateToken();
            }
        }

        public function getUserId() {
            $query = 'SELECT * FROM '.$this->table.' WHERE token = ?';
            $stmt = $this->conn->prepare($query);
            $stmt->bindPARAM(1,$this->token);
            $stmt->execute(); 
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($row > 0) {
                $this->id = $row['id'];
                $this->userId = $row['userId'];
                $this->expiresAt = $row['expiresAt'];
                $date = new DateTime();
                if ($this->expiresAt <= $date->format('Y-m-d H:i:s')) {
                    return false;
                }
                return true;
            }
            return false;
        }



        //Private functions

        private function insertToken() {
            $query ='INSERT INTO '.$this->table.' SET userId = :userId, token = :token, expiresAt = :expiresAt';
            $stmt = $this-> conn -> prepare($query);
            
            $stmt->bindParam(':userId',$this->userId);
            $stmt->bindParam(':token',$this->token);
            $stmt->bindParam(':expiresAt',$this->expiresAt);

            $stmt->execute();
        }

        private function updateToken() {
            $query = 'UPDATE '.$this->table.' SET token = :token, expiresAt = :expiresAt WHERE userId = :userId';
            $stmt = $this -> conn -> prepare($query);
            
            $stmt->bindParam(':token',$this->token);
            $stmt->bindParam(':expiresAt',$this->expiresAt);
            $stmt->bindParam(':userId',$this->userId);

            $stmt->execute();
        }
        
        private function thereIsToken() {
            $query = 'SELECT id FROM '.$this->table.' WHERE userId = ?';
            $stmt = $this -> conn -> prepare($query);
            $stmt->bindParam(1,$this->userId);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row > 0) {
                return true;
            }
            return false;
        }
    }
?>