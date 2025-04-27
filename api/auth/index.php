<?php
    // Including the Database File
    include __DIR__."/../../db/db.php";

    // Declaring the Headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=UTF-8");

    // Ensuring that the Request Method is POST
    if($_SERVER['REQUEST_METHOD'] != 'POST') {
        http_response_code(405);
        echo json_encode(array("error" => 1, "message" => "Method Not Allowed."));
        exit();
    }


    //Getting the Request Headers
    $headers = getallheaders();

    // Getting the Authorization Header
    if(isset($headers['Authorization']) || isset($headers['authorization'])) {
        $authHeader = isset($headers['Authorization']) ? $headers['Authorization'] : $headers['authorization'];

        // Getting the User ID and Token from the Authorization Header
        $authHeader = explode(":", $authHeader);

        define("USER_ID", htmlspecialchars($authHeader[0]));
        define("TOKEN", $authHeader[1]);

        // Checking if the User ID and Token are valid
        function validUser(){
            $checkingUserQuery = "SELECT id_number, token FROM users WHERE id_number = '".USER_ID."' AND token = '".TOKEN."'";

            $queryResults = mysqli_query(DB, $checkingUserQuery);

            if(!$queryResults){
                http_response_code(500);
                echo json_encode(array("error" => 1, "message" => "Internal Server Error"));
                exit();
            }

            if(mysqli_num_rows($queryResults) > 0){
                http_response_code(200);
                // echo json_encode(array("error" => 0, "message" => "Authorized"));
                return true; 
            } else {
                http_response_code(401);
                echo json_encode(array("error" => 1, "message" => "Invalid Token or User ID"));
                return false;
            }
        }

        // validUser();
    } else {
        http_response_code(401);
        echo json_encode(array("error" => 1, "message" => "Unauthorized. No token provided."));
        exit();
    }   
?>