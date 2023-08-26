<?php
// including necessary files 

include_once('../classes/student.php');
include_once('../config/database.php');
// headers

header("Acces-Control-Allow-Origin: *"); // allow any domain or subdomain 
header("Content-type:application/json;charset = utf-8"); // json data
header("Acces-Control-Allow-Methods: POST"); // only post method
// database connection

$db =  new Database();
$connection = $db->connect();

// creating student
$student = new Student($connection);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // decoding data 

    $data = json_decode(file_get_contents("php://input"));
    // inserting data into  database
    if (!empty($data->name) && !empty($data->email) && !empty($data->phone_number)) {
        $student->name = $data->name;
        $student->email = $data->email;
        $student->phone_number = $data->phone_number;
        if ($student->create_data()) {
            http_response_code(200); // ok
            echo json_encode(
                array(
                    "status" => 1,
                    "message" => "Student created successfully"
                )
            );
        } else {
            http_response_code(500); // internal server error
            echo json_encode(
                array(
                    "status" => 0,
                    "message" => "Student not created",
                )
            );
        }
    }
    else{
        http_response_code(404); // page not found
        echo json_encode(
            array(
                "status" => 0,
                "message" => "All values are required",
            )
        );
    }
} else {
    http_response_code(503); // service unavailable
    echo json_encode(
        array(
            "status" => 0,
            "message" => "Access Denied",
        )
    );
}
