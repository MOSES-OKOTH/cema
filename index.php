<?php
    session_start();

    include __DIR__."/db/db.php";



    // Check if the user is already logged in
    if (!isset($_SESSION['userID']) || !isset($_SESSION['token'])) {
        header("Location: ./login/");

        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Health Information System">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Home :: HIS | CEMA</title>
</head>
<body>
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body{
            height: 100vh;
            width: 100vw;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #f4f4f4;
        }

        .container{
            display: flex;
            flex-direction: column;
            width: max-content;
            max-width: 75vw;
            height: max-content;
        }

        .home-header-container{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            padding: 1vw 2.5vw;
            background-color: #fff;
            border-radius: 10px 10px 0 0;
            border-bottom: 2px solid #f4f4f4;
        }

        .home-header{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2vw;
        }

        .home-header img{
            width: auto;
            height: 5vw;
        }

        .home-header p{
            font-family: 'Playfair Display', serif;
            font-size: 2.5vw;
            font-weight: 600;
            color: #333;
        }

        .home-content-container{
            display: flex;
            align-items: center;
            width: 100%;
            padding: 2vw 2.5vw;
            background-color: #fff;
        }

        .home-content{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 2vw;
            width: 100%;
        }

        .home-content a{
            text-decoration: none;
            padding: 1vw;
            border: 2px solid rgba(0,0,0,0.15);
            border-radius: 5px;
            text-align: center;
            color: black;
            width: 15vw;
        }

        .home-content a:hover{
            border: 2px solid rgba(0,0,0,0.4);
            transition: 200ms;
        }

        .home-content a i{
            font-size: 3.2vw;
            margin-bottom: 0.5vw;
            color: #f77f00;
        }

        .home-content a p{
            font-size: 0.9vw;
        }

        .home-footer{
            background: white;
            padding: 2vw 2.5vw;
            border-radius: 0 0 10px 10px;
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            border-top: 2px solid #f4f4f4;
        }

        .home-footer a{
            text-decoration: none;
            padding: 0.5vw 1vw;
            border: 2px solid red;
            color: red;
            font-size: 0.9vw;
        }

        .home-footer a:hover{
            background: rgba(255,0,0,0.05);
            transition: 200ms;
        }
    </style>


    <section class="container">
        <div class="home-header-container">
            <div class="home-header">
                <img src="./assets/cema-logo.png" alt="">
                <p>Health Information System</p>
            </div>
        </div>

        <div class="home-content-container">
            <div class="home-content">
                <a href="./addHealthProgram/">
                    <div class="home-content-card">
                        <i class="fa-solid fa-square-plus"></i>
                        <p>Add Health Program</p>
                    </div>
                </a>

                <a href="./registerPatient/">
                    <div class="home-content-card">
                        <i class="fa-solid fa-user-plus"></i>
                        <p>Register Patient</p>
                    </div>
                </a>

                <a href="./enrollPatient/">
                    <div class="home-content-card">
                        <i class="fa-solid fa-folder-plus"></i>
                        <p>Enroll Patient</p>
                    </div>
                </a>

                <a href="">
                    <div class="home-content-card">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <p>Search Patient</p>
                    </div>
                </a>

                <a href="./viewPatient/">
                    <div class="home-content-card">
                        <i class="fa-solid fa-user-doctor"></i>
                        <p>View Patient</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="home-footer">
            <a href="./logout/">Logout <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </section>

    <script>
        async function request(){
            const url = 'http://localhost/cema/api/viewPatient/';
            const options = {
                method: 'POST',
                headers: {
                    authorization: '<?php echo $_SESSION['userID'].":".$_SESSION['token']; ?>',
                    'content-type': 'application/json'
                },
                body: JSON.stringify({
                    id: id.value
                })
            };

            try {
                const response = await fetch(url, options);
                const data = await response.json();
                console.log(data);
            } catch (error) {
                console.error(error);
            }
        }
    </script>
</body>
</html>