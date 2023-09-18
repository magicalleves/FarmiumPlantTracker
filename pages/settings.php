<?php
session_start();

$conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");

$userid = $_SESSION['userid'];

if (!isset($_SESSION["userid"])) {
    echo "<script> alert('Please log in first!')
    window.location.replace('../index'); </script>";
} 


$sql = "SELECT usersName, usersEmail, usersPwd FROM users WHERE UsersId = $userid";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {
      $name = $row['usersName'];
      $email = $row['usersEmail'];
      $pwd = $row['usersPwd'];
    }

  }

  mysqli_close($conn);


  // change name, password funciton ----------------------------------------------
  if (isset($_POST['change'])) {
    $new_name = $_POST['name'];

    $query = "UPDATE users SET usersName='$new_name' WHERE usersId = $userid";
    mysqli_query($conn, $query);

    mysqli_close($conn);
  }; 

?>
<html>
    <head>
        <title>Farmium</title>
        <style>
            .container {
            display: flex;
            align-items: center;
            background-color: #E9EAE180;
            width: 280px;
            height: 55px;
            text-align: left;
            border-radius: 10px;
            margin: auto;
            font-size: 15px;
            margin-bottom: 10px;
            }

            .container2 {
            display: flex;
            align-items: center;
            background-color: #E9EAE180;
            width: 280px;
            height: 55px;
            text-align: left;
            border-radius: 10px;
            margin: auto;
            font-size: 15px;
            margin-bottom: 10px;
            }

            label {
            text-align: left;
            margin-left: 15px;
            margin-bottom: 20px;
            margin-right: -40px;
            }

            button {
            flex: 0 0 80px; /* fixed width */
            margin-left: auto; /* push to the right */
            background-color: #B09F85;
            height: fit-content;
            width: fit-content;
            padding: 5px 0;
            color: white;
            border: none;
            border-radius: 6px;
            margin-right: 15px;
            font-size: 15px;
            }

            #cpwd {
                flex: 0 0 80px; /* fixed width */
            margin-left: auto; /* push to the right */
            background-color: #B09F85;
            height: fit-content;
            width: fit-content;
            padding: 5px 0;
            color: white;
            border: none;
            border-radius: 6px;
            margin-right: 15px;
            text-align: center;
            }

            span {
            flex: 1; /* occupy remaining space */
            text-align: left;
            margin-top: 20px;
            margin-right: 20px;
            }

