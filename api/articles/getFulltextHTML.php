<?php

header('Content-Type: application/json');

//includes
include_once '../../config/Database.php';
include_once '../../models/articles/ArticlesFulltext.php';

$database = new Database();
$db = $database -> connect();

$articleFulltext = new ArticlesFulltext($db);
//$articleFulltext->articleID = isset($_GET['id']) ? $_GET['id'] : die();
$articleFulltext->articleID = 3; //Temporary for testing

$articleFulltext->get_article();

$articleFulltext_item = array(
    'id' => $articleFulltext->id,
    'articleID' => $articleFulltext->articleID,
    'content' => $articleFulltext->fullText,
    'fullTextPDFLink' => $articleFulltext->fullTextPDFLink,
    'sections' => $articleFulltext->sections
);

echo json_encode($articleFulltext_item);

// $file = file_get_contents('../../data/articlesFulltext/html/3.html');
// $content_array = array(
//     'id' => 1,
//     'content' => $file
// );
// echo json_encode($content_array);


?>