<?php
    class Journals {
        private $conn;
        private $table = 'journals';

        public $id;
        public $name;

        public function __construct($db) {
            $this -> conn = $db;
        }

        public function read($limit){

            if ($limit > 0) {
                $query = 'SELECT id,name FROM '.$this->table.' LIMIT 0,'.$limit;
            } else {
                $query = 'SELECT id,name FROM '.$this->table;
            }


            $stmt = $this -> conn -> prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function getJournalName() {
            $query = 'SELECT name FROM '.$this->table.' WHERE id = ?';

            $stmt = $this -> conn -> prepare($query);
            $stmt->bindParam(1,$this->id);
            $stmt -> execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->name = $row['name'];
            
        }
    }
?>