/*
            #input1 {
                border-radius: 3px;
                width: 150px;
                font-size: 15px;
                padding-left: 0px;
                margin-top: 20px;
                height: 5px;

            }

            input[type=text] {
                width: 100px;
                height: 5px;
            }

            input[type=text]::placeholder {
                font-size: 15px;
                padding-left: 100px;
                height: 5px;

            }*/

            #input1 {
                padding: 1px 0;
                border-radius: 3px;
                width: 150px;
                font-size: 15px;
                padding-left: 5px;
                margin-top: 20px;
                margin-left: -5px;
            }

            .txxt {
                background-color: #B09F8533;
                color: #B09F85;
                border: 1px solid #B09F85;

                padding: 1px 0;
                border-radius: 3px;
                width: 150px;
                font-size: 15px;
                padding-left: 5px;
                margin-top: 20px;
                margin-left: -5px;
            }

            

        </style>

        <!--meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="../img/logo.png">
        <link rel="shortcut icon" href="../img/logo.png">
        <link rel="manifest" href="../manifest.json">

        <!--file linked-->
        <link rel="stylesheet" href="../style.css">
        <script src="../node_modules/jquery/dist/jquery.js"></script>
        <script src="../node_modules/jquery/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="../../css-animation-lib/node_modules/animate.css/animate.css">
        <link rel="stylesheet" href="../../css-animation-lib/node_modules/animate.css/source/animate.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css"/>
    </head>
    <body>

        <div id="plant-menu-board">
            <h1 style="color: #B09F85; font-size: 29px; font-weight: 700; margin-top: 5vh;">Preferences</h1>
            <img src="../img/beta.svg" style="position: absolute; top: 5.5vh; left: 27px;">
            <div id="setting-box">
                <h1 style="font-size: 18px; margin-left: 15px;">Your Account</h1>
                <div class="input-change"></div>


                <div class="container">

                    <label><b>Name</b></label>
                    <span name="name" id='inputCont'><?php echo $name;?></span>
                    <button id='changebtn' style="cursor: pointer">Change</button>
                    <button id='savebtn' style="cursor: pointer">Save</button>

                </div>

                <div class="container">

                    <label style="margin-right: -103px;"><b>Email Address</b></label>
                    <span><?php echo $email;?></span>

                </div>

                <div class="container2">

                    <label style="margin-right: -70px;margin-bottom: 0px;" id="pwdl"><b>Password</b></label>
                    <span style="margin: 0; margin-left: 76px;" id='pwdicon'><img src="../img/lock.svg"></span>
                    <button id='changepwd' style="cursor: pointer">Change</button> 
                    <button id='savepwd' style="cursor: pointer">Save</button>                   

                </div>
            <a href="../includes/logout.php" id="logoit" style="background-color: none; padding: 0; margin-right: 0; margin-top: 20px;color: #9f2828;font-weight: 500; margin: auto;width: 280px">Logout</a>

            </div>

            <br>

            <nav id="menubar">
                <a href="menu" class="ab"><img src="../img/homew.svg"></a>
                <a href="info" class="ab "><img src="../img/info.svg" style="color: #B09F85"></a>
                <a href="health" class="ab"><img src="../img/h.svg"></a>
                <a href="settings" class="ab active"><img src="../img/setb.svg"></a>
            </nav>
        </div>

        <script>
        $(document).ready(function() {
            $("#savebtn").hide();
            $("#savepwd").hide();

            $("#changepwd").click(function() {
                $("#pwdl").hide();
                $("#savepwd").show();
                $("#changepwd").hide();

                var inputValue = $("#pwdicon");
                var newSpan = $("<input type='password' id='txxt' style='position: absolute; left: 55px;padding:0;border-radius: 3px;width: 130px;font-size: 15px;padding-left: 5px;margin-top: 20px;margin-left: -5px;'>");
                $("#pwdicon").replaceWith(newSpan);
            }); 


            $("#savepwd").click(function() {
                location.reload();
                location.reload();

                $("#changepwd").show();
                $("#savepwd").hide();

                var newpwd = $("#txxt").val();
                var id = <?php echo $userid;?>;

                console.log(id);

                var xhr = new XMLHttpRequest();  // create an XHR object
                xhr.open("POST", "cpwd.php", true);  // specify the HTTP method and URL
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  // set the request header
                //xhr.send("input=" + newName);  // send the request
                xhr.send(`input=${newpwd}&id=${id}`)
            });

            $("#savebtn").click(function() {
                    location.reload();
                    location.reload();

                /*
                    const inputName = document.getElementById('input1');
                    newName = inputName.value;

                    var span = document.createElement('span');
                    span.innerHTML = newName;
                    outputElement.replaceChild(span, newName);

                    console.log(newName);*/

                    var inputValue = $("#input1").val();
                    var newSpan = $("<span id='inputCont'>" + inputValue + "</span>");

                    var newName = inputValue;

                    $("#input1").replaceWith(newSpan);
                
                    $("#savebtn").hide();
                    $("#changebtn").show();
                    var id = <?php echo $userid;?>;

                    console.log(id);

                    var xhr = new XMLHttpRequest();  // create an XHR object
                    xhr.open("POST", "cname.php", true);  // specify the HTTP method and URL
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  // set the request header
                    //xhr.send("input=" + newName);  // send the request
                    xhr.send(`input=${newName}&id=${id}`)

                });
            
            const changeButton = document.getElementById('changebtn');
            const inputContainer = document.getElementById('inputCont');

            $(changeButton).click(function() {
                $("#changebtn").hide();
                $("#savebtn").show();

                const input = document.createElement('input');
                input.id = 'input1';
                input.type = 'text';
                input.value = inputContainer.textContent;
                inputContainer.parentNode.replaceChild(input, inputContainer);

                const savebtn = document.createElement('button');
                savebtn.id = 'savebtn';
                savebtn.innerHTML = 'Save';
                var container = document.getElementsByClassName('container');
                container.appendChild(savebtn);
                document.body.appendChild(container);
            });

            const inputElement = document.getElementById('input1');
            const outputElement = document.getElementById('container');

            
            
                /*
            const button = document.querySelector('button');
            const nameSpan = document.querySelector('span');*/
            const span = document.getElementById('testt');

            
            button.addEventListener('click', () => {
                const input = document.createElement('input');
                input.id = 'input1';
                input.type = 'text';
                input.style.width = '250px';
                input.value = span.textContent;
                span.parentNode.replaceChild(input, span);
                


                /*
                const newName = prompt('Enter a new name:');
                nameSpan.textContent = newName;
                
                var id = <?php echo $userid;?>;

                console.log(id);

                var xhr = new XMLHttpRequest();  // create an XHR object
                xhr.open("POST", "cname.php", true);  // specify the HTTP method and URL
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  // set the request header
                //xhr.send("input=" + newName);  // send the request
                xhr.send(`input=${newName}&id=${id}`)*/
            });

            $("#cpwd").click(function() {
                const newpwd = prompt('Enter a new password:');
                
                var id = <?php echo $userid;?>;

                console.log(id);

                var xhr = new XMLHttpRequest();  // create an XHR object
                xhr.open("POST", "cpwd.php", true);  // specify the HTTP method and URL
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");  // set the request header
                //xhr.send("input=" + newName);  // send the request
                xhr.send(`input=${newpwd}&id=${id}`)
            });

            





            


            var header = document.getElementById("menubar");
            var btns = header.getElementsByClassName("ab");
            for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
            });
            }
        });
            
        </script>
        <script src="../index.js"></script>
    </body>
</html>