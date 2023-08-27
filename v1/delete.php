<?php
    include_once('../classes/student.php');
    include_once('../config/database.php');




    header('Content-Type: application/json; charset=UTF-8');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods:GET');


    $database = new Database();
    $db = $database->connect();
    $student = new Student($db);

    if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        if(!empty($id)){
        $removed = $student->remove_student($id);
        if($removed){
            http_response_code(200);
            echo json_encode(array(
                "status" =>1,
                "message" =>"Student removed successfully"
            ));
        }
        else{
            http_response_code(404);
            echo json_encode(array(
                            "status" =>0,
                            "message" =>"No data found"
                        ));
        }
        
        }
        else{
        http_response_code(404);
            echo json_encode(array(
                'status' => 0,
                "message" =>"Id is required"
            ));
        }   
    } else {
    http_response_code(503);
    echo json_encode(array(
        "status" => 0,
        "message" => "method not allowed"
    ));
}
