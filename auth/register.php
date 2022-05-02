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

    $responseData = array();

    if ($data->mode === 'login') {
        if ($user->authenticateUser()) {
            $responseData['message'] = 'Login OK!';
        } else {
            $responseData['message'] = 'Login is not OK!';
        }
    } else if($data->mode === 'register') {
        if ($user->registerUser()) {
            $responseData['message'] = 'Register OK!';
        } else {
            $responseData['message'] = 'Register is not OK!';
        }
    } else {
        $responseData['message'] = 'There was a problem with the authenticating';
    }
    echo json_encode($responseData);
?>