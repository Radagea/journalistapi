<?php
    class Articlesauthor {
        private $conn;
        private $table = 'articlesAuthor';
        private $altertable = 'author';

        public $id;
        public $aid;
        public $authid;

        public $firstname;
        public $lastname;
        public $articlenumber;



        //Constructor 

        public function __construct($db) {
            $this -> conn = $db;
        }

        public function getAuthorsByAID($articleID) {
            $query = 'SELECT author.id, author.firstname, author.lastname FROM author INNER JOIN articlesAuthor ON author.id = articlesAuthor.authid WHERE articlesAuthor.aid = '.$articleID;
            
            //Statement
            $stmt = $this -> conn -> prepare($query);
            $stmt -> execute();

            return $stmt;
        }
    }
?>