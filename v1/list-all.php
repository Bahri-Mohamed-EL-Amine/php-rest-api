<?php
// including necessary files 

include_once('../classes/student.php');
include_once('../config/database.php');
// headers

header("Acces-Control-Allow-Origin: *"); // allow any domain or subdomain 
header("Content-type:application/json;charset = utf-8"); // json data
header("Acces-Control-Allow-Methods: GET"); // only post method
// database connection

$db =  new Database();
$connection = $db->connect();

// creating student
$student = new Student($connection);
$data = $student->read_all_data();
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if ($data->num_rows > 0) {
        $jsons = array();
        while ($row = $data->fetch_assoc()) {
                    $jsons[] = array(
                        "id" => $row["id"],
                        "name" => $row["name"],
                        "phone_number" => $row["phone_number"],
                        "email" => $row["email"],
                        "status" => $row["status"],
                        "created_at" => $row["created_at"],
                    );
        }



        http_response_code(200);
        echo  json_encode(array(
            "status" => 1,
            "data" => $jsons
        ));
    }
}
else{
    http_response_code(405);
    echo json_encode(array(
        "status" => 0,
        "message" => "method not allowed"
    ));
}
