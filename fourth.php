<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: first.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "test";
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $inserted = true;
    $experienceCount = intval($_POST['experienceCount']);

    for ($i = 1; $i <= $experienceCount; $i++) {
        $OfficeName = isset($_POST["OfficeName$i"]) ? $_POST["OfficeName$i"] : '';
        $Roleofjob = isset($_POST["Roleofjob$i"]) ? $_POST["Roleofjob$i"] : '';
        $Project = isset($_POST["Project$i"]) ? $_POST["Project$i"] : '';
        $Software = isset($_POST["Software$i"]) ? $_POST["Software$i"] : '';
        $jdate = isset($_POST["jdate$i"]) ? $_POST["jdate$i"] : '';
        $fdate = isset($_POST["fdate$i"]) ? $_POST["fdate$i"] : '';
        $location = isset($_POST["location$i"]) ? $_POST["location$i"] : '';

        if (!empty($OfficeName) && !empty($Roleofjob) && !empty($Project) && !empty($Software) && !empty($jdate) && !empty($fdate) && !empty($location)) {
            $stmt = $conn->prepare("INSERT INTO fourth (OfficeName, Roleofjob, Project, Software, jdate, fdate, location) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $OfficeName, $Roleofjob, $Project, $Software, $jdate, $fdate, $location);

            // Format dates
            $jdate = date('Y-m-d', strtotime($jdate));
            $fdate = date('Y-m-d', strtotime($fdate));

            if (!$stmt->execute()) {
                $inserted = false;
            }

            $stmt->close();
        } else {
            echo "All fields are required for experience $i";
            $conn->close();
            exit();
        }
    }
    $conn->close();

    if ($inserted) {
        header("Location: submit.php");
        exit();
    } else {
        echo "Failed to insert data.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: white;
            margin: 0;
        }
        #work {
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
            font-family: 'Times New Roman', Times, serif;
            font-size: 24px;
            font-style: italic;
        }

        #button {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .error {
            color: rgb(0, 85, 255);
            font-size: 20px;
            margin-top: 6px;
        }
        #submit {
            text-align: center;
            width: 140px;
            font-size: 30px;
            margin-right: 90px;
            font-family: 'Times New Roman', Times, serif;
            border-radius: 10px;
            border: 5px solid rgb(235, 158, 15);
            background-color: rgb(235, 158, 15);
        }
        #submit:hover {
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
        .name {
            font-size: 20px;
            width: 280px;
            height: 35px;
            font-family: 'Times New Roman', Times, serif;
        }
        #new2 {
            margin: 0;
            font-size: 40px;
            text-align: center;
            color: rgb(69, 68, 68);
            padding: 5px;
        }
        #new1 {
            background-color: rgb(235, 158, 15);
            height: 60px;
            padding: 5px;
        }
        footer {
            background-color: rgb(251, 189, 4);
            padding: 10px;
            text-align: center;
            color: white;
        }
        .name1 {
            font-size: 20px;
            width: 150px;
            height: 35px;
            font-family: 'Times New Roman', Times, serif; 
        }
        @media (max-width: 1000px) {
            body {
                overflow-x: hidden;
            }
            #new1,
            footer {
                width: 100%;
            }
            #work {
                margin-right: 0;
            }
        }
        #add {
            text-align: center;
            width: 200px;
            height: 40px;
            margin-left: 240px;
            font-family: 'Times New Roman', Times, serif;
            border-radius: 10px;
            border: 5px solid rgb(235, 158, 15);
            background-color: rgb(235, 158, 15);
        }
        .center {
            font-size: 20px;
            font-style: italic;
            padding-right: 20px;
            max-width: 750px;
            margin: 0 auto;
        }
    </style>
</head>

