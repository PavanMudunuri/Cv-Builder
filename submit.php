<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit form</title>
    <style>
        #body{
            background-color:skyblue;
            margin:0;
        }
        h1,h2,h3{
            margin-top:40px;
            color:darkorange;
            text-align:center;
            font-style: italic;
        }
        p{
            color:orange;
            text-align:center;
            font-style:italic;
            font-size:large;
        }
        p:hover{
            color:brown;
        }
        #box1{
            display:flex;
            justify-content: space-between;
            margin:40px;
        }
        #box2{
            flex:1;
            position:relative;
            justify-content:center;
            text-align:center;
        }
        #view{
            text-align:center;
            width:220px;
            height:180px;
        }
        #view:hover{
            background-color:rgb(255, 193, 78);
        }
        #download{
            text-align:center;
            width:220px;
            height:180px;
        }
        #download:hover{
            background-color:rgb(255, 193, 78);
        }
        @media (max-width: 768px) {
            #box1 {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body id=body>
    <div id="box">
        <h1>Curriculum Vitae (CV) is Successfully Completed!</h1>

        <h2>Thankyou for Creating Your CV in Our Website</h2>

        <h3 onclick="this.innerHTML='Empowering your CV, empowering your future. Thank you for trusting us!'">Click on me for a Message </h3>

        <div id="box1">
            <div id="box2">
                <button id="view" onclick="view()"><h2>View CV</h2></button>
            </div>
            <div id="box2">
                <button id="download" onclick="download()" ><h2>Download CV</h2></button>
            </div>
        </div>

        <h1>THE END</h1>
    </div>
    <script>
        function view(){
            window.open('generate.php?action=view','_blank');
        }

        function download() {
        if (confirm('Are you sure you want to download your CV?')) {
        window.location.href = 'generate.php?action=download';
    }
}

    </script>
</body>
</html>