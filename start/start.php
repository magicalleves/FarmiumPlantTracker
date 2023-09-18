<?php
session_start();

$conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");

$userid = $_SESSION['userid'];
/*
if (isset($_SESSION["useruid"])) {
     echo "logged in<br><br>";
     echo $_SESSION["userid"];
     echo "<a href='includes/logout.php' style='margin: ;'>Log out</a>";
}
else {
     echo "<script> alert('Please log in first!')
     window.location.replace('../index'); </script>";
}*/

$sql = "SELECT plant_named, plant_type, lastWatered FROM userPlants WHERE UsersId = $userid";
  $result = mysqli_query($conn, $sql);

  // Check if there are any results
  if (mysqli_num_rows($result) > 0) {

    // Loop through the results and display the plant name and date of last watered
    while($row = mysqli_fetch_assoc($result)) {
      $plantType = $row['plant_type'];
      $lastW = $row['lastWatered'];
      $plantName = $row['plant_named'];
    }

  }

  // Close the database connection
  mysqli_close($conn);

?>

<!DOCTYPE html>
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
<!--
        <div id="start-plants">
            <input type="file" name="photo" id="file" onchange="return fileValidation(), sendIdentification()" style="position: absolute;" required>

            <h1 style="margin-top: 5vh; color: #B09F85; font-size: 27px;">Getting started</h1>
            <p style="color: #3D4D43; font-size: 17px; font-weight: 600; margin-top: 10vh">Lets add your plants to Farmium</p>

            <button id="add-plant-btn">Scan Plant <img src="img/plus-white.svg" style="float:right;"></button>
            <img src="img/onb1.png" id="onb1">

            <h1 id="invt">Inventory</h1>
            <div id="added-plant-container">
            </div>

            <button id="confirm-plants">Done</button>
        </div>
-->


        <div id="watering-start">
            <h1 style="margin-top: 5vh; color: #B09F85; font-size: 27px;">Getting started</h1>
            <h1 id="watr">Watering</h1>
            <h2 id="watr" style="margin-top: 10px;margin-left: -15px; font-size: 19px;">Log watering <?php echo $plantName;?> last watered?</h2>

            <div id="plant-1a" style="position: relative;">
                    <form id="time-form" action="../includes/time.php" method="post">
                        <!--<input type="date" id="time" name="time" required>-->
                    <button id="log-water-btn" style="position: absolute; left: 130px; top: 12px;">Log watering<img src="../img/dropw.svg"></button>
                    <button id="log-water-btn" style="position: absolute; left: 130px; top: 12px;background-color: green;display: none">Saved<img src="../img/dropw.svg"></button>

                        

                    <h1 style="font-size: 18px; font-weight: 600; color: #3D4D43; margin-left: 20px; margin-top: 15px;"><?php echo $plantName;?></h1>

                    <h1 style="font-size: 16px; font-weight: 300; color: #3D4D43; margin-left: 20px; margin-top: -5px;"><?php echo $plantType;?></h1>

            </div>

            <button id="confirm-plants">Done</button>
            </form>


        </div>
  

        <script>
        $(document).ready(function() {
          $("#confirm-plants").show();

          $("#log-water-btn").click(function() {
            $("#log-water-btn").hide();
            $("#saved").fadeIn();
          });
        });
        </script>
        <script src="../index.js"></script>
        </script>
    </body>
</html>