<body id="body">

    <div id="new1">
        <h1 id="new2"> Curriculum Vitae(cv)</h1>
    </div>
    
    <div class="center">
        <h1>Finally, provide your Work Experience</h1>
        <p>*Indicates required fields(Please use Capital Letters in starting)</p>
    </div>

    <form action="fourth.php" method="post" id="newForm">
    <input type="hidden" name="experienceCount" id="experienceCount" value="1">
    <div id="work">
        <div id="container">
            <div id="form1">
                <div id="form2">
                    <label for="office1">OfficeName-1*</label>
                    <input class="name" type="text" id="office1" placeholder="OfficeName" name="OfficeName1" required>
                    <p id="Office1" class="error"></p>
                </div>

                <div id="form2">
                    <label for="job1">Role-of-Job-1*</label>
                    <input class="name" type="text" id="job1" placeholder="Role-of-Job" name="Roleofjob1" required>
                    <p id="Job1" class="error"></p>
                </div>
            </div>

            <div id="form1">
                <div id="form2">
                    <label for="project1">Project-1*</label>
                    <input class="name" type="text" id="project1" placeholder="ProjectName" name="Project1" required>
                    <p id="Project1" class="error"></p>
                </div>

                <div id="form2">
                    <label for="software1">Software-1*</label>
                    <input class="name" type="text" id="software1" placeholder="Software Used In Project" name="Software1" required>
                    <p id="Software1" class="error"></p>
                </div>
            </div>

            <div id="form1">
                <div id="form2">
                    <label for="jdate1">Joining Date*</label>
                    <input class="name1" type="date" id="jdate1" name="jdate1" required>
                    <p id="Jdate1" class="error"></p>
                </div>

                <div id="form2">
                    <label for="fdate1">Ending Date*</label>
                    <input class="name1" type="date" id="fdate1" name="fdate1" required>
                    <p id="Fdate1" class="error"></p>
                </div>

                <div id="form2">
                    <label for="location1">Location*</label>
                    <input class="name1" type="text" id="location1" placeholder="City" name="location1" required>
                    <p id="Location1" class="error"></p>
                </div>
            </div>
        </div>

        <button id="add" type="button" onclick="addWorkExperience()">+ Add More Experience</button>
        <div id="button">
            <button id="back" class="back" type="button" onclick="backfunction()">Back</button>
            <button class="submit" id="submit" type="submit">Continue</button>
        </div>
    </div>
