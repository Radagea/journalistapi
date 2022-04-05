<?php
    //Headers 
    
    header('Content-Type: application/json');

    //Includes for the neccessary configs/datamodels 
    include_once '../../config/Database.php';
    include_once '../../models/Articles.php';
    include_once '../../models/Journals.php';
    include_once '../../assistant/articlesAuthor.php';
    include_once '../../assistant/articlesKeywords.php';

    $database = new Database();
    $db = $database->connect();

    $articles = new Articles($db);

    $result = $articles -> read();
    $num = $result -> rowCount();

    if ($num > 0) {
        $articles_arrays = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $author_array = getAuthors($id,$db);
            $keywords_array = getKeywords($id,$db);

            $journal = new Journals($db);
            $journal->id = $jid;
            $journal->getJournalDatas();

            $articles_item = array( 
                'id' => $id,
                'title' => $title,
                'views' => $views,
                'authors' => $author_array,
                'keywords' => $keywords_array,
                'publishedtime' => $publishedtime,
                'type' => $type,
                'oa' => $oa,
                'jid' => $jid,
                'journalNanme' => $journal->name
            );
            array_push($articles_arrays,$articles_item);
        }
        echo json_encode($articles_arrays);
    }
?>