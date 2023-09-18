<?php

session_start();
$conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");
$ipaddress = $_SERVER['REMOTE_ADDR'];
echo $_SESSION['userid'];

$db = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");

session_start();

// Check if the user is already logged in
if (isset($_SESSION['userid'])) {
    // Get the user's last login time from the database
    $userid = $_SESSION['userid'];
    $query = "SELECT last_login FROM users WHERE usersId = $userid";
    $result = $db->query($query);
    $row = $result->fetch_assoc();
    $last_login = $row['last_login'];

    // Compare the last login time with the current time
    $current_time = time();
    $time_since_login = $current_time - $last_login;

    // Check if the time since last login is less than 24 hours
    if ($time_since_login > 86400) {
        // If it is more than 24 hours, log the user out
        unset($_SESSION['userid']);
    } else {
        // If it is less than 24 hours, consider the user to be logged in
        header("Location: pages/menu");
    }
} 

?>
<html>
    <head>
        <title>Farmium</title>

        <!--meta tags-->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="img/logo.png">
        <link rel="shortcut icon" href="img/logo.png">
        <link rel="manifest" href="manifest.json">

        <!--file linked-->
        <link rel="stylesheet" href="style.css">
        <script src="/node_modules/jquery/dist/jquery.js"></script>
        <script src="/node_modules/jquery/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="../css-animation-lib/node_modules/animate.css/animate.css">
        <link rel="stylesheet" href="../css-animation-lib/node_modules/animate.css/source/animate.css">

        <script src="https://cdn.jsdelivr.net/npm/jquery.cookie@1.4.1/jquery.cookie.min.js"></script>

        <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css"
  />
    </head>
    <body>
        <!--first flow-->
        <div id="flow-1">
            <img src="img/logo.png" class="slide-left">
            <h1 id="flow-1-1" class="slide-right">Farmium</h1>
        </div>
        <div id="flow-2" class="slide-in-bottom">
            <h1 id="flow-2-1" class="slide-left2">Your plants</h1>
            <div id="flow-2-2" class="slide-in-right" style="margin-left: 160px;">One space</div> 
            <button id="flow-3-open" class="slide-in-bottom2">Lets Go!</button>
        </div>

        <div id="flow-3" class="fade-in">
            <div class="slider" id="main-slider">
                <div class="slider-wrapper">
                    <div class="slide" id="slide-1">
                        <h1 id="flow-3-1">Onboarding</h1>
                        <img src="img/onb1.png">
                        <h1 id="flow-3-2">Add your plants</h1>
                        <h1 id="flow-3-3">Scan your plants and add <br>them to your plant inventory</h1>
                    </div>

                    <div class="slide" id="slide-2">
                        <h1 id="flow-3-1">Onboarding</h1>
                        <img src="img/onb2.png">
                        <h1 id="flow-3-2">Learn How to Grow</h1>
                        <h1 id="flow-3-3">Get information about your plant <br> and its growth conditions</h1>
                    </div>
                    
                    <div class="slide" id="slide-3">
                        <h1 id="flow-3-1">Onboarding</h1>
                        <img src="img/obn3a.png" style="width: 85%;">
                        <h1 id="flow-3-2">Track the Growth</h1>
                        <h1 id="flow-3-3">Track your plant as they grow <br> so you wont missout on the action</h1>
                    </div>

                </div>
                <div class="slider-pagination">
                    <a href="#slide-1"></a>
                    <a href="#slide-2"></a>
                    <a href="#slide-3"></a>
                </div>
                <div class="slider-nav">
                    <button class="slider-previous"><img src="img/arleft.svg"></button>
                    <button class="slider-next"><img src="img/arright.svg"></button>
                    <button class="slider-reg"><img src="img/arcont.svg"></button>
                </div>
            </div>	
        </div>

        <div id="signup">
            <h1 id="sign-1-1">Create an Account</h1>
            <img src="img/sign1.png" style="width: 200px">
            <h1 id="sign-1-2">Lets track your plant’s <br>growth together</h1>

            <form action="includes/signup.php" method="post" name="signup">
                <input type="text" placeholder="Name" name="name" required>
                <input type="text" placeholder="Email Address" name="email" required>
                <input type="password" placeholder="Password" name="pwd" required>
                <br>
                <input type="submit" placeholder="Register" name="signup" value="Register" style="background-color:#B09F85;
    color: white;
    width: 280px;
    height: fit-content;
    padding: 17px;
    border-radius: 15px;
    border: none;
    text-align: left;
    font-size: 18px;">
            </form>
            <p id="sign-1-3">Have an account already? <span style="color: #B09F85; padding: 3px; border-radius: 5px; cursor: pointer; ">Log in</span></p>
        </div>

        
        <div id="login">
            <h1 id="sign-1-1">Log in</h1>
            <img src="img/sign1.png" style="width: 200px;">
            <h1 id="sign-1-2">Continue tracking your <br> plant’s growth</h1>
            
            <form action="includes/login.php" method="post" name="login">
                <input type="text" placeholder="Email Address" name="email">
                <input type="password" placeholder="Password" name="pwd">
                <br>
                <input type="submit" class="sub" placeholder="Login" name="login" value="Login">

            </form>
            <div id="forgotpwd"><p id="sign-1-3" style="color: #B09F85;"><u>Forgot password?</u></p></div>
            
            <p id="log-1-3" >Don't have an account? <span style="color: #B09F85; padding: 3px; border-radius: 5px; cursor: pointer;">Create one</span></p>

        </div>

        <script>
            $("#forgotpwd").click(function() {
                // Prompt for email
                var email = prompt("Please enter your email:");

                // Send email to server
                $.ajax({
                    type: 'POST',
                    url: 'includes/pwd.php',
                    data: { email: email },
                    success: function(response) {
                        console.log(response);
                    }
                });
            });
        </script>

        <script src="index.js"></script>
    </body>
</html>

<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "wronglogin") {
        echo "<script> alert('Wrong login!'); </script>";
    }
    if ($_GET["error"] == "stmtfailedd") {
        echo "<script> alert('No such user exists! Please register'); </script>";
    }
    if ($_GET["error"] == "emptyinput") {
        echo "<script> alert('Please dont leave a field empty!'); </script>";
    }
    if ($_GET["error"] == "thisemailistaken") {
        echo "<script> alert('This email is already taken!'); </script>";
    }
}
?>