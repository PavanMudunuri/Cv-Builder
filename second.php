<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $College = isset($_POST['College']) ? ($_POST['College']) : '';
    $Location = isset($_POST['Location']) ? ($_POST['Location']) : '';
    $Qualification = isset($_POST['Qualification']) ? ($_POST['Qualification']) : '';
    $Domain = isset($_POST['Domain']) ? ($_POST['Domain']) : '';
    $Cgpa = isset($_POST['Cgpa']) ? ($_POST['Cgpa']) : '';
    $Jyear = isset($_POST['Jyear']) ? ($_POST['Jyear']) : '';
    $Fyear = isset($_POST['Fyear']) ? ($_POST['Fyear']) : '';

    $School1 = isset($_POST['school1']) ? ($_POST['school1']) : '';
    $Location1 = isset($_POST['Location1']) ? ($_POST['Location1']) : '';
    $Cgpa1 = isset($_POST['Cgpa1']) ? ($_POST['Cgpa1']) : '';
    $JYear1 = isset($_POST['JYear1']) ? ($_POST['JYear1']) : '';
    $FYear1 = isset($_POST['FYear1']) ? ($_POST['FYear1']) : '';

    $School2 = isset($_POST['school2']) ? ($_POST['school2']) : '';
    $Location2 = isset($_POST['Location2']) ? ($_POST['Location2']) : '';
    $Cgpa2 = isset($_POST['Cgpa2']) ? ($_POST['Cgpa2']) : '';
    $JYear2 = isset($_POST['JYear2']) ? ($_POST['JYear2']) : '';
    $FYear2 = isset($_POST['FYear2']) ? ($_POST['FYear2']) : '';

    if (!empty($College) && !empty($Location) && !empty($Qualification) && !empty($Domain) && !empty($Cgpa) && !empty($Jyear) && !empty($Fyear) && !empty($School1) && !empty($Location1) && !empty($Cgpa1) && !empty($JYear1) && !empty($FYear1) && !empty($School2) && !empty($Location2) && !empty($Cgpa2) && !empty($JYear2) && !empty($FYear2)) {
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "test";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if (mysqli_connect_error()) {
            die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }else {
            $INSERT = "INSERT INTO second (College, Location, Qualification, Domain, Cgpa, Jyear, Fyear, School1, Location1, Cgpa1, JYear1, FYear1, School2, Location2, Cgpa2, JYear2, FYear2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("sssssiisssiisssii", $College, $Location, $Qualification, $Domain, $Cgpa, $Jyear, $Fyear, $School1, $Location1, $Cgpa1, $JYear1, $FYear1, $School2, $Location2, $Cgpa2, $JYear2, $FYear2);
            $stmt->execute();

            $_SESSION['user_id'] = $conn->insert_id;
            header("Location:first.php");
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
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Education Form</title>
    <style>
        body{
        background-color:whitesmoke;
        margin: 0;
    }
    #large{
        width:700px;
        margin-left:auto;
        margin-right:auto;
        margin-top:5px;
        border-radius:60px;
    }
    #form1{
        display: flex;
        justify-content: space-between;
        margin-bottom:15px;
        margin-left:20px;
    }
    #form2{
        flex:2;
        margin-right: 10px;
        position:relative;
    }
    label{
        font-family:'Times New Roman', Times, serif;
        font-size:20px;
        font-style:italic;
        font-weight:normal;
    }
    #button{
        display: flex;
        justify-content: space-between;
        margin-top: 20px 0;
    }
    #continue{
        text-align:center;
        width:140px;
        font-size:30px;
        border-radius:10px;
        border:5px solid  rgb(235, 158, 15);
        font-family: 'Times New Roman', Times, serif;
        background-color: rgb(235, 158, 15);
    }
    #continue:hover{
        background-color: coral;
    }
    #back{
        text-align:center;
        width:140px;
        font-size:30px;
        border-radius:10px;
        border:5px solid  rgb(235, 158, 15);
        font-family: 'Times New Roman', Times, serif;
        background-color: rgb(235, 158, 15);
    }
    #back:hover{
        background-color: coral;
    }
    .error{
        color: rgb(0, 85, 255);
        font-size: 20px;
        margin-top: 6px;
    }
    .name{
        font-size:20px;
        font-family: 'Times New Roman', Times, serif;
        width:280px;
        height:35px;
    }
    #new1{
        background-color: rgb(235, 158, 15);
        height:60px;
        text-align: center;
        padding:5px;
    }
    #new2{
        margin:0;
        font-size:40px;
        text-align: center;
        color:rgb(69, 68, 68);
        padding:5px;
    }
    #qual{
        font-size:20px;
        width:200px;
        height:40px;
        font-family:'Times New Roman', Times, serif;
    }
    .name1{
        font-size:20px;
        font-family: 'Times New Roman', Times, serif;
        width:164px;
        height:35px;
    }
    footer{
        background-color: rgb(251, 189, 4);
        padding: 10px;
        text-align: center;
        color: white;
    }
    @media (max-width: 768px){
        body{
            overflow-x: hidden;
        }
        #new1,
        footer{
            width:100%;
        }
        #large{
            margin-right: 0;
        }
    }
    .centered {
        font-size:20px;
        font-style:italic;
        padding-right:20px;
        max-width:640px;
        margin:0 auto;
        
    }
        
    </style>
