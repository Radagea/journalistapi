<?php
    include_once '../config/Database.php';
    include_once './tokenizer.php';

    //db connect init
    $database = new Database();
    $db = $database->connect();

    $tokenizer = new Tokenizer($db);

    $tokenizer->generateToken(md5("Lgt9G32L"));
    
?>