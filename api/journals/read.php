<?php
    //Headers

    header('Content-Type: application/json');

    //Includes...

    include_once '../../config/Database.php';
    include_once '../../models/Journals.php';

    $database = new Database();
    $db = $database->connect();

    $journals = new Journals($db);

    if (isset($_GET["limit"])) {
        $limit = $_GET["limit"];
    } else {
        $limit = 0;
    }

    $result = $journals->read($limit);
    $num = $result -> rowCount();

    if ($num > 0) {
        $journals_array = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $journal = array(
                'id' => $id,
                'name' => $name
            );
            array_push($journals_array,$journal);
        }
        echo json_encode($journals_array);
    }
?>