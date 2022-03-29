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
    }
?>