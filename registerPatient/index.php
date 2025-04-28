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
    <title>Add Health Program :: HIS | CEMA</title>
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
        }

        .input-group input, .input-group select{
            outline: none;
            padding: 0.75vw 1vw;
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
            <h2>Patient Registration Form</h2>

            <div class="form-data">
                <div class="input-group">
                    <div>
                        <p>National Identification Number <span id="required">*</span></p>
                        <input type="text" id="id" placeholder="Enter National Identification Number" required>
                    </div>

                    <div>
                        <p>Full Name <span id="required">*</span></p>
                        <input type="text" name="name" id="name" placeholder="Enter Patient's Full Name" required>
                    </div>
                </div>

                <div class="input-group">
                    <div>
                        <p>Gender <span id="required">*</span></p>
                        <select name="gender" id="gender">
                            <option value="">--- Select Patient's Gender ---</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                    </div>

                    <div>
                        <p>Date of Birth </p>
                        <input type="date" name="dob" id="dob" placeholder="Enter Patient's Date of Birth" required>
                    </div>
                </div>

                <div class="input-group">
                    <div>
                        <p>Marital Status <span id="required">*</span></p>
                        <select name="marital-status" id="marital_status">
                            <option value="">--- Select Marital Status ---</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>

                    <div>
                        <p>Multiple Birth? </p>
                        <select name="multiple-birth" id="multiple_birth">
                            <option value="0">No<option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                </div>

                <div class="input-group">
                    <div>
                        <p>Phone Number 1 <span id="required">*</span></p>
                        <input type="text" name="phone1" id="phone1" placeholder="Enter Patient's Primary Phone Number" required>
                    </div>

                    <div>
                        <p>Phone Number 2 </p>
                        <input type="text" name="phone2" id="phone2" placeholder="Enter Patient's Secondary Phone Number">
                    </div>
                </div>

                <div class="input-group">
                    <div>
                        <p>Email Address</p>
                        <input type="text" id="email" placeholder="Enter Patient's Email Address" required>
                    </div>

                    <div>
                        <p>Nationality <span id="required">*</span></p>
                        <select name="nationality" id="nationality">
                            <option value="Kenyan">Kenyan</option>
                        </select>
                    </div>
                </div>

                <div class="input-group">
                    <div>
                        <p>Physical Address </p>
                        <input type="text" id="physical_address" placeholder="Enter Patient's Physical Address" required>
                    </div>

                    <div>
                        <p>Permanent Address </p>
                        <input type="text" id="permanent_address" placeholder="Enter Patient's Permanent Address" required>
                    </div>
                </div>

                <div class="input-group">
                    <div>
                        <p>Next of Kin </p>
                        <input type="text" id="kin_name" placeholder="Enter the Next of Kin" required>
                    </div>

                    <div>
                        <p> Relationship with Patient </p>
                        <select name="" id="kin_relationship">
                            <option value="">--- Select Relationship ---</option>
                            <option value="parent">Parent (Father | Mother)</option>
                            <option value="sibling">Sibling (Brother | Sister | Step Brother | Step Sister)</option>
                            <option value="guardian">Guardian</option>
                            <option value="others">Others</option>
                        </select>
                    </div>
                </div>

                <div class="input-group">
                    <div>
                        <p> Kin Phone Number</p>
                        <input type="text" id="kin_phone_number" placeholder="Enter Kin's Phone Number" required>
                    </div>

                    <div>
                        <p> Kin Email Address</p>
                        <input type="text" id="kin_email" placeholder="Enter Kin's Email Address" required>
                    </div>
                </div>

                <div class="input-group">
                    <div>
                        <p>Kin Physical Address</p>
                        <input type="text" id="kin_physical_address" placeholder="Enter Kin's Physical Address" required>
                    </div>

                    <div>
                        <p>Kin Permanent Address</p>
                        <input type="text" id="kin_permanent_address" placeholder="Enter Kin's Permanent Address" required>
                    </div>
                </div>

                

                <div class="submit">
                    <button id="submit-btn">Register Patient <i class="fa-solid fa-long-arrow-right"></i></button>
                </div>
            </div>
        </div>

        <div class="home-footer">
            <a href="../logout/">Logout <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </section>

    <script>
        let submitBtn = document.getElementById("submit-btn");


        let id = document.getElementById("id");
        let name = document.getElementById("name");
        let gender = document.getElementById("gender");
        let dob = document.getElementById("dob");
        let marital_status = document.getElementById("marital_status");
        let multiple_birth = document.getElementById("multiple_birth");
        let phone1 = document.getElementById("phone1");
        let phone2 = document.getElementById("phone2");
        let email = document.getElementById("email");
        let nationality = document.getElementById("nationality");
        let physical_address = document.getElementById("physical_address");
        let permanent_address = document.getElementById("permanent_address");
        let kin_name = document.getElementById("kin_name");
        let kin_relationship = document.getElementById("kin_relationship");
        let kin_phone_number = document.getElementById("kin_phone_number");
        let kin_email = document.getElementById("kin_email");
        let kin_physical_address = document.getElementById("kin_physical_address");
        let kin_permanent_address = document.getElementById("kin_permanent_address");
        let photoUrl = "";



        name.addEventListener("input", function(){
            name.value = name.value.toUpperCase();
        });

        submitBtn.addEventListener("click", function(e){
            e.preventDefault();

            if(id.value == "" || name.value == "" || gender.value == ""){
                alert("Please fill in all the required fields!");
                return;
            }

            const url = 'http://localhost/cema/api/registerPatient/';

            const options = {
                method: 'POST',
                headers: {
                    authorization: '<?php echo $_SESSION['userID'].":".$_SESSION['token']; ?>',
                    'content-type': 'application/json'
                },
                body: JSON.stringify({
                    id: id.value,
                    name: name.value,
                    gender: gender.value,
                    dob: dob.value,
                    marital_status: marital_status.value,
                    multiple_birth: multiple_birth.value,
                    phone1: phone1.value,
                    phone2: phone2.value,
                    email: email.value,
                    nationality: nationality.value,
                    physical_address: physical_address.value,
                    permanent_address: permanent_address.value,
                    photo_url: "",
                    kin_name: kin_name.value,
                    kin_relationship: kin_relationship.value,
                    kin_phone_number: kin_phone_number.value,
                    kin_email: kin_email.value,
                    kin_physical_address: kin_physical_address.value,
                    kin_permanent_address: kin_permanent_address.value,
                })
            };
            

            fetch(url, options)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if(data.error == "0" && data.registered == "yes"){
                    alert("Patient registered successfully!");
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