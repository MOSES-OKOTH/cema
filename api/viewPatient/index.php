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
        //Checking if the request body is complete
        if(!isset($data['id'])){
            http_response_code(400);
            echo json_encode(array(
                "error" => 1,
                "message" => "Bad or Incomplete request body",
                "created" => "no"
            ));

            exit();
        }

        // Declaring the Client ID variable
        $id = htmlspecialchars($data['id']);

        // Getting the Patient | Client Data
        $searchSql = "SELECT * FROM clients WHERE id_number = '$id'";

        $searchResult = mysqli_query(DB, $searchSql);

        // Getting the enrolled programs
        $getEnrollmentSql = "SELECT program_id FROM client_programs WHERE client_id = '$id'";

        $getEnrollmentResults = mysqli_query(DB, $getEnrollmentSql);

        if($searchResult && $getEnrollmentResults){
            if(mysqli_num_rows($searchResult) > 0){
                $enrollmentData = mysqli_fetch_all($getEnrollmentResults);

                $patientData = mysqli_fetch_assoc($searchResult);

                $patientData['programs'] = $enrollmentData;

                

                echo json_encode($patientData);
            } else{
                http_response_code(200);
                echo json_encode(array(
                    "error" => 1,
                    "message" => "Patient not found!",
                    "found" => "no"
                ));
            }
        } else{
            http_response_code(500);
            echo json_encode(array(
                "error" => 1,
                "message" => "Internal Server Error",
                "found" => "no"
            ));
        }
    }
?>