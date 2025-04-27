<?php 
    // Initiating a Database Connection
    $host = 'localhost'; // Replace this with your database host - esp when hosting the service online
    $username = 'root'; // Change this to your database username
    $password = ''; // Change this to your database password
    $database = 'cema';


    try{
        define("DB", mysqli_connect($host, $username, $password, $database));
    } catch(Exception $e){
        http_response_code(500);
        echo json_encode(array("error" => 1, "message" => "Database Connection Failed"));
    }
    

?>