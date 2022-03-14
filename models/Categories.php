<?php
    class Categories {

        //DB
        private $conn;
        private $table = 'categories';

        //Categories properties
        public $id;
        public $name;
        public $articleNumber;

        //Constructor
        public function __construct($db) {
            $this -> conn = $db;
        }

        public function read() {
            $query = 'SELECT id, name, articleNumber FROM '.$this->table;

            //Prepare stmt
            $stmt = $this->conn->prepare($query);
            //Execute query
            $stmt->execute();
            return $stmt;
        }

        public function read_one() {
            $query = 'SELECT id, name, articleNumber FROM '.$this->table.' WHERE id = ? LIMIT 0,1';

            //Prepare
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->$argcid = $row['id'];
            $this->name = $row['name'];
            $this->articleNumber = $row['articleNumber'];
        }
    }
?>