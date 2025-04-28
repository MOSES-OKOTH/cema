<?php
    session_start();

    include __DIR__."/../db/db.php";



    // Check if the user is already logged in
    if (!isset($_SESSION['userID']) || !isset($_SESSION['token'])) {
        header("Location: ../login/");

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
    <title>View Patient Profile :: HIS | CEMA</title>
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
            /* height: 100vh; */
            width: 100vw;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #f4f4f4;
            padding: 5vh;
        }

        .container{
            display: flex;
            flex-direction: column;
            width: max-content;
            max-width: 75vw;
            height: auto;
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
        }

        .main-content h2{
            font-size: 1.5vw;
            font-weight: 600;
            color: #333;
            margin-bottom: 1vw;
            font-family: 'Playfair Display', serif;
            text-align: center;
            color: #264653;
        }

        .form-data{
            display: flex;
            flex-direction: row;
            gap: 0;
            width: 100%;
        }

        .form-data input{
            padding: 0.75vw 1.5vw;
            border: 2px solid rgba(0,0,0,0.25);
            border-radius: 5px;
            width: 70vw;
            margin-bottom: 5vh;
        }

        input::placeholder{
            font-size: 0.95vw;
        }

        .patient-data{
            display: none;
            flex-direction: row;
        }

        .part1{
            display: flex;
            padding: 0 2vw;
            flex-direction: column;
            align-items: center;
            border-right: 2px solid rgba(0,0,0,0.05);
        }

        .part1 img{
            width: 16vw;
            border-radius: 50%;
            margin-bottom: 2vw;
        }

        .part1 #name{
            font-size: 1.2vw;
            font-weight: 600;
        }

        .part1 #email {
            font-size: 1vw;
            font-weight: 300;
            color: rgba(0,0,0,0.75);
        }

        .part2{
            padding: 0 2vw;
            display: flex;
            flex-direction: column;
            gap: 1vw;
            position: relative;
            width: 100%;
        }

        

        .part2 .col h2{
            font-family: 'Poppins', serif;
            font-size: 1vw;
            font-weight: 400;
            margin: 0;
            text-align: left;
        }

        .part2 .col p{
            font-weight: 500;
            font-size: 1.1vw;
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

        table{
            border-collapse: collapse;
        }

        table tr{
            border-bottom: 1px solid rgba(0,0,0,0.15);
        }

        table tr:last-child{
            border: none;
        }

        table td{
            padding: 0.15vw 0.3vw;
        }

        #programs{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            gap: 0.55vw;
        }

        .program{
            font-size: 0.95vw;
            padding: 0.2vw 0.5vw;
            background: rgba(0,0,0,0.05);
            border-radius: 4px;
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
            <h2>View Patient Biodata</h2>

            <div class="form-data">
                <input type="search" name="" id="id" placeholder="Enter the Patient's National Identification Number and Press Enter">
            </div>

            <div class="patient-data">
                <div class="part1">
                    <img src="../assets/placeholder.png" alt="">
                    <p id="name">TEST USER</p>
                    <p id="email">test@mail.com</p>
                    <p id="phone1">07124342425</p>
                    <p id="phone2">01102039942</p>
                </div>

                <div class="part2">
                    <table>
                        <tr class="row">
                            <td class="col">
                                <h2>Gender</h2>
                                <p id="gender">Male</p>
                            </td>

                            <td class="col">
                                <h2>Date of Birth</h2>
                                <p id="dob">2002-02-01</p>
                            </td>

                            <td class="col">
                                <h2>Marital Status</h2>
                                <p id="marital_status">Single</p>
                            </td>
                        </tr>

                        <tr class="row">
                            <td class="col">
                                <h2>Deceased</h2>
                                <p id="deceased">0</p>
                            </td>

                            <td class="col">
                                <h2>Deceased Date and Time</h2>
                                <p id="deceased_date_time">NULL</p>
                            </td>

                            <td class="col">
                                <h2>Multiple Birth</h2>
                                <p id="multiple_birth">0</p>
                            </td>
                        </tr>

                        <tr class="row">
                            <td class="col">
                                <h2>Primary Phone Number</h2>
                                <p id="phone11">0712345678</p>
                            </td>

                            <td class="col">
                                <h2>Secondary Phone Number</h2>
                                <p id="phone22">0712345678</p>
                            </td>

                            <td class="col">
                                <h2>Email</h2>
                                <p id="email1">test@mail.com</p>
                            </td>
                        </tr>

                        <tr class="row">
                            <td class="col">
                                <h2>Nationality</h2>
                                <p id="nationality">Kenyan</p>
                            </td>


                            <td class="col">
                                <h2>Physical Address</h2>
                                <p id="physical_address">Nairobi</p>
                            </td>

                            <td class="col">
                                <h2>Permanent Address</h2>
                                <p id="permanent_address">Nairobi</p>
                            </td>
                        </tr>

                        <tr class="row">
                            <td class="col">
                                <h2>Next of Kin</h2>
                                <p id="kin_name">Kin Name</p>
                            </td>

                            <td class="col">
                                <h2>Relationship</h2>
                                <p id="relationship">Sibling</p>
                            </td>

                            <td class="col">
                                <h2>Kin Phone Number</h2>
                                <p id="kin_phone">0789123456</p>
                            </td>
                        </tr>

                        <tr class="row">
                            <td class="col">
                                <h2>Kin Email Address</h2>
                                <p id="kin_email">testkin@mail.com</p>
                            </td>

                            <td class="col">
                                <h2>Kin Physical Address</h2>
                                <p id="kin_physical_address">Kin Address</p>
                            </td>

                            <td class="col">
                                <h2>Kin Permanent Address</h2>
                                <p id="kin_permanent_address">Kin Address</p>
                            </td>
                        </tr>


                        <tr class="row">
                            <td class="col">
                                <h2>Created By</h2>
                                <p id="created_by">12345678</p>
                            </td>

                            <td class="col">
                                <h2>Registered On</h2>
                                <p id="created_at">2025-04-28</p>
                            </td>

                            <td class="col">
                                <h2>Enrolled Programs</h2>
                                <p id="programs">
                                    
                                </p>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
            
        </div>

        <div class="home-footer">
            <a href="../logout/">Logout <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </section>

    <script>
        let id = document.getElementById("id");
        
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
                
                if(data.error == '1'){
                    document.querySelector('.patient-data').style.display = 'none';
                    alert(data.message);
                } else{
                    if(data.id_number != ''){
                        document.querySelector('.patient-data').style.display = 'flex';

                        document.getElementById('name').textContent = data.full_name;
                        document.getElementById('email').textContent = data.email;
                        document.getElementById('phone1').textContent = data.phone_number1;
                        document.getElementById('phone2').textContent = data.phone_number2;

                        document.getElementById('gender').textContent = data.gender;
                        document.getElementById('dob').textContent = data.date_of_birth;
                        document.getElementById('marital_status').textContent = data.marital_status;
                        document.getElementById('deceased').textContent = data.deceased;
                        document.getElementById('deceased_date_time').textContent = data.deceased_date_time;
                        document.getElementById('multiple_birth').textContent = data.multiple_birth;
                        document.getElementById('phone11').textContent = data.phone_number1;
                        document.getElementById('phone22').textContent = data.phone_number2;
                        document.getElementById('email1').textContent = data.email;
                        document.getElementById('nationality').textContent = data.nationality;
                        document.getElementById('physical_address').textContent = data.physical_address;
                        document.getElementById('permanent_address').textContent = data.permanent_address;
                        document.getElementById('kin_name').textContent = data.next_of_kin_name;
                        document.getElementById('relationship').textContent = data.next_of_kin_relationship;
                        document.getElementById('kin_phone').textContent = data.next_of_kin_phone_number;
                        document.getElementById('kin_email').textContent = data.next_of_kin_email;
                        document.getElementById('kin_physical_address').textContent = data.next_of_kin_physical_address;
                        document.getElementById('kin_permanent_address').textContent = data.next_of_kin_permanent_address;
                        document.getElementById('created_by').textContent = data.created_by;
                        document.getElementById('created_at').textContent = data.created_at;

                        // Getting the Enrolled Programs as an array
                        let enrolledPrograms = data.programs;

                        enrolledPrograms.forEach(program =>{
                            document.getElementById('programs').innerHTML += "<spa class='program'>"+program+"</span>";
                        })

















                    }
                }
            } catch (error) {
                console.error(error);
            }
        }

        id.addEventListener('keydown', function(e){
            if(e.key == 'enter' || e.keyCode == 13){
                request();
            }
        })
    </script>
</body>
</html>