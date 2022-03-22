<?php

    class Types {

        //DB init
        private $conn;
        private $table = 'articleTypes';

        //Article props
        public $id;
        public $name;

        //Constructor 

        public function __construct($db) {
            $this -> conn = $db;
        }

        public function read() {
            $query = 'SELECT id, name FROM '.$this->table;

            //Prepare stmt
            $stmt = $this->conn->prepare($query);

            //Execute the query 
            $stmt->execute();
            return $stmt;
        }

        public function getTypeFromID() {
            $query = 'SELECT name FROM '.$this->table.' WHERE id = ?';

            //STMT prepare
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->name = $row['name'];
        }
    }
?>