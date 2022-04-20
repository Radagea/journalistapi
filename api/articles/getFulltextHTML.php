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

$sections = explode(';',$articleFulltext->sections);
$sections_arr = array();

for ($i=0; $i < count($sections) - 1; $i++) { 
    $exploded = explode(':',$sections[$i]);
    $sections_element = array(
        'id' => $exploded[0],
        'name' => $exploded[1]
    );
    array_push($sections_arr,$sections_element);
}

$articleFulltext_item = array(
    'id' => $articleFulltext->id,
    'articleID' => $articleFulltext->articleID,
    'content' => $articleFulltext->fullText,
    'fullTextPDFLink' => $articleFulltext->fullTextPDFLink,
    'sections' => $sections_arr
);

echo json_encode($articleFulltext_item);

// $file = file_get_contents('../../data/articlesFulltext/html/3.html');
// $content_array = array(
//     'id' => 1,
//     'content' => $file
// );
// echo json_encode($content_array);


?>