<?php
session_start();

$conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");

$userid = $_SESSION['userid'];

if (!isset($_SESSION["userid"])) {
    echo "<script> alert('Please log in first!')
    window.location.replace('../index'); </script>";
} 


$sql = "SELECT plant_named, plant_type, lastWatered, next_watering FROM userPlants WHERE UsersId = $userid";
  $result = mysqli_query($conn, $sql);

  // Check if there are any results
  if (mysqli_num_rows($result) > 0) {

    // Loop through the results and display the plant name and date of last watered
    while($row = mysqli_fetch_assoc($result)) {
      $plantType = $row['plant_type'];
      $lastW = $row['lastWatered'];
      $plantName = $row['plant_named'];
      $nextwatering = $row['next_watering'];

    }

  }

  $query = "UPDATE userPlants SET next_watering = 'new_value' WHERE usersId = '20' ";

    mysqli_query($conn, $query);
    mysqli_close($conn);


  // Close the database connection
  mysqli_close($conn);

  
  $today = date_create(today);
  $lastDate = date_Create($lastW);
  $diff = date_diff($today, $lastDate);

  $water = $diff->format("%a");



  

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
        <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; minimum-scale=1.0; user-scalable=0;" />
        <meta name="apple-mobile-web-app-capable" content="yes" />

        <!--file linked-->
        <link rel="stylesheet" href="../style.css">
        <script src="../node_modules/jquery/dist/jquery.js"></script>
        <script src="../node_modules/jquery/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="../../css-animation-lib/node_modules/animate.css/animate.css">
        <link rel="stylesheet" href="../../css-animation-lib/node_modules/animate.css/source/animate.css">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css"/>
    </head>
    <body>
        <!--content-->
        <div id="plant-menu-board" style="background-color: #E9EAE1;">
            <h1 style="color: #B09F85; font-size: 29px; font-weight: 700; margin-top: 5vh;">Plant Activity</h1>
            <!--add plant icon-->
            <a href="../log/scan-plant"><img src="../img/dtc.svg" style="position: absolute; top: 5.5vh; right: 27px;"></a>

            <!--beta icon svg-->
            <img src="../img/beta.svg" style="position: absolute; top: 5.5vh; left: 27px;">

            <!--plant content-->
            <div id="plant-dash">

                <!--individual polant div-->
                <div id="plant-stat-1health">
                    <!--plant icon-->
                    <img src="../img/caccut.svg" style="float: right; width: 55px;margin-top: -5px; margin-right: 10px;z-index: 1;">
                    <!--plant nickname-->
                    <h1 id="ph-2" style="margin-left: 15px;margin-top: 8px;"><?php echo $plantName; ?></h1>
                    <!--plant type-->
                    <h1 id="ph-3" style="margin-left: 15px;margin-top: -8px;"><?php echo $plantType; ?></h1>

                    <!--water and health container-->
                    <div id="info-bg">

                        <div id="next-watering" style="position: relative;width: 255px;background: none; color: #3D4D43; font-size: 15px;">
                            <p>Last watered</p>
                            <p class="bttn" style="position: absolute; right: 0px; top: 42px;float: right;"><?php echo $water;?> Days Ago</p>
                        </div>

                        <div id="next-watering" style="position: relative;width: 255px;background: none;margin-top: -5px;font-size: 15px;color: #3D4D43">
                            <p>Last health check</p>
                            <p class="bttn" style="position: absolute; right: 0px; top: 42px;background-color: #689F28;float: right;"><?php echo $water;?> Days Ago</p>
                        </div>
                        <!--
                        <div id="wtred">
                            <p style="margin-left: 10px;">Last Watered</p>
                            <p class="bttn"><?php echo $diff->format("%R%a Days");?> Ago</p>

                            <p style="margin-left: 10px;margin-top: -8px;">Last Health Check</p>
                            <p class="bttng"> ~ Ago</p>
                        </div>-->
                    </div>

                    <!--watering date button-->
                    <div id="next-watering" style="position: relative;width: 265px; font-size: 15px;">
                        <p>Next watering</p>
                        <p class="bttn" style="position: absolute; right: 0px; top: 42px;float: right;">In <?php echo $nextwatering;?> Days</p>
                    </div>

                    <!--plant health check status button-->
                    <div id="next-watering" style="background-color: #689F281A; color: #689F28;font-size: 15px;position: relative;width: 265px;">
                        <p>Plant health</p>
                        <p class="bttn" style="position: absolute; right: 0px; top: 42px; background-color: #689F28; float: right;">OK</p>
                    </div>



                    <!--log watering button-->
                    <a href="../log/log-water.php" style="text-decoration: none;">
                        <div id="log-waterings1">Log watering <img src="../img/dropw.svg" style="float: right"></div>
                    </a>
                    
                    <!--plant health check button-->
                    <a href="../log/plant-health.php" style="text-decoration: none;">
                        <div id="PH1">Check plant health <img src="../img/h.svg" style="float: right"></div>
                    </a>
                    
                    
                </div>

                <div id="no-plant" style="display: none; padding: 30px;">
                    <h1 style="font-size: 20px; color: #3D4D43; text-align: center">Seems like you haven't added any plants yet! Press on the "+" to add a plant</h1>
                </div>

                <!--navigation bar-->
                <nav id="menubar">
                    <a href="menu" class="ab"><img src="../img/homew.svg"  style="margin-left: 0px;"></a>
                    <a href="info" class="ab "><img src="../img/info.svg" style="color: #B09F85"></a>
                    <a href="health" class="ab active"><img src="../img/hb.svg"></a>
                    <a href="settings" class="ab"><img src="../img/settings.svg"></a>

                </nav>

            </div>

            <?php
        if (mysqli_num_rows($result) == 0) {
            echo "<script> 
            $('#plant-stat-1health').hide();
            $('#no-plant').show();
            </script>";
        }
        ?>
        </div>

        <script type="text/javascript">

        // Replace YOUR_API_KEY with your actual API key
        const apiKey = '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';

        // The prompt or text to feed GPT-3
        const prompt = 'how often to water <?php echo $plantType;?>, give a number, no explanation, give the numbers in speechmarks, only numbers, one number no range.';

        // The API endpoint for generating text
        const url = 'https://api.openai.com/v1/completions';

        // Set the headers for the API request
        const headers = {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + apiKey
        };

        // Set the options for the API request
        const data = JSON.stringify({
            prompt: prompt,
            model: 'text-davinci-003',
            max_tokens: 200,
            top_p: 1,
            temperature: 0
        });

        // Send the API request and get the response
        fetch(url, {
            method: 'POST',
            headers: headers,
            body: data
        })
        .then(response => response.json())
        .then(responseData => {
            // Get the generated text from the response
            const generatedText = responseData.choices[0].text;
            // Do something with the generated text
            console.log(generatedText);

            // Create the h1 element
            const h1 = document.getElementById("nextwat");

            // Set the text for the h1 element
            

            let newString = generatedText.replace(/\"/g, "");

            let nextwa = "In" + newString + " Days";

            h1.textContent = nextwa;
            

        })
        .catch(error => {
            console.error(error);
        });
        
        </script>

        <script>
            var header = document.getElementById("menubar");
            var btns = header.getElementsByClassName("ab");
            for (var i = 0; i < btns.length; i++) {
            btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
            });
            }
        </script>
        <script src="../index.js"></script>
    </body>
</html>
<?php

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}





?>