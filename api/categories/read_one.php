<?php
    //Headers 
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    //Includes
    include_once '../../config/Database.php';
    include_once '../../models/Categories.php';

    $database = new Database();
    $db = $database -> connect();

    $category = new Categories($db);

    $category->id = isset($_GET['id']) ? $_GET['id'] : die();
    $category->read_one();

    $category_array = array();

    $category_item = array(
        'id' => $category->id,
        'name' => $category->name,
        'articleNumber' => $category->articleNumber
    );

    array_push($category_array,$category_item);

    echo json_encode($category_array);
?>