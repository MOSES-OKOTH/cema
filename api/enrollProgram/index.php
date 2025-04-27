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
        // Checking if the request body is valid
        if(!isset($data['client_id']) || !isset($data['program_id'])){
            http_response_code(400);
            echo json_encode(array(
                "error" => 1,
                "message" => "Bad or Incomplete request body",
                "created" => "no"
            ));

            exit();
        }

        // Data from the request body
        $client_id = $data['client_id'];
        $program_id = $data['program_id'];

        // Other necessary data - Not from the request body
        $enrollment_date = date('Y-m-d H:i:s');
        $enrolled_by = USER_ID;


        // Checking if the program exists in the system
        $checkProgramSql = "SELECT program_id FROM programs WHERE program_id = '$program_id'";

        $checkProgramResult = mysqli_query(DB, $checkProgramSql);

        if(mysqli_num_rows($checkProgramResult) < 1){
            http_response_code(400);

            echo json_encode(array(
                "error" => 1,
                "message" => "Program does not exist!",
                "enrolled" => "no"
            ));

            exit();
        }


        // Checking if the client is already enrolled
        $checkSql = "SELECT client_id, program_id FROM client_programs WHERE client_id = '$client_id' AND program_id = '$program_id'";

        $checkResult = mysqli_query(DB, $checkSql);


        if(mysqli_num_rows($checkResult) > 0){
            echo json_encode(array(
                "error" => 1,
                "message" => "Client already enrolled in the program",
                "enrolled" => "no"
            ));

            exit();
        } else{
            // Enrolling the client into the program
            $enrollSql = "INSERT INTO client_programs (client_id, program_id, enrollment_date, enrolled_by) VALUES ('$client_id','$program_id','$enrollment_date','$enrolled_by')";

            $enrollResult = mysqli_query(DB, $enrollSql);

            if($enrollResult){
                http_response_code(200);
                echo json_encode(array(
                    "error" => 0,
                    "message" => "Enrolled Successfully!",
                    "enrolled" => "yes"
                ));

                return;
            } else{
                http_response_code(500);
                
                echo json_encode(array(
                    "error" => 1,
                    "message" => "An error occured during enrollment! Try again later",
                    "enrolled" => "no"
                ));

                exit();
            }
        }
    }
?>