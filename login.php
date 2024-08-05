<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        body {
            background-color:rgb(245, 245, 245);
            margin:0;
        }
        #page1 {
            display: flex;
            justify-content: space-around;
            margin-bottom: 40px;
        }
        #id1 {
            margin-right: 20px;
        }
        #h2 {
            font-family: 'Times New Roman', Times, serif;
            font-size: 40px;
            font-style: italic;
            margin-left:20px
        }
        #p {
            font-style: italic;
            font-family: 'Times New Roman', Times, serif;
            font-size: 40px;
            margin-left:20px;
        }
        #build {
            margin-left:20px;
            text-align: center;
            height:50px;
            font-size: 30px;
            border-radius: 20px;
            font-style: italic;
            background-color:rgb(255, 167, 5);
        }
        #img {
            max-width: 400px;
            height: auto;
            margin-top:10px;
            position: relative;
            animation:rotateAndMove  5s infinite;
        } 
        @keyframes rotateAndMove {
            0%, 100% {
                transform: translateX(0);
            }
            50% {
                transform: translateX(-100px) rotateY(180deg);
            }
        }
        
        #page2 {
            text-align: center;
            padding: 20px;
            transition: background-color 0.5s ease;
            font-family: 'Times New Roman', Times, serif;
            font-style: italic;
        }
        footer {
            background-color:rgb(251, 189, 4);
            padding: 10px;
            text-align: center;
            color: white;
        }
        #p1 {
            padding: 5px;
            font-style: italic;
            font-size: 25px;
        }
        #box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color:rgb(251, 189, 4);
            margin:0;
            height:60px;
            padding:10px 20px;
        }
        #login-signup {
            display: flex;
            gap:100px;
        }
        #sign{
            margin-right:40px;
            width:100px;
            height:40px;
            color:orange;
            font-size:20px;
        }
        #login{
            width:100px;
            height:40px;
            color:orange;
            font-size:20px;
        }
        #sign:hover{
            background-color:brown;
        }
        #login:hover{
            background-color:brown;
        }

        @media (max-width: 768px) {
            body {
                overflow-x: hidden;
            }
            h1,
            footer {
                width:100%;
            }
            #page1 {
                margin-right: 0;
            }
        }
    </style>
</head>
<body>
    <div id="box">
        <h2 style="margin-left:50px"> Cv Website</h2>
        <div id="login-signup">
            <button class="button" id="login" >Login</button> 
            <button class="button" id="sign" >Sign Up</button>
        </div>
    </div>
<div id="page1">
    <div id="id1">
        <h1 style="font-size: 60px;margin-left:20px">Welcome</h1>

        <h1 id="h2">The Best CV Website You Have Never Seen.</h1>
        <p onclick="this.innerHTML='The first step of starting your career in IT is creating the best CV.So,let me help you build it.'" id="p">Click here for a message!</p>

        <button id="build" onclick="myfunction(event)">Build Your CV</button>
    </div>
    <div id="id2">
        <img id="img" src="photo1.jpg" alt="image of resume">
    </div>
</div>

<div id="page2">
    <h1>Categories Included Here For Making CV</h1>
    <p id="p1">1. Personal Details</p>
    <p id="p1">2. Qualifications</p>
    <p id="p1">3. Skills</p>
    <p id="p1">4. Work Experiences</p>
    <p id="p1">5. Hobbies/Languages</p>
    <p id="p1">6. Generate pdf(View or Download)</P>
</div>

<p style="padding: 30px; font-size: 20px; font-style: italic;">All rights belong to Pavan. If you have any queries, you can contact or mail him.</p>

<footer>
    <h1>Author: Pavan</h1>
    &copy; All rights reserved<br>
    <a href="tel:+9999999999" style="color: white; text-decoration: none;">+99-99999-999</a><br>
    <a href="mailto:abc@gmail.com" style="color: white; text-decoration: none;">Gmail</a>
</footer>

<script>
    window.onscroll = function() { scrollFunction(); };

    function scrollFunction() {
        if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
            document.getElementById("page2").style.backgroundColor = "orange";
        } else {
            document.getElementById("page2").style.backgroundColor = "transparent";
        }
    }

    function myfunction(event){
        event.preventDefault();

        window.location.href ="first.php";
    }
</script>
</body>
</html>