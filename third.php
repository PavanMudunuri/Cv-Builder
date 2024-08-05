<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $skill1 = isset($_POST['skill1']) ? $_POST['skill1'] : '';
    $skill1_level = isset($_POST['skill1_level']) ? $_POST['skill1_level'] : '';
    $skill2 = isset($_POST['skill2']) ? $_POST['skill2'] : '';
    $skill2_level = isset($_POST['skill2_level']) ? $_POST['skill2_level'] : '';
    $skill3 = isset($_POST['skill3']) ? $_POST['skill3'] : '';
    $skill3_level = isset($_POST['skill3_level']) ? $_POST['skill3_level'] : '';
    $skill4 = isset($_POST['skill4']) ? $_POST['skill4'] : '';
    $skill4_level = isset($_POST['skill4_level']) ? $_POST['skill4_level'] : '';
    $AdditionalSkills = isset($_POST['AdditionalSkills']) ? $_POST['AdditionalSkills'] : '';

    if (!empty($skill1) && !empty($skill1_level) && !empty($skill2) && !empty($skill2_level) && !empty($skill3) && !empty($skill3_level) && !empty($skill4) && !empty($skill4_level) && !empty($AdditionalSkills)) {
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "test";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if (mysqli_connect_error()) {
            die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        } else {
            $INSERT = "INSERT INTO third (skill1, skill1_level, skill2, skill2_level, skill3, skill3_level, skill4, skill4_level, AdditionalSkills) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssssssss", $skill1, $skill1_level, $skill2, $skill2_level, $skill3, $skill3_level, $skill4, $skill4_level, $AdditionalSkills);
            $stmt->execute();

            $_SESSION['user_id'] = $conn->insert_id;
            header("Location:fourth.php");
            exit();
            
            $stmt->close();
            $conn->close();
        }
    } else {
        echo "All fields are required";
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skills Form</title>
    <style>
        body {
            background-color:rgb(245, 245, 245);
            margin: 0;
        }
        #skills {
            width: 800px;
            margin: 40px auto;
            border-radius: 60px;
        }
        #form1 {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            margin-left: 20px;
        }
        #form2 {
            flex: 2;
            margin-right: 10px;
            position: relative;
        }
        label {
            font-family: 'Times New Roman', Times, serif;
            font-size: 24px;
            font-style: italic;
        }
        #button {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        #continue {
            margin-left: auto;
            text-align: center;
            width: 140px;
            font-size: 30px;
            font-family: 'Times New Roman', Times, serif;
            border-radius: 10px;
            border: 5px solid rgb(235, 158, 15);
            background-color: rgb(235, 158, 15);
        }
        #continue:hover {
            background-color: coral;
        }
        #back {
            margin-right: auto;
            text-align: center;
            width: 140px;
            font-size: 30px;
            border-radius: 10px;
            border: 5px solid rgb(235, 158, 15);
            font-family: 'Times New Roman', Times, serif;
            background-color: rgb(235, 158, 15);
        }
        #back:hover {
            background-color: coral;
        }
        .error {
            color: rgb(0, 85, 255);
            font-size: 20px;
            margin-top: 6px;
        }
        .name {
            font-size: 20px;
            width: 350px;
            height: 45px;
            font-family: 'Times New Roman', Times, serif;
        }
        #form4 {
            text-align: center;
        }
        #new1 {
            background-color: rgb(235, 158, 15);
            height: 60px;
            padding: 5px;
        }
        #new2 {
            margin: 0;
            font-size: 40px;
            text-align: center;
            color: rgb(69, 68, 68);
            padding: 5px;
        }
        footer {
            background-color: rgb(251, 189, 4);
            padding: 10px;
            text-align: center;
            color: white;
        }
        #text {
            width: 600px;
            height: 50px;
            font-size: 16px;
        }
        @media (max-width: 768px) {
            body {
                overflow-x: hidden;
            }
            #new1,
            footer {
                width: 100%;
            }
            #skills {
                margin-right: 0;
            }
        }
        .center {
            font-size: 20px;
            max-width: 800px;
            font-style: italic;
            margin: 0 auto;
            text-align: left;
            padding-left: 20px;
        }
    </style>
</head>

