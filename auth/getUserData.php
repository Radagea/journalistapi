<?php
    include './tokenAuthentication.php';

    /*
        tokenAuthentication file datas:
        HEADERS:
            - Content-Type: application/json
            - Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With
        TOKENIZER class:
            $tokenizer with the following datas:
            $tokenizer -> id : stands for the token id in database
            $tokenizer -> userId : stands for user id
            $tokenizer -> token : token itself
            $tokenizer -> expiresAt : the token expires Date
        Database class:
            $db : contains the database connection
    */

    include '../models/User.php';

    $user = new User($db);
    $user -> id = $tokenizer->userId;
    $responseData = array();

    if ($user->getUserById()) {
        $responseData['message'] = 'Ok!';
        $responseData['email'] = $user->email;
        $responseData['firstName'] = $user->firstName;
        $responseData['lastName'] = $user->lastName;
    } else {
        $responseData['message'] = 'Auth problem';
    }

    echo json_encode($responseData);

?>