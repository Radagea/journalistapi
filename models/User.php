<?php
class User {
    //DB init
    private $conn;
    private $table = 'users';

    //User fields:

    public $id;
    public $email;
    public $password;
    public $firstName;
    public $lastName;

    public function __construct($db) {
        $this -> conn = $db;
    }

    public function getUserById() {
        $query = 'SELECT * FROM '.$this->table.' WHERE id = ? LIMIT 0,1';

        //prepare 
        $stmt = $this->conn->prepare($query);
        $stmt -> bindParam(1,$this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row > 0) {
            $this->email = $row['email'];
            $this->firstName = $row['firstName'];
            $this->lastName = $row['lastName'];
            return true;
        } else {
            return false;
        }
    }

    public function authenticateUser() {
        $query = 'SELECT * FROM '.$this->table.' WHERE email = ? AND password = ? LIMIT 0,1';
        
        $this->password = md5($this->password);

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->email);
        $stmt->bindParam(2,$this->password);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row > 0) {
            $this->id = $row['id'];
            return true;
        } else {

            return false;
        }
    }

    public function registerUser() {
        //Check there is registration already:
        if ($this->isThereSame()) {
            return false;
        }

        $query = 'INSERT IGNORE INTO '.$this->table.' SET email = :email, password = :password';

        $stmt = $this -> conn ->prepare($query);

        //bind data

        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', md5($this->password));

        //Execute

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    private function isThereSame() {
        $query = 'SELECT id FROM '.$this->table.' WHERE email = ?';
        
        $stmt = $this -> conn -> prepare($query);

        //bind data
        $stmt->bindParam(1,$this->email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row > 0) {
            return true;
        }

        return false;

    }
}
?>