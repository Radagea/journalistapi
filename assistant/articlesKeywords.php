<?php
    include_once '../../models/articles/Articleskeywords.php';

    function getKeywords($id,$db) {
        $keywords = new Articleskeywords($db);
        $result = $keywords -> getKeywordsByAID($id);
        $keyword_array = array();

        $num = $result -> rowCount();

        if ($num > 0) {
            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $keyword_item = array(
                    'id' => $id,
                    'keyword' => $keyword
                );
                array_push($keyword_array,$keyword_item);
            }
        }
        return $keyword_array;
    }
?>