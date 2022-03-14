<?php
    //Headers 
    
    header('Content-Type: application/json');

    //Includes for the neccessary configs/datamodels 
    include_once '../../config/Database.php';
    include_once '../../models/Articles.php';
    include_once '../../models/articles/Articlesauthor.php';

    $database = new Database();
    $db = $database->connect();

    $articles = new Articles($db);

    $result = $articles -> read();
    $num = $result -> rowCount();

    if ($num > 0) {
        $articles_arrays = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $authors = new Articlesauthor($db);
            $aresult = $authors -> getAuthorsByAID($id);
            $anum = $aresult -> rowCount();
            $author_array = array();
            if ($anum > 0) {
                while ($arow = $aresult->fetch(PDO::FETCH_ASSOC)) {
                    $author_item = array(
                        'id' => $arow['id'],
                        'firstname' => $arow['firstname'],
                        'lastname' => $arow['lastname']
                    );
                    array_push($author_array,$author_item);
                }
            }

            $articles_item = array( 
                'id' => $id,
                'title' => $title,
                'abstract' => $abstract,
                'fulltext' => $fulltext,
                'fulltextpdf' => $fulltextpdf,
                'views' => $views,
                'authors' => $author_array,
                'publishedtime' => $publishedtime,
                'type' => $type
            );
            array_push($articles_arrays,$articles_item);
        }
        echo json_encode($articles_arrays);
    }
?>