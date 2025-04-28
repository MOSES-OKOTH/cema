<?php
    session_start();

    include __DIR__."/../db/db.php";



    // Check if the user is already logged in
    if (!isset($_SESSION['userID']) || !isset($_SESSION['token'])) {
        header("Location: ../login/");

        exit();
    }

    // Getting the available health programs
    $getSql = "SELECT * FROM programs WHERE program_id != ''";

    $getResult = mysqli_query(DB, $getSql);

    if($getResult){
        $healthPrograms = mysqli_fetch_all($getResult);

        // print_r($healthPrograms);
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
    <title>Enroll to Health Program :: HIS | CEMA</title>
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


        .main-content{
            background: white;
            padding: 2vw 2.5vw;
            display: flex;
            flex-direction: column;
            gap: 2vw;
        }


        .main-content h2{
            text-align: center;
            color: #264653;
            font-family: 'Playfair Display', serif;
               font-size: 1.8vw;
        }

        .form-data{
            display: flex;
            flex-direction: column;
            gap: 0.75vw;
        }

        .form-data p{
            font-size: 1.05vw;
            color: black;
        }

        .input-group{
            display: flex;
            flex-direction: row;
            gap: 2vw;
            position: relative;
            width: 100%;
            margin-bottom: 2vw;
        }

        .input-group input{
            outline: none;
            padding: 0.75vw 1vw;
            border: 2px solid #rgba(0,0,0,0.25);
            width: 34vw;
        }

        .input-group select{
            outline: none;
            padding: 0.85vw 1vw;
            border: 2px solid #rgba(0,0,0,0.25);
            width: 34vw;
        }

        textarea{
            outline: none;
            width: 70vw;
            max-width: 70vw;
            min-width: 70vw;
            padding: 0.75vw 1vw;
            height: 6vw;
            border: 2px solid #rgba(0,0,0,0.25);
        }
        
        .submit{
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            width: 100%;
        }

        .submit button{
            padding: 0.5vw 1.25vw;
            background: none;
            border: 2px solid #264653;
            color: #264653;
            font-weight: 500;
            font-size: 0.95vw;
        }

        .submit button:hover{
            background: rgba(38, 70, 83, 0.1);
            transition: 200ms;
            cursor: pointer;
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

        #required{
            color: red;
            font-size: 0.8vw;
        }
    </style>


    <section class="container">
        <div class="home-header-container">
            <div class="home-header">
                <img src="../assets/cema-logo.png" alt="">
                <p>Health Information System</p>
            </div>
        </div>

        <div class="main-content">
            <h2>Enroll Patient to Health Program</h2>

            <div class="form-data">
                <div class="input-group">
                    <div>
                        <p>Patient Identification Number <span id="required">*</span></p>
                        <input type="text" id="client-id" placeholder="Enter Patient Identification Number" required>
                    </div>

                    <div>
                        <p>Health Program <span id="required">*</span></p>
                        <select name="" id="program-id">
                            <option value="">--- Select Health Program ---</option>
                            <?php foreach($healthPrograms as $program): ?>
                                <option value="<?=$program[0]; ?>"><?=$program[1]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="submit">
                    <button id="submit-btn">Enroll to Program <i class="fa-solid fa-long-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="home-footer">
            <a href="../logout/">Logout <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </section>

    <script>
        let submitBtn = document.getElementById("submit-btn");

        let programId = document.getElementById("program-id");
        let clientId = document.getElementById('client-id');

        submitBtn.addEventListener("click", function(e){
            e.preventDefault();

            if(programId.value == "" || clientId.value == ""){
                alert("Please fill in all the required fields!");
                return;
            }

            const url = 'http://localhost/cema/api/enrollProgram/';

            const options = {
                method: 'POST',
                headers: {
                    authorization: '<?php echo $_SESSION['userID'].":".$_SESSION['token']; ?>',
                    'content-type': 'application/json'
                },
                body: JSON.stringify({
                    client_id: clientId.value,
                    program_id: programId.value
                })
            };

            fetch(url, options)
            .then(response => response.json())
            .then(data => {
                console.log(data);

                if(data.error == "0" && data.enrolled == "yes"){
                    alert("Patient enrolled to the program successfully!");
                    window.location.reload();
                }else{
                    alert(data.message);
                    return;
                }
            })
            .catch(error => {
                console.error(error);
            });
        });
    </script>
</body>
</html>