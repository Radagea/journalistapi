<?php
    header('Content-Type: application/json');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
    
    include_once '../config/Database.php';
    include_once './tokenizer.php';
    include_once '../class/MyError.php';

    $database = new Database();
    $db = $database->connect();

    $tokenizer = new Tokenizer($db);

    try {
        //Check there is token in the GET field
        if (isset($_GET['token'])) {
            $tokenizer->token = $_GET['token'];
        } else {
            throw new MyError("Token is missing!");
        }
    
        //Check the token is valid
        if (!($tokenizer->getUserId())) {
            throw new MyError("Not authenticated");
        } 
    } catch (MyError $e) {
        echo json_encode($e->getError());
        die();
    }
    
    
?>