</head>
<body>
    <div id="new1">
        <h1 id="new2">Curriculum Vitae (CV)</h1>
    </div>
    <div id="body2" class="centered">
        <h1>Let's know about your Education</h1>
        <p>* Indicates required fields (Please use Capital Letters at the beginning)</p>
    </div>
    <form action="second.php" method="POST" id="form">
        <div id="large">
            <div id="form1">
                <div id="form2">
                    <label for="coll">College/University*</label>
                    <input class="name" type="text" id="coll" placeholder="Eg: ABCDEF" name="College" required>
                    <p id="Coll" class="error"></p>
                </div>
                <div id="form2">
                    <label for="location">Location*</label>
                    <input class="name" type="text" id="location" placeholder="Eg: ABCDEF" name="Location" required>
                    <p id="Location" class="error"></p>
                </div>
            </div>

            <div id="form1">
                <div id="form2">
                    <label for="qual">Qualification*</label><br>
                    <select id="qual" name="Qualification" required>
                        <option value="SELECT">Select</option>
                        <option value="UG(UNDER GRADUATE)">UG (Under Graduate)</option>
                        <option value="PG(POST GRADUATE)">PG (Post Graduate)</option>
                        <option value="PHD">PHD</option>
                        <option value="RESEARCH">Research</option>
                    </select>
                    <p id="Qual" class="error"></p>
                </div>
                <div id="form2">
                    <label for="domain">Specialization*</label>
                    <input class="name" type="text" id="domain" placeholder="Eg: IOT, BKT, AI, Data Science" name="Domain" required>
                    <p id="Domain" class="error"></p>
                </div>
            </div>

            <div id="form1">
                <div id="form2">
                    <label for="cgpa">CGPA*</label><br>
                    <input style="width:140px" class="name" type="number" id="cgpa" min="1" max="10" step="0.01" placeholder="Eg: 9.8" name="Cgpa" required>
                    <p id="Cgpa" class="error"></p>
                </div>
                <div id="form2">
                    <label for="jyear">Joining Year*</label>
                    <input style="width:140px" class="name" type="number" min="1980" max="2200" id="jyear" placeholder="Eg: 2021" name="Jyear" required>
                    <p id="Jyear" class="error"></p>
                </div>
                <div id="form2">
                    <label for="fyear">Graduation Year*</label>
                    <input style="width:140px" class="name" type="number" min="1980" max="2200" id="fyear" placeholder="Eg: 2025" name="Fyear" required>
                    <p id="Fyear" class="error"></p>
                </div>
            </div>
            <hr>

            <div id="form1">
                <div id="form2">
                    <label for="school">12thSchooling </label>
                    <input class="name" type="text" id="school" placeholder="Eg: ABCDEF" name="school1" required>
                    <p id="School" class="error"></p>
                </div>
                <div id="form2">
                    <label for="school_location">12thLocation*</label>
                    <input class="name" type="text" id="school_location" placeholder="Eg: ABCDEF" name="Location1" required>
                    <p id="Location1" class="error"></p>
                </div>
            </div>

            <div id="form1">
                <div id="form2">
                    <label for="school_cgpa">12thCGPA*</label>
                    <input style="width:140px"class="name"  id="school_cgpa" type="number" min="1" max="10" step="0.01" placeholder="Eg: 9.8" name="Cgpa1" required>
                    <p id="Cgpa1" class="error"></p>
                </div>
                <div id="form2">
                    <label for="school_jyear">12thJoining Year*</label>
                    <input style="width:140px" class="name"  id="school_jyear" type="number" min="1980" max="2200" placeholder="Eg: 2015" name="JYear1" required>
                    <p id="JYear1" class="error"></p>
                </div>
                <div id="form2">
                    <label for="school_fyear">12thGraduation Year*</label>
                    <input style="width:140px" class="name"  id="school_fyear" type="number" min="1980" max="2200" placeholder="Eg: 2017" name="FYear1" required>
                    <p id="FYear1" class="error"></p>
                </div>
            </div>
            <hr>

            <div id="form1">
                <div id="form2">
                    <label for="school2">10thSchooling</label>
                    <input class="name" type="text" id="school2" placeholder="Eg: ABCDEF" name="school2" required>
                    <p id="School2" class="error"></p>
                </div>
                <div id="form2">
                    <label for="school2_location">10thLocation*</label>
                    <input class="name" type="text" id="school2_location" placeholder="Eg: ABCDEF" name="Location2" required>
                    <p id="Location2" class="error"></p>
                </div>
            </div>

            <div id="form1">
                <div id="form2">
                    <label for="school2_cgpa">10thCGPA*</label>
                    <input style="width:140px" class="name" type="number" min="1" max="10" step="0.01" id="school2_cgpa" placeholder="Eg: 9.8" name="Cgpa2" required>
                    <p id="Cgpa2" class="error"></p>
                </div>
                <div id="form2">
                    <label for="school2_jyear">10thJoining Year*</label>
                    <input style="width:140px" class="name"  id="school2_jyear" type="number" min="1980" max="2200" placeholder="Eg: 2018" name="JYear2" required>
                    <p id="JYear2" class="error"></p>
                </div>
                <div id="form2">
                    <label for="school2_fyear">10thGraduation Year*</label>
                    <input style="width:140px" class="name"  id="school2_fyear" type="number" min="1980" max="2200" placeholder="Eg: 2020" name="FYear2" required>
                    <p id="FYear2" class="error"></p>
                </div>
            </div>
            <div id="button">
                <button id="back" class="back" onclick="backfunction()">Back</button>
                <button class="continue" id="continue" onclick="myfunction(event)">Continue</button>
            </div>
        </div>
        <br>
    </form>
    <footer>
        <h1>Author: Pavan</h1>
        &copy; All rights reserved<br>
        <a href="tel:+9999999999" style="color: white; text-decoration: none;">+99-99999-999</a><br>
        <a href="mailto:abc@gmail.com" style="color: white; text-decoration: none;">Gmail</a>
    </footer>
    <script>
        function myfunction(event) {
            event.preventDefault();
    
    const college = document.getElementById("coll").value.trim();
    const location = document.getElementById("location").value.trim();
    const qualification = document.getElementById("qual").value;
    const domain = document.getElementById("domain").value.trim();
    const cgpa = document.getElementById("cgpa").value.trim();
    const jyear = document.getElementById("jyear").value.trim();
    const fyear = document.getElementById("fyear").value.trim();
    const school1 = document.getElementById("school").value.trim();
    const location1 = document.getElementById("school_location").value.trim();
    const cgpa1 = document.getElementById("school_cgpa").value.trim();
    const jyear1 = document.getElementById("school_jyear").value.trim();
    const fyear1 = document.getElementById("school_fyear").value.trim();
    const school2 = document.getElementById("school2").value.trim();
    const location2 = document.getElementById("school2_location").value.trim();
    const cgpa2 = document.getElementById("school2_cgpa").value.trim();
    const jyear2 = document.getElementById("school2_jyear").value.trim();
    const fyear2 = document.getElementById("school2_fyear").value.trim();

    const collegeError = document.getElementById("Coll");
    const locationError = document.getElementById("Location");
    const qualificationError = document.getElementById("Qual");
    const domainError = document.getElementById("Domain");
    const cgpaError = document.getElementById("Cgpa");
    const jyearError = document.getElementById("Jyear");
    const fyearError = document.getElementById("Fyear");
    const school1Error = document.getElementById("School");
    const location1Error = document.getElementById("Location1");
    const cgpa1Error = document.getElementById("Cgpa1");
    const jyear1Error = document.getElementById("JYear1");
    const fyear1Error = document.getElementById("FYear1");
    const school2Error = document.getElementById("School2");
    const location2Error = document.getElementById("Location2");
    const cgpa2Error = document.getElementById("Cgpa2");
    const jyear2Error = document.getElementById("JYear2");
    const fyear2Error = document.getElementById("FYear2");

    const collegeRegex = /^[A-Za-z\s]+$/;
    const locationRegex = /^[A-Za-z\s]+$/;
    const cgpaRegex = /^[0-9]+(\.[0-9]+)?$/;
    const yearRegex = /^[0-9]{4}$/;

    let isValid = true;

    if(college === ''){
        collegeError.innerHTML = "Enter the College Name";
        isValid = false;
    } else if(!collegeRegex.test(college)){
        collegeError.innerHTML = "You should enter only letters";
        isValid = false;
    } else {
        collegeError.innerHTML = "";
    }

    if(location === ''){
        locationError.innerHTML = "Enter the Location";
        isValid = false;
    } else if(!locationRegex.test(location)){
        locationError.innerHTML = "You should enter only letters";
        isValid = false;
    } else {
        locationError.innerHTML = "";
    }

    if(qualification === '' || qualification === 'SELECT'){
        qualificationError.innerHTML = "Select the Qualification";
        isValid = false;
    } else {
        qualificationError.innerHTML = "";
    }

    if(domain === ''){
        domainError.innerHTML = "Enter the Domain";
        isValid = false;
    } else {
        domainError.innerHTML = "";
    }

    if(cgpa === ''){
        cgpaError.innerHTML = "Enter the CGPA";
        isValid = false;
    } else if(!cgpaRegex.test(cgpa)){
        cgpaError.innerHTML = "Enter a valid CGPA";
        isValid = false;
    } else {
        cgpaError.innerHTML = "";
    }

    if(jyear === ''){
        jyearError.innerHTML = "Enter the Joining Year";
        isValid = false;
    } else if(!yearRegex.test(jyear)){
        jyearError.innerHTML = "Enter a valid year";
        isValid = false;
    } else {
        jyearError.innerHTML = "";
    }

    if(fyear === ''){
        fyearError.innerHTML = "Enter the Graduation Year";
        isValid = false;
    } else if(!yearRegex.test(fyear)){
        fyearError.innerHTML = "Enter a valid year";
        isValid = false;
    } else {
        fyearError.innerHTML = "";
    }

    if(school1 === ''){
        school1Error.innerHTML = "Enter the School Name";
        isValid = false;
    } else if(!collegeRegex.test(school1)){
        school1Error.innerHTML = "You should enter only letters";
        isValid = false;
    } else {
        school1Error.innerHTML = "";
    }

    if(location1 === ''){
        location1Error.innerHTML = "Enter the Location";
        isValid = false;
    } else if(!locationRegex.test(location1)){
        location1Error.innerHTML = "You should enter only letters";
        isValid = false;
    } else {
        location1Error.innerHTML = "";
    }

    if(cgpa1 === ''){
        cgpa1Error.innerHTML = "Enter the CGPA";
        isValid = false;
    } else if(!cgpaRegex.test(cgpa1)){
        cgpa1Error.innerHTML = "Enter a valid CGPA";
        isValid = false;
    } else {
        cgpa1Error.innerHTML = "";
    }

    if(jyear1 === ''){
        jyear1Error.innerHTML = "Enter the Joining Year";
        isValid = false;
    } else if(!yearRegex.test(jyear1)){
        jyear1Error.innerHTML = "Enter a valid year";
        isValid = false;
    } else {
        jyear1Error.innerHTML = "";
    }

    if(fyear1 === ''){
        fyear1Error.innerHTML = "Enter the Graduation Year";
        isValid = false;
    } else if(!yearRegex.test(fyear1)){
        fyear1Error.innerHTML = "Enter a valid year";
        isValid = false;
    } else {
        fyear1Error.innerHTML = "";
    }

    if(school2 === ''){
        school2Error.innerHTML = "Enter the School Name";
        isValid = false;
    } else if(!collegeRegex.test(school2)){
        school2Error.innerHTML = "You should enter only letters";
        isValid = false;
    } else {
        school2Error.innerHTML = "";
    }

    if(location2 === ''){
        location2Error.innerHTML = "Enter the Location";
        isValid = false;
    } else if(!locationRegex.test(location2)){
        location2Error.innerHTML = "You should enter only letters";
        isValid = false;
    } else {
        location2Error.innerHTML = "";
    }

    if(cgpa2 === ''){
        cgpa2Error.innerHTML = "Enter the CGPA";
        isValid = false;
    } else if(!cgpaRegex.test(cgpa2)){
        cgpa2Error.innerHTML = "Enter a valid CGPA";
        isValid = false;
    } else {
        cgpa2Error.innerHTML = "";
    }

    if(jyear2 === ''){
        jyear2Error.innerHTML = "Enter the Joining Year";
        isValid = false;
    } else if(!yearRegex.test(jyear2)){
        jyear2Error.innerHTML = "Enter a valid year";
        isValid = false;
    } else {
        jyear2Error.innerHTML = "";
    }

    if(fyear2 === ''){
        fyear2Error.innerHTML = "Enter the Graduation Year";
        isValid = false;
    } else if(!yearRegex.test(fyear2)){
        fyear2Error.innerHTML = "Enter a valid year";
        isValid = false;
    } else {
        fyear2Error.innerHTML = "";
    }
    if (isValid) {
            document.getElementById("form").submit();
        }
    }

    function backfunction() {
        window.location.href = "first.php";
    }

    document.getElementById("continue").addEventListener("click", myfunction);

</script>

</body>
</html>