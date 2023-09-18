<?php
session_start();

$conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");

$userid = $_SESSION['userid'];


if (!isset($_SESSION["userid"])) {
     echo "<script> alert('Please log in first!')
     window.location.replace('../index'); </script>";
} 

$sql = "SELECT plant_named, plant_type, lastWatered FROM userPlants WHERE UsersId = $userid";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $plantType = $row['plant_type'];
        $lastW = $row['lastWatered'];
        $plantName = $row['plant_named'];
    }
}


mysqli_close($conn);


$today = date_create(today);
$lastDate = date_Create($lastW);
$diff = date_diff($today, $lastDate);
  
$water = 7 +  $diff->format("%R%aD"); 
?>
<html>
    <head>
        <title>Farmium</title>

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
        <!--full container of the entire page-->
        <div id="plant-menu-board" style="position: relative;background-color: #E9EAE1;">
            <h1 style="color: #B09F85; font-size: 29px; font-weight: 700; margin-top: 5vh;">Your Plants</h1>

            <!--plus svg to add another plant-->
            <a href="../log/scan-plant"><img src="../img/dtc.svg" style="position: absolute; top: 5.5vh; right: 27px;"></a>
            
            <!--beta svg icon-->
            <img src="../img/beta.svg" style="position: absolute; top: 5.5vh; left: 27px;">

            <!--content of everything on page but the navbar-->
            <div id="plant-dash">

            <!--Each plant div stats-->
                <div id="plant-stat-1">
                    <!--plant icon-->
                    <img src="../img/cac.svg" style="float: right; margin-top: 10%; margin-right: 10px;">
                    
                    <!--plant nickname-->
                    <h1 id="ph-2" style="margin-left: 15px;margin-top: 8px;"><?php echo $plantName; ?></h1>

                    <!--plant type-->
                    <h1 id="ph-3" style="margin-left: 15px;margin-top: -8px;"><?php echo $plantType; ?></h1>

                    <!--watered date-->
                    <div id="watered">Watered <?php echo $diff->format("%a Days"); ?> Ago</div>
                
                    <!--health stat-->
                    <div id="health-stat">Health OK</div>

                    <!--watering date-->
                    <h1 id="ph-4" style="margin-left: 15px;margin-top: 15px;">Next watering in <?php echo $water; ?> Day</h1>
                </div>

                <!--log watering button-->
                <a href="../log/log-water.php" style="text-decoration: none;">
                    <div id="log-watering">
                        <h1 style="color: #3395ED; font-weight: 500; font-size: 17px;">Log Watering</h1>
                        <img src="../img/plusb.svg" style="float: right;margin-left: 145px;">
                    </div>
                </a>

                <!--check plant health button-->
                <a href="../log/plant-health.php" style="text-decoration: none;">
                    <div id="checkplant-health">
                        <h1 style="color: #689F28; font-weight: 500; font-size: 17px;">Check Plant's Health</h1>
                        <img src="../img/hg.svg" style="float: right; margin-left: 90px;">
                    </div>
                </a>
            </div>

            <div id="no-plant" style="display: none; padding: 30px;">
                <h1 style="font-size: 20px; color: #3D4D43; text-align: center">Seems like you haven't added any plants yet! Press on the "+" to add a plant. <br><br> Or reload the page</h1>
            </div>

            <!--navigation bar on bottom-->
            <nav id="menubar">
                <a href="menu" class="ab active" style="margin-left: 0px;"><img src="../img/home.svg"></a>
                <a href="info" class="ab"><img src="../img/info.svg"></a>
                <a href="health" class="ab"><img src="../img/h.svg"></a>
                <a href="settings" class="ab"><img src="../img/settings.svg"></a>
            </nav>

            <div style="background-color: #E9EAE1; position: fixed; bottom: 0; width: 355px;height: 14vh;z-index: -1;"></div>
        </div>

        <?php
        if (mysqli_num_rows($result) == 0) {
            echo "<script> 
            $('#plant-dash').hide();
            $('#no-plant').show();
            </script>";
        }
        ?>

        <script src="fetch.js"></script>
        <script>
            $(document).ready(function() {
                $("#log-watering").click(function() {
                    window.open('start', '_self');
                });

            });
        </script>

        <script src="index.js"></script>

        <script>
              $(document).ready(function() {

             

                window.onscroll = function() {myFunction()};

                var navbar = document.getElementById("menubar");
                var sticky = navbar.offsetTop;

                function myFunction() {
                    if (window.pageYOffset >= sticky) {
                        navbar.classList.add("sticky")
                    } else {
                        navbar.classList.remove("sticky");
                    }
                }

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
    </body>
</html>