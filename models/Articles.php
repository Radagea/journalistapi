<?php
    class Articles {
        //DB init
        private $conn;
        private $table = 'article';

        public $id;
        public $title;
        public $abstract;
        public $fulltext;
        public $fulltextdf;
        public $views;
        public $publishedtime;
        public $type;
        public $oa;
        public $journalid;


        //Constructor  
        public function __construct($db){
            $this -> conn = $db;
        }

        public function read() {
            $query = 'SELECT 
            id,
            title,
            views,
            publishedtime,
            type,
            oa,
            jid
            FROM '.$this->table.' LIMIT 0,10';

            //Prepare
            $stmt = $this -> conn -> prepare($query);

            $stmt -> execute();

            return $stmt;
        }

        public function getOaRandom() {
            $query = 'SELECT * FROM '.$this->table.' WHERE oa = 1 ORDER BY RAND() LIMIT 5';
            
            $stmt = $this -> conn -> prepare($query);
            $stmt -> execute();

            return $stmt;
        }

        public function read_one() {
            $query = 'SELECT * FROM '.$this->table.' WHERE id=? LIMIT 0,1';

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->title = $row['title'];
            $this->abstract = $row['abstract'];
            $this->views = $row['views'];
            $this->publishedtime = $row['publishedtime'];
            $this->type = $row['type'];
            $this->oa = $row['oa'];
            $this->journalid = $row['jid'];
        }
        
        public function read_from_jid($jid) {
            $query = 'SELECT 
            id,
            title,
            views,
            publishedtime,
            type,
            oa,
            jid
            FROM '.$this->table.' WHERE jid=? LIMIT 0,10';
            //Prepare
            $stmt = $this -> conn -> prepare($query);
            $stmt->bindParam(1,$jid);

            $stmt -> execute();

            return $stmt;
        }
    }
?>