<body id="body">
    <div id="new1">
        <h1 id="new2">Curriculum Vitae (CV)</h1>
    </div>
    <div class="center">
        <h1 style="margin-bottom: 10px">Now, let's know about your Skills</h1>
        <p>*Indicates required fields (Please use Capital Letters )</p>
    </div>
    <form id="form" method="post" action="third.php">
        <div id="skills">
            <div id="form1">
                <div id="form2">
                    <label for="skill1">Skill-1*(Give the Capitals)</label>
                    <input class="name" type="text" id="skill1" placeholder="Eg: HTML" name="skill1" required><br><br>
                    <select id="skill1_level" class="name" name="skill1_level" required>
                        <option value="SELECT">Select Level of Coding</option>
                        <option value="BEGINING">BEGINING</option>
                        <option value="MEDIUM">MEDIUM</option>
                        <option value="ADVANCED">ADVANCED</option>
                    </select>
                    <p id="Skill1" class="error"></p>
                </div>
            
                <div id="form2">
                    <label for="skill2">Skill-2*(Give the Capitals)</label>
                    <input class="name" type="text" id="skill2" placeholder="Eg: HTML" name="skill2" required><br><br>
                    <select id="skill2_level" class="name" name="skill2_level" required>
                        <option value="SELECT">Select Level of Coding</option>
                        <option value="BEGINING">BEGINING</option>
                        <option value="MEDIUM">MEDIUM</option>
                        <option value="ADVANCED">ADVANCED</option>
                    </select>
                    <p id="Skill2" class="error"></p>
                </div>
            </div>

            <div id="form1">
                <div id="form2">
                    <label for="skill3">Skill-3*(Give the Capitals)</label>
                    <input class="name" type="text" id="skill3" placeholder="Eg: HTML" name="skill3" required><br><br>
                    <select id="skill3_level" class="name" name="skill3_level" required>
                        <option value="SELECT">Select Level of Coding</option>
                        <option value="BEGINING">BEGINING</option>
                        <option value="MEDIUM">MEDIUM</option>
                        <option value="ADVANCED">ADVANCED</option>
                    </select>
                    <p id="Skill3" class="error"></p>
                </div>

                <div id="form2">
                    <label for="skill4">Skill-4*(Give the Capitals)</label>
                    <input class="name" type="text" id="skill4" placeholder="Eg: HTML" name="skill4" required><br><br>
                    <select id="skill4_level" class="name" name="skill4_level" required>
                        <option value="SELECT">Select Level of Coding</option>
                        <option value="BEGINING">BEGINING</option>
                        <option value="MEDIUM">MEDIUM</option>
                        <option value="ADVANCED">ADVANCED</option>
                    </select>
                    <p id="Skill4" class="error"></p>
                </div>
            </div>

            <div id="form4">
                <label for="AdditionalSkills">Additional Skills</label><br>
                <input style="width:600px" id="text" placeholder="Write any other skills you know (e.g., HTML, CSS, JavaScript...)" name="AdditionalSkills" required>
                <p id="Other" class="error"></p>
            </div>
            
            <div id="button">
                <button id="back" class="back" onclick="backfunction()">Back</button>
                <button class="continue" id="continue" onclick="myfunction(event)">Continue</button>
            </div>
        </div>
    </form>
    <p style="padding: 30px; font-size: 20px; font-style: italic;">All rights belong to Pavan. If you have any queries, you can contact or email him.</p>

    <footer>
        <h1>Author: Pavan</h1>
        &copy; All rights reserved<br>
        <a href="tel:+9999999999" style="color: white; text-decoration: none;">+99-99999-999</a><br>
        <a href="mailto:abc@gmail.com" style="color: white; text-decoration: none;">Gmail</a>
    </footer>
    <script>
    function myfunction(event) {
        event.preventDefault();

        const skill1 = document.getElementById("skill1").value.trim();
        const skill1_level = document.getElementById("skill1_level").value.trim();
        const skill2 = document.getElementById("skill2").value.trim();
        const skill2_level = document.getElementById("skill2_level").value.trim();
        const skill3 = document.getElementById("skill3").value.trim();
        const skill3_level = document.getElementById("skill3_level").value.trim();
        const skill4 = document.getElementById("skill4").value.trim();
        const skill4_level = document.getElementById("skill4_level").value.trim();
        const additionalSkills = document.getElementById("text").value.trim();

        const skillRegex = /^[A-Za-z\s,.-]+$/;
        const skill1Error = document.getElementById("Skill1");
        const skill2Error = document.getElementById("Skill2");
        const skill3Error = document.getElementById("Skill3");
        const skill4Error = document.getElementById("Skill4");
        const additionalSkillsError = document.getElementById("Other");

        let isValid = true;

        if (skill1 === "") {
            skill1Error.innerHTML = "Enter Skill-1";
            isValid = false;
        } else if (!skillRegex.test(skill1)) {
            skill1Error.innerHTML = "Enter only letters";
            isValid = false;
        } else {
            skill1Error.innerHTML = "";
        }

        if (skill2 === "") {
            skill2Error.innerHTML = "Enter Skill-2";
            isValid = false;
        } else if (!skillRegex.test(skill2)) {
            skill2Error.innerHTML = "Enter only letters";
            isValid = false;
        } else {
            skill2Error.innerHTML = "";
        }

        if (skill3 === "") {
            skill3Error.innerHTML = "Enter Skill-3";
            isValid = false;
        } else if (!skillRegex.test(skill3)) {
            skill3Error.innerHTML = "Enter only letters";
            isValid = false;
        } else {
            skill3Error.innerHTML = "";
        }

        if (skill4 === "") {
            skill4Error.innerHTML = "Enter Skill-4";
            isValid = false;
        } else if (!skillRegex.test(skill4)) {
            skill4Error.innerHTML = "Enter only letters";
            isValid = false;
        } else {
            skill4Error.innerHTML = "";
        }

        if (skill1_level === 'SELECT') {
            skill1Error.innerHTML = "Select the Skill-1 level";
            isValid = false;
        } else if (skill2_level === 'SELECT') {
            skill2Error.innerHTML = "Select the Skill-2 level";
            isValid = false;
        } else if (skill3_level === 'SELECT') {
            skill3Error.innerHTML = "Select the Skill-3 level";
            isValid = false;
        } else if (skill4_level === 'SELECT') {
            skill4Error.innerHTML = "Select the Skill-4 level";
            isValid = false;
        }

        if (additionalSkills === "") {
            additionalSkillsError.innerHTML = "Enter Additional Skills";
            isValid = false;
        } else {
            additionalSkillsError.innerHTML = "";
        }

        if (isValid) {
            document.getElementById("form").submit();
        }
    }

    function backfunction() {
        window.location.href = "second.php";
    }

    document.getElementById("continue").addEventListener("click", myfunction);
</script>

</body>
</html>
