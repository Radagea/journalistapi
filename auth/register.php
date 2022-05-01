<?php
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../config/Database.php';
    include_once '../models/User.php';

    //DB connect init 

    $database = new Database();
    $db = $database->connect();

    $user = new User($db);

    $data = json_decode(file_get_contents("php://input"));

    $user->email = $data->email;
    $user->password = $data->password;

    if ($data->mode === 'login') {
        if ($user->authenticateUser()) {
            echo json_encode(array('message' => 'Login OK!'));
        } else {
            echo json_encode(array('message' => 'Login is not OK!'));
        }
    } else if($data->mode === 'register') {
        if ($user->registerUser()) {
            echo json_encode(array('message' => 'Register OK!'));
        } else {
            echo json_encode(array('message' => 'Register is not OK!'));
        }
    } else {
        echo json_encode(array('message' => 'There was a problem with the authenticating'));
    }
?>