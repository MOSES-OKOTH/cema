<?php
    session_start();

    include_once __DIR__."/../db/db.php";

    // Check if the user is already logged in
    if (isset($_SESSION['userID']) && isset($_SESSION['token'])) {
        session_destroy();
        exit();
    }

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = htmlspecialchars($_POST['id']);
        $password = $_POST['password'];

        // Validate user credentials
        $checkUserResults = mysqli_query(DB, "SELECT * FROM users WHERE id_number = '$id'");

        if(mysqli_num_rows($checkUserResults) > 0) {
            $user = mysqli_fetch_assoc($checkUserResults);
            $hashedPassword = $user['passkey'];

            if (password_verify($password, $hashedPassword)) {
                // Generate a token and store it in the session
                $_SESSION['userID'] = $id;
                $_SESSION['token'] = bin2hex(random_bytes(16)); // Generate a random token

                $tokenUpdateResult = mysqli_query(DB, "UPDATE users SET token = '{$_SESSION['token']}' WHERE id_number = '$id'");
                if (!$tokenUpdateResult) {
                    echo "<script>alert('Error updating token. Please try again.');</script>";
                    exit();
                }

                // Redirect to the dashboard or home page
                header("Location: ../index.php");
                exit();
            } else {
                echo "<script>alert('Invalid username or password');</script>";
            }
        } else {
            echo "<script>alert('User ID not found. Please try again.');</script>";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Health Information System">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Login :: HIS | CEMA</title>
</head>
<body>
    <style>
        * {
            margin: 0;
            padding: 0;
            font-size: 1rem;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f4f4f4;
        }

        .login-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2.35rem;
        }

        .input {
            margin-bottom: 15px;
        }

        .input p {
            margin-bottom: 5px;
        }

        .input input {
            width: 100%;
            min-width: 300px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px;
            font-family: 'Playfair Display', serif;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .login {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login h1 {
            text-align: center;
            font-family: 'Playfair Display', serif;
            margin-bottom: 20px;
        }

        .input {
            margin-bottom: 15px;
        }

        .input p {
            margin-bottom: 5px;
        }

        .input input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>

    <div class="login-container">
        <div class="login">
            <img src="../assets/cema-logo.png" alt="">
            <h1>Login</h1>

            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="input">
                    <p>User ID</p>
                    <input type="text" name="id" id="id" placeholder="User Identification Number" required>
                </div>

                <div class="input">
                    <p>Password</p>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>

                <button type="submit">Login <i class="fa-solid fa-long-arrow-right"></i></button>
            </form>
        </div>
    </div>
</body>
</html>