</form>
    <p id="reset"  onclick="myreset()"></p>
    <p style="padding: 30px; font-size: 20px; font-style: italic;">All rights belong to Pavan. If you have any queries, you can contact or mail him.</p>

    <footer>
        <h1>Author: Pavan</h1>
        &copy; All rights reserved<br>
        <a href="tel:+9999999999" style="color: white; text-decoration: none;">+99-999-99999</a><br>
        <a href="mailto:abc@gmail.com" style="color: white; text-decoration: none;">Gmail</a>
    </footer>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
    let experienceCount = 1;

    function addWorkExperience() {
        experienceCount++;
        document.getElementById("experienceCount").value = experienceCount;
        const container = document.getElementById("container");

        const newForm = document.createElement("div");
        newForm.id = `form${experienceCount}`;
        newForm.innerHTML = `
        <div id="form1">
            <div id="form2">
                <label for="office${experienceCount}">OfficeName-${experienceCount}*</label>
                <input class="name" type="text" id="office${experienceCount}" name="OfficeName${experienceCount}" placeholder="OfficeName" required>
                <p id="Office${experienceCount}" class="error"></p>
            </div>

            <div id="form2">
                <label for="job${experienceCount}">Role-of-Job-${experienceCount}*</label>
                <input class="name" type="text" id="job${experienceCount}" name="Roleofjob${experienceCount}" placeholder="RoleofJob" required>
                <p id="Job${experienceCount}" class="error"></p>
            </div>
        </div>

        <div id="form1">
            <div id="form2">
                <label for="project${experienceCount}">Project-${experienceCount}*</label>
                <input class="name" type="text" id="project${experienceCount}" name="Project${experienceCount}" placeholder="Project" required>
                <p id="Project${experienceCount}" class="error"></p>
            </div>

            <div id="form2">
                <label for="software${experienceCount}">Software-${experienceCount}*</label>
                <input class="name" type="text" id="software${experienceCount}" name="Software${experienceCount}" placeholder="Software" required>
                <p id="Software${experienceCount}" class="error"></p>
            </div>
        </div>

        <div id="form1">
            <div id="form2">
                <label for="jdate${experienceCount}">Joining Date*</label>
                <input class="name1" type="date" id="jdate${experienceCount}" name="jdate${experienceCount}" required>
                <p id="Jdate${experienceCount}" class="error"></p>
            </div>

            <div id="form2">
                <label for="fdate${experienceCount}">Ending Date*</label>
                <input class="name1" type="date" id="fdate${experienceCount}" name="fdate${experienceCount}" required>
                <p id="Fdate${experienceCount}" class="error"></p>
            </div>

            <div id="form2">
                <label for="location${experienceCount}">Location*</label>
                <input class="name1" type="text" id="location${experienceCount}" name="location${experienceCount}" placeholder="City" required>
                <p id="Location${experienceCount}" class="error"></p>
            </div>
        </div>
    `;
    container.appendChild(newForm);
    }

    function validateForm(event) {
        for (let i = 1; i <= experienceCount; i++) {
            const office = document.getElementById(`office${i}`).value.trim();
            const job = document.getElementById(`job${i}`).value.trim();
            const project = document.getElementById(`project${i}`).value.trim();
            const software = document.getElementById(`software${i}`).value.trim();
            const location = document.getElementById(`location${i}`).value.trim();
            const jdate = document.getElementById(`jdate${i}`).value.trim();
            const fdate = document.getElementById(`fdate${i}`).value.trim();

            const Office = document.getElementById(`Office${i}`);
            const Job = document.getElementById(`Job${i}`);
            const Project = document.getElementById(`Project${i}`);
            const Software = document.getElementById(`Software${i}`);
            const Location = document.getElementById(`Location${i}`);
            const Jdate = document.getElementById(`Jdate${i}`);
            const Fdate = document.getElementById(`Fdate${i}`);

            const officeRegex = /^[A-Za-z\s]+$/;
            const jobRegex = /^[A-Za-z\s]+$/;
            const projectRegex = /^[A-Za-z\s,.-]+$/;
            const softwareRegex = /^[A-Za-z\s,.-]+$/;
            const locationRegex = /^[A-Za-z\s]+$/;
            const dateRegex = /^\d{4}-\d{2}-\d{2}$/;

            if (office === '') {
                Office.innerHTML = "Enter Office Name";
                event.preventDefault();
                return;
            } else if (!officeRegex.test(office)) {
                Office.innerHTML = "Enter only Letters";
                event.preventDefault();
                return;
            }
            Office.innerHTML = "";

            if (job === '') {
                Job.innerHTML = "Enter Job Title";
                event.preventDefault();
                return;
            } else if (!jobRegex.test(job)) {
                Job.innerHTML = "Enter only letters";
                event.preventDefault();
                return;
            }
            Job.innerHTML = "";

            if (project === '') {
                Project.innerHTML = "Enter Project Name";
                event.preventDefault();
                return;
            } else if (!projectRegex.test(project)) {
                Project.innerHTML = "Enter only letters";
                event.preventDefault();
                return;
            }
            Project.innerHTML = "";

            if (software === '') {
                Software.innerHTML = "Enter Software used";
                event.preventDefault();
                return;
            } else if (!softwareRegex.test(software)) {
                Software.innerHTML = "Enter only letters";
                event.preventDefault();
                return;
            }
            Software.innerHTML = "";

            if (location === '') {
                Location.innerHTML = "Enter Location";
                event.preventDefault();
                return;
            } else if (!locationRegex.test(location)) {
                Location.innerHTML = "Enter only letters";
                event.preventDefault();
                return;
            }
            Location.innerHTML = "";

            if (jdate === '') {
                Jdate.innerHTML = "Enter Joining Date";
                event.preventDefault();
                return;
            } else if (!dateRegex.test(jdate)) {
                Jdate.innerHTML = "Enter a valid date";
                event.preventDefault();
                return;
            }
            Jdate.innerHTML = "";

            if (fdate === '') {
                Fdate.innerHTML = "Enter Ending Date";
                event.preventDefault();
                return;
            } else if (!dateRegex.test(fdate)) {
                Fdate.innerHTML = "Enter a valid date";
                event.preventDefault();
                return;
            }
            Fdate.innerHTML = "";
        }
    }

    document.getElementById('newForm').addEventListener('submit', validateForm);

    function myreset() {
        document.getElementById("newForm").reset();
    }

    document.getElementById("add").addEventListener("click", addWorkExperience);

    function backfunction() {
        window.location.href = "third.php";
    }

    document.getElementById("back").addEventListener("click", backfunction);
});
    </script>
</body>
</html>