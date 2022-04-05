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
    $db = $database -> connect();

    $article = new Articles($db);

    $article->id = isset($_GET['id']) ? $_GET['id'] : die();
    $article->read_one();

    //Assistant querry settings:
    //Get Journal Name:
    $journal = new Journals($db);
    $journal->id = $article->journalid;
    $journal->getJournalName();
    //Get Authors
    $author_array = getAuthors($article->id,$db);
    //Get keywords 
    $keywords_array = getKeywords($article->id,$db);

    $article_item = array(
        'id' => $article->id,
        'title' => $article->title,
        'abstract' => $article->views,
        'authors' => $author_array,
        'keywords' => $keywords_array,
        'publishedtime' => $article->publishedtime,
        'type' => $article->type,
        'oa' => $article->oa,
        'journalid' => $article->journalid,
        'journalName' => $journal->name,
    );

    echo json_encode($article_item);
?>