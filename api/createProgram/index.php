<?php
    // Including the Database and Auth Files
    include __DIR__."/../auth/index.php";

    // Setting the Headers
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=UTF-8");

    // Getting the Raw Request Body
    $data = file_get_contents('php://input');

    $data = json_decode($data, true);
    

    if(validUser()){
        // Ensuring the request body is complete
        if(!isset($data['program_id']) || !isset($data['program_name']) || !isset($data['program_description'])){
            http_response_code(400);

            echo json_encode(array(
                "error" => 1,
                "message" => "Bad or Incomplete request body",
                "created" => "no"
            ));

            exit();
        }

        $program_id = htmlspecialchars($data['program_id']);
        $program_name = htmlspecialchars($data['program_name']);
        $program_description = htmlspecialchars($data['program_description']);


        // Checking if any field is left blank | empty
        if(empty($program_id) || empty($program_name) || empty($program_description)){
            http_response_code(400);
            
            echo json_encode(array(
                "error" => 1,
                "message" => "Bad or Incomplete request body",
                "created" => "no"
            ));

            exit();
        }
        

        // Check if the program already exists
        $searchQuery = "SELECT program_id FROM programs WHERE program_id = '$program_id'";

        $result = mysqli_query(DB, $searchQuery);

        if (mysqli_num_rows($result) > 0) {
            echo json_encode(array(
                "error" => 1,
                "message" => "Program already exists",
                "created" => "no"
            ));
        } else {
            // Insert the new program into the database
            $query = "INSERT INTO programs (program_id, program_name, program_description, created_by) VALUES ('$program_id', '$program_name', '$program_description', '".USER_ID."')";

            if (mysqli_query(DB, $query)) {
                echo json_encode(array(
                    "error" => 0, 
                    "message" => "Program created successfully", 
                    "created" => "yes"
                ));
                return;
            } else {
                http_response_code(500);
                echo json_encode(array("error" => 1, 
                    "message" => "Error creating program", 
                    "created" => "no"
                ));
                return;
            }
        }

    }
?>