<?php
    class Journals {
        private $conn;
        private $table = 'journals';

        public $id;
        public $name;
        public $language;
        public $shortDesc;
        public $lastArticle;
        public $startDate;
        public $imgUrl;
        public $articleNumber;

        public function __construct($db) {
            $this -> conn = $db;
        }

        public function read($limit){

            if ($limit > 0) {
                $query = 'SELECT id,name,shortDesc,articleNumber FROM '.$this->table.' LIMIT 0,'.$limit;
            } else {
                $query = 'SELECT id,name,shortDesc,articleNumber FROM '.$this->table;
            }


            $stmt = $this -> conn -> prepare($query);
            $stmt->execute();

            return $stmt;
        }

        public function getJournalDatas() {
            $query = 'SELECT name,language,shortDesc,lastArticle,startDate,imgUrl,articleNumber FROM '.$this->table.' WHERE id = ?';

            $stmt = $this -> conn -> prepare($query);
            $stmt->bindParam(1,$this->id);
            $stmt -> execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->name = $row['name'];
            $this->language = $row['language'];
            $this->shortDesc = $row['shortDesc'];
            $this->lastArticle = $row['lastArticle'];
            $this->startDate = $row['startDate'];
            $this->imgUrl = $row['imgUrl'];
            $this->articleNumber = $row['articleNumber'];
        }
    }
?>