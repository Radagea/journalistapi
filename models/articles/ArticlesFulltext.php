<?php

class ArticlesFulltext {
    //DB init
    private $conn;
    private $table = 'articlesFulltext';

    //Datas
    public $id;
    public $articleID;
    public $fullText;
    public $fullTextPDFLink;
    public $sections;


    public function __construct($db) {
        $this -> conn = $db;
    }

    public function get_article() {
        $query = 'SELECT * FROM '.$this->table.' WHERE articleID = ?';

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$this->articleID);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->fullText = $row['fullText'];
        $this->fullTextPDFLink = $row['fullTextPDFLink'];
        $this->sections = $row['sections'];
    }
}
?>