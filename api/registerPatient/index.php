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
        // Checking if all the required fields are sent in the request body
        if(!isset($data['id']) || !isset($data['name']) || !isset($data['gender']) || !isset($data['dob']) || !isset($data['marital_status']) || !isset($data['multiple_birth']) || !isset($data['phone1']) || !isset($data['phone2']) || !isset($data['email']) || !isset($data['nationality']) || !isset($data['physical_address']) || !isset($data['permanent_address']) || !isset($data['photo_url'])  || !isset($data['kin_name']) || !isset($data['kin_relationship']) || !isset($data['kin_phone_number']) || !isset($data['kin_email']) || !isset($data['kin_physical_address']) || !isset($data['kin_permanent_address'])){
            http_response_code(400);
            echo json_encode(array(
                "error" => 1,
                "message" => "Bad or Incomplete request body",
                "registered" => "no"
            ));

            exit();
        }



        // Getting the Client | Patient Details
        $id = htmlspecialchars($data['id']);
        $name = htmlspecialchars($data['name']);
        $gender = htmlspecialchars($data['gender']);
        $date_of_birth = $data['dob'];
        $marital_status = htmlspecialchars($data['marital_status']);
        $multiple_birth = $data['multiple_birth'];
        $phone_number1 = htmlspecialchars($data['phone1']);
        $phone_number2 = htmlspecialchars($data['phone2']);
        $email = $data['email'];
        $nationality = htmlspecialchars($data['nationality']);
        $physical_address = $data['physical_address'];
        $permanent_address = $data['permanent_address'];
        $photo_url = $data['photo_url'];
        $next_of_kin_name = $data['kin_name'];
        $next_of_kin_relationship = $data['kin_relationship'];
        $next_of_kin_phone_number = $data['kin_phone_number'];
        $next_of_kin_email = $data['kin_email'];
        $next_of_kin_physical_address = $data['kin_physical_address'];
        $next_of_kin_permanent_address = $data['kin_permanent_address'];

        // Not necessarily provided in the request body
        $created_at = date('Y-m-d H:i:s');
        $created_by = USER_ID;


        // ENsuring key details are not left blank
        if(empty($id) || empty($name) || empty($gender) || empty($phone_number1) || empty($nationality) || empty($created_at)){
            http_response_code(400);
            echo json_encode(array(
                "error" => 1,
                "message" => "Bad Request",
                "registered" => "no"
            ));

            exit();
        }

        

        // Checking if the Patient already exists
        $checkSql = "SELECT * FROM clients WHERE id_number = '$id'";

        $checkResult = mysqli_query(DB, $checkSql);

        if(mysqli_num_rows($checkResult) > 0){
            echo json_encode(array(
                "error" => 1,
                "message" => "Patient already exists",
                "registered" => "no"
            ));

            exit();
        } else{
            // SQL Statement to Insert the Patient Details
            $insertSql = "INSERT INTO clients (id_number, full_name, gender, date_of_birth, deceased, decease_date_time, marital_status, multiple_birth, phone_number1, phone_number2, email, nationality, physical_address, permanent_address, photo_url, next_of_kin_name, next_of_kin_relationship, next_of_kin_phone_number, next_of_kin_email, next_of_kin_physical_address, next_of_kin_permanent_address, created_at, created_by) VALUES ('$id', '$name', '$gender', '$date_of_birth', 0, NULL, '$marital_status', '$multiple_birth', '$phone_number1', '$phone_number2', '$email', '$nationality', '$physical_address', '$permanent_address', '$photo_url', '$next_of_kin_name', '$next_of_kin_relationship', '$next_of_kin_phone_number', '$next_of_kin_email', '$next_of_kin_physical_address', '$next_of_kin_permanent_address', '$created_at', '$created_by')";


            if(mysqli_query(DB, $insertSql)){
                http_response_code(200);
                echo json_encode(array(
                    "error" => 0,
                    "message" => "Patient registered successfully!",
                    "registered" => "yes"
                ));
                return;
            } else{
                http_response_code(500);
                echo json_encode(array(
                    "error" => 1,
                    "message" => "Error registering patient!",
                    "registered" => "no"
                ));
                return;
            }
        }

    }
?>