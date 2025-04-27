<?php
    session_start();

    session_destroy(); // Destroy the session to log out the user
    
    header("Location: ../login/"); // Redirect to the home page - which will eventually redirect to login page
    exit();
?>