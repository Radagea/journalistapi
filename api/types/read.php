<?php
    //Headers
    //....
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/Types.php';

    //-----Start
    $database = new Database();
    $db = $database->connect();

    $types = new Types($db);

    $result = $types ->read();
    $num = $result -> rowCount();

    if ($num > 0) {
        $type_array = array();

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $type_item = array(
                'id' => $id,
                'name' => $name
            );
            array_push($type_array,$type_item);
        }

        echo json_encode($type_array);
    }
?>