<?php
    //Headers 
    
    header('Content-Type: application/json');

    //includes
    include_once '../../config/Database.php';
    include_once '../../models/Journals.php';

    $datbase = new Database();
    $db = $datbase -> connect();

    $journal = new Journals($db);

    $journal->id = isset($_GET['id']) ? $_GET['id'] : die();
    $journal->getJournalDatas();

    $journal_item = array(
        'id' => $journal->id,
        'name' => $journal->name,
        'language' => $journal->language,
        'shortDesc' => $journal->shortDesc,
        'lastArticle' => $journal->lastArticle,
        'startDate' => $journal->startDate,
        'imgUrl' => $journal->imgUrl,
        'articleNumber' => $journal->articleNumber
    );

    echo json_encode($journal_item);
?>