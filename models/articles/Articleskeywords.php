<?php
    class Articleskeywords {
        private $conn;
        private $table = 'articlesKeywords';

        public $id;
        public $aid;
        public $authid;

        public $keyword;

        public function __construct($db) {
            $this -> conn = $db;
        }

        public function getKeywordsByAID($articleID) {
            $query = "SELECT id,keyword FROM articlesKeywords WHERE aid = ".$articleID;

            $stmt = $this -> conn -> prepare($query);
            $stmt -> execute();
            return $stmt;
        }
    }
?>