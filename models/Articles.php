<?php
    class Articles {
        //DB init
        private $conn;
        private $table = 'article';
        private $authortable ;
        private $categorytable = 'articlesCategories';
        private $keywordstable = 'articlesKeywords';

        public $id;
        public $title;
        public $abstract;
        public $fulltext;
        public $fulltextdf;
        public $views;
        public $publishedtime;
        public $type;


        //Constructor  
        public function __construct($db){
            $this -> conn = $db;
        }

        public function read() {
            $query = 'SELECT * FROM '.$this->table.' LIMIT 0,10';

            //Prepare
            $stmt = $this -> conn -> prepare($query);

            $stmt -> execute();

            return $stmt;
        }
    }
?>