<?php
session_start();

// db connection
$conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");
$userid = $_SESSION['userid'];

//expired user session
if (!isset($_SESSION["userid"])) {
  echo "<script> alert('Please log in first!')
  window.location.replace('../index'); </script>";
} 

// db existing plants
$sql = "SELECT plant_named, plant_type, lastWatered FROM userPlants WHERE UsersId = $userid";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
    $plantType = $row['plant_type'];
    $lastW = $row['lastWatered'];
    $plantName = $row['plant_named'];
  }

}

  // Close the database connection
  mysqli_close($conn);

  $today = date_create(today);
  $lastDate = date_Create($lastW);
  $diff = date_diff($today, $lastDate);
  
  $water = 7 +  $diff->format("%R%aD");

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

        <div id="watering-start" style="position: relative">
            <h1 style="margin-top: 5vh; color: #B09F85; font-size: 27px;">Choose your plant</h1>

            <img src="../img/arrowleft.svg" onclick="history.back();" style="position: absolute; top: 5.5vh; left: 1vw;">

            <div id="plant-stat-1" style="height: 230px;">

              <form id="time-form1" action="../includes/time.php" method="post">

                <h1 style="font-size: 18px; font-weight: 600; color: #3D4D43; margin-left: 20px; margin-top: -40px;"><?php echo $plantName;?></h1>

                <h1 style="font-size: 16px; font-weight: 300; color: #3D4D43; margin-left: 20px; margin-top: 0px;"><?php echo $plantType;?></h1>

                <div id="watered" style="display: flex; align-items: center;font-size: 15px;">
                  <img src="../img/drop.svg">Watered <?php echo $diff->format("%R%aD"); ?> Ago
                </div>
                      
                <div id="health-stat" style="display: flex; align-items: center;font-size: 15px;">
                  <img src="../img/dropg.svg" style="width: 16px;margin-left: 2px; margin-right: 1px;">Can be watered
                </div>

                <h1 id="ph-4" style="margin-left: 15px;margin-top: 9px;">Next watering in <?php echo $water; ?> Day</h1>

                <button id="log-water-btn">Log watering <img src="../img/dropw.svg"></button>
            </form>

              </div>

              <!--<button id="confirm-plants">Done</button>-->
            
        </div>

        <script>
        $(document).ready(function() {
          $("#confirm-plants").hide();
          $("#log-water-btn").click(function() {
            $("#time1").show();
            $("#time1").focus();
            $("#confirm-plants").show();
          })
        });
        </script>

        <script src="../index.js"></script>
      </body>
</html>