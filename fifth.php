<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $hobbie1 = isset($_POST['hobbie1']) ? ($_POST['hobbie1']) : '';
    $hobbie2 = isset($_POST['hobbie2']) ? ($_POST['hobbie2']) : '';
    $hobbie3 = isset($_POST['hobbie3']) ? ($_POST['hobbie3']) : '';
    $hobbie4 = isset($_POST['hobbie4']) ? ($_POST['hobbie4']) : '';
    $language1 = isset($_POST['language1']) ? ($_POST['language1']) : '';
    $language2 = isset($_POST['language2']) ? ($_POST['language2']) : '';
    $language3 = isset($_POST['language3']) ? ($_POST['language3']) : '';
    $language4 = isset($_POST['language4']) ? ($_POST['language4']) : '';

    if (!empty($hobbie1) && !empty($hobbie2) && !empty($hobbie3) && !empty($hobbie4) &&
        !empty($language1) && !empty($language2) && !empty($language3) && !empty($language4)) {
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "test";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $INSERT = "INSERT INTO fifth (hobbie1, hobbie2, hobbie3, hobbie4, language1, language2, language3, language4) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ssssssss", $hobbie1, $hobbie2, $hobbie3, $hobbie4, $language1, $language2, $language3, $language4);
            
            if ($stmt->execute()) {
                $_SESSION['user_id'] = $conn->insert_id;
                header("Location:submit.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

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
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hobbies and Languages</title>
    <style>
        body {
            background-color: rgb(245, 245, 245);
            margin: 0;
        }
        #Hobbies {
            width: 800px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 40px;
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
            font-family: 'Times New Roman', Times, serif black;
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
            font-family: 'Times New Roman', Times, serif;
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
            width: 400px;
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
        <h1 style=" margin-bottom: 10px">Now, let's know about your Hobbies and Languages</h1>
        <p>*Indicates required fields (Please use Capital Letters at the Beginning)</p>
    </div>
    <form id="form" method="post" action="fifth.php">
        <div id="Hobbies">
            <div id="form1">
                <div id="form2">
                    <label for="Hobbie1:">Hobbie-1*</label>
                    <input class="name" type="text" id="hobbie1" placeholder="Eg:cricket" name="hobbie1" required><br><br>
                    <p id="Hobbie1" class="error"></p>
                </div>
            
                <div id="form2">
                    <label for="Hobbie2">Hobbie-2*</label>
                    <input class="name" type="text" id="hobbie2" placeholder="Eg:Reading Books" name="hobbie2" required><br><br>
                    <p id="Hobbie2" class="error"></p>
                </div>
            </div>

            <div id="form1">
                <div id="form2">
                    <label for="Hobbie3">Hobbie-3*</label>
                    <input class="name" type="text" id="hobbie3" placeholder="Eg:Swimming" name="hobbie3" required><br><br>
                    <p id="Hobbie3" class="error"></p>
                </div>

                <div id="form2">
                    <label for="Hobbie4">Hobbie-4*</label>
                    <input class="name" type="text" id="hobbie4" placeholder="Eg:movies" name="hobbie4" required><br><br>
                    <p id="Hobbie4" class="error"></p>
                </div>
            </div>
            
            <div class="center">
                <h2>Speaking Languages</h2>
            </div>
            <div id="form1">
                <div id="form2">
                    <label for="language1:">Language-1*</label>
                    <input class="name" type="text" id="language1" placeholder="Eg:English" name="language1" required><br><br>
                    <p id="Language1" class="error"></p>
                </div>
            
                <div id="form2">
                    <label for="language2">Language-2*</label>
                    <input class="name" type="text" id="language2" placeholder="Eg:Hindi" name="language2" required><br><br>
                    <p id="Language2" class="error"></p>
                </div>
            </div>

            <div id="form1">
                <div id="form2">
                    <label for="language3">Language-3*</label>
                    <input class="name" type="text" id="language3" placeholder="Eg:French" name="language3" required><br><br>
                    <p id="Language3" class="error"></p>
                </div>

                <div id="form2">
                    <label for="language4">Language-4*</label>
                    <input class="name" type="text" id="language4" placeholder="Eg:Japanese" name="language4" required><br><br>
                    <p id="Language4" class="error"></p>
                </div>
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

        let valid = true;
        const hobbie1 = document.getElementById("hobbie1").value.trim();
        const hobbie2 = document.getElementById("hobbie2").value.trim();
        const hobbie3 = document.getElementById("hobbie3").value.trim();
        const hobbie4 = document.getElementById("hobbie4").value.trim();
        const language1 = document.getElementById("language1").value.trim();
        const language2 = document.getElementById("language2").value.trim();
        const language3 = document.getElementById("language3").value.trim();
        const language4 = document.getElementById("language4").value.trim();

        const Hobbie1 = document.getElementById("Hobbie1");
        const Hobbie2 = document.getElementById("Hobbie2");
        const Hobbie3 = document.getElementById("Hobbie3");
        const Hobbie4 = document.getElementById("Hobbie4");
        const Language1 = document.getElementById("Language1");
        const Language2 = document.getElementById("Language2");
        const Language3 = document.getElementById("Language3");
        const Language4 = document.getElementById("Language4");

        const hobbieRegex = /^[A-Za-z\s,.-]+$/;
        const languageRegex = /^[A-Za-z\s,.-]+$/;

        if (hobbie1 === "") {
            Hobbie1.innerHTML = "Enter the Hobbie you Have";
            return;
        } else if (!hobbieRegex.test(hobbie1)) {
            Hobbie1.innerHTML = "Enter only Letters";
            return;
        }
        Hobbie1.innerHTML = "";

        if (hobbie2 === '') {
            Hobbie2.innerHTML = "Enter the Hobbie you Have";
            return;
        } else if (!hobbieRegex.test(hobbie2)) {
            Hobbie2.innerHTML = "Enter only Letters";
            return;
        }
        Hobbie2.innerHTML = "";

        if (hobbie3 === '') {
            Hobbie3.innerHTML = "Enter the Hobbie you Have";
            return;
        } else if (!hobbieRegex.test(hobbie3)) {
            Hobbie3.innerHTML = "Enter only Letters";
            return;
        }
        Hobbie3.innerHTML = "";

        if (hobbie4 === '') {
            Hobbie4.innerHTML = "Enter the Hobbie you Have";
            return;
        } else if (!hobbieRegex.test(hobbie4)) {
            Hobbie4.innerHTML = "Enter only Letters";
            return;
        }
        Hobbie4.innerHTML = "";

        if (language1 === "") {
            Language1.innerHTML = "Enter the Language you Know";
            return;
        } else if (!languageRegex.test(language1)) {
            Language1.innerHTML = "Enter only Letters";
            return;
        }
        Language1.innerHTML = "";

        if (language2 === '') {
            Language2.innerHTML = "Enter the Language you Know";
            return;
        } else if (!languageRegex.test(language2)) {
            Language2.innerHTML = "Enter only Letters";
            return;
        }
        Language2.innerHTML = "";

        if (language3 === '') {
            Language3.innerHTML = "Enter the Language you Know";
            return;
        } else if (!languageRegex.test(language3)) {
            Language3.innerHTML = "Enter only Letters";
            return;
        }
        Language3.innerHTML = "";

        if (language4 === '') {
            Language4.innerHTML = "Enter the Language you Know";
            return;
        } else if (!languageRegex.test(language4)) {
            Language4.innerHTML = "Enter only Letters";
            return;
        }
        Language4.innerHTML = "";


        if (valid) {
            document.getElementById("form").submit();
        }
    }

    function backfunction() {
        window.location.href = "fourth.php";
    }
</script>
</body>
</html>

