<?php
    include_once '../../models/articles/Articlesauthor.php';

    function getAuthors($id,$db) {
        $author = new Articlesauthor($db);
        $result = $author -> getAuthorsByAID($id);
        $num = $result -> rowCount();
        $author_array = array();

        if ($num > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $author_item = array(
                    'id' => $id,
                    'firstname' => $firstname,
                    'lastname' => $lastname
                );
                array_push($author_array,$author_item);
            }
        }

        return $author_array;
    }
?>