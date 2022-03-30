<?php
    //Headers 
    
    header('Content-Type: application/json');

    //Includes for the neccessary configs/datamodels 
    include_once '../../config/Database.php';
    include_once '../../models/Categories.php';

    //-----------------------------------
    $database = new Database();
    $db = $database->connect();

    $categories = new Categories($db);

    if (isset($_GET["limit"])) {
        $limit = $_GET["limit"];
    } else {
        $limit = 0;
    }

    $result = $categories -> read($limit);
    $num = $result -> rowCount();


    if ($num > 0) {
        $category_array = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $category_item = array(
                'id' => $id,
                'name' => $name,
                'articleNumber' => $articleNumber
            );
            array_push($category_array,$category_item);
        }

        echo json_encode($category_array);
    }
?>