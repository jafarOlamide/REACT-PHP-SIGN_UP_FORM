<?php

include_once("database.php");
include_once("user.php");


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$database = new Database();

$db = $database->getConnection();

$new_user = new User($db);

$_POST = json_decode(file_get_contents("php://input"), true);
$data= $_POST['user_data'];

//DEBUGGING 
// if ($data = json_decode(file_get_contents("php://input"), true)) {
//     echo json_encode(array("message" =>$data->user_name));
// } else{
//     echo json_encode(array("message" =>"error"));
// }

// if (!empty($data['user_name'])) {
//     echo json_encode( $data);
// } else{
//     echo json_encode(array("message" => "Incomplete Data")); 
// }


if (!empty($data['user_name']) && !empty($data['user_email'])) {

    $new_user->user_name = $data['user_name'];
    $new_user->user_email = $data['user_email'];
    $new_user->user_password = $data['user_password'];

    if ($new_user->add_user()) {
        // set response code - 201 created
        http_response_code(201);

        //return a message
        echo json_encode(array("message" => "New user added successfully"));
    } else{

        http_response_code(503);

        //return a message
        echo json_encode(array("message" => "Unable to add User"));
    }
} else{
    //// set response code - 400 bad request
    http_response_code(400);

        //return a message
        echo json_encode(array("message" => "Incomplete Data"));   
        //echo json_encode(array($data));
}

?>