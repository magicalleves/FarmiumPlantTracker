<?php
session_start();

$conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");

$userid = $_SESSION['userid'];

if (!isset($_SESSION["userid"])) {
    echo "<script> alert('Please log in first!')
    window.location.replace('../index'); </script>";
}


$sql = "SELECT plant_named, plant_type, lastWatered, care_diff, sun_exp, watering, dangers FROM userPlants WHERE UsersId = $userid";
$result = mysqli_query($conn, $sql);

// Check if there are any results
if (mysqli_num_rows($result) > 0) {

    // Loop through the results and display the plant name and date of last watered
    while ($row = mysqli_fetch_assoc($result)) {
        $plantType = $row['plant_type'];
        $lastW = $row['lastWatered'];
        $plantName = $row['plant_named'];
        $carediff = $row['care_diff'];
        $sunexp = $row['sun_exp'];
        $watering = $row['watering'];
        $dangers = $row['dangers'];
    }
}

// Close the database connection
mysqli_close($conn);

$today = date_create(today);
$lastDate = date_Create($lastW);
$diff = date_diff($today, $lastDate);

// Use the OpenAI API to generate text using GPT-3
/*
// Replace YOUR_API_KEY with your actual API key
$apiKey = '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';

// The prompt or text to feed GPT-3
$prompt = $plantType . '. First value about care difficulty of the plant. Second value is about how wet the soil should get after each watering make sure the user will understand it. Third value about the amount of sun exposure of the plant. choose a value between the values of Low, Partial and High. Fourth value about the toxicity of the plant in max 3 words make sure to give detail of what the plant is toxic to in one value and make sure its in 3 words maximum. Write all values seperated with commas.
';
// The API endpoint for generating text
$url = 'https://api.openai.com/v1/completions';

// Set the headers for the API request
$headers = array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey
);

// Set the options for the API request
$options = array(
    'http' => array(
        'method' => 'POST',
        'header' => implode("\r\n", $headers),
        'content' => json_encode(array(
            'prompt' => $prompt,
            'model' => 'text-davinci-003',
            'top_p' => 1,
            'temperature' => 0.5,
            'max_tokens' => 130
        ))
    )
);

// Create a context for the API request
$context = stream_context_create($options);

// Send the API request and get the response
$response = file_get_contents($url, false, $context);

// Decode the JSON response
$responseData = json_decode($response, true);

// Get the generated text from the response
$generatedText = $responseData['choices'][0]['text'];

$array = explode(', ', $generatedText);

*/
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />
</head>

<body>
    <div id="plant-menu-board" style="background-color: #E9EAE1;">
        <h1 style="color: #B09F85; font-size: 29px; font-weight: 700; margin-top: 5vh;">About Plants</h1>

        <a href="../log/scan-plant"><img src="../img/dtc.svg" style="position: absolute; top: 5.5vh; right: 27px;"></a>


        <img src="../img/beta.svg" style="position: absolute; top: 5.5vh; left: 27px;">

        <div id="plant-dash">

            <div id="plant-stat-1info">
                <img src="../img/cact.svg" style="float: right; margin-top: 30%; margin-right: 10px;">
                <h1 id="ph-2" style="margin-left: 15px;margin-top: 8px;"><?php echo $plantName; ?></h1>
                <h1 id="ph-3" style="margin-left: 15px;margin-top: -8px;"><?php echo $plantType; ?></h1>


                <div id="diff">
                    <img src="../img/smile.svg" style="float: right; margin-top: 8%;margin-right: 10px;">
                    <p style="color: #3D4D43;margin-top: 3px;">Care difficulty</p>
                    <p id="difftext" style="margin-top: -15px;"><?php echo $carediff; ?></p>
                </div>
                <div id="sun">
                    <img src="../img/sun.svg" style="float: right; margin-top: 8%;margin-right: 10px;">

                    <p style="color: #3D4D43;margin-top: 3px;">Sun Exposure</p>
                    <p style="margin-top: -15px;"><?php echo $sunexp; ?></p>
                </div>
                <div id="wtr">
                    <img src="../img/drop.svg" style="float: right; margin-top: 8%;margin-right: 10px;">

                    <p style="color: #3D4D43;margin-top: 3px;">Watering</p>
                    <p style="margin-top: -15px;"><?php echo $watering; ?></p>
                </div>
                <div id="dangers">
                    <img src="../img/dang.svg" style="float: right; margin-top: 8%;margin-right: 10px;">

                    <p style="color: #3D4D43;margin-top: 3px;">Dangers</p>
                    <p style="margin-top: -15px;"><?php echo $dangers; ?></p>
                </div>

            </div>




            <a href="../log/log-water.php" style="text-decoration: none;">
                <div id="log-watering">
                    <h1 style="color: #3395ED; font-weight: 500; font-size: 17px;">Log Watering</h1>
                    <img src="../img/plusb.svg" style="float: right;margin-left: 145px;">
                </div>
            </a>

            <a href="../log/plant-health.php" style="text-decoration: none;">
                <div id="checkplant-health">
                    <h1 style="color: #689F28; font-weight: 500; font-size: 17px;">Check Plant's Health</h1>
                    <img src="../img/hg.svg" style="float: right; margin-left: 90px;">
                </div>
            </a>

        </div>

        <div id="no-plant" style="display: none; padding: 30px;">
            <h1 style="font-size: 20px; color: #3D4D43; text-align: center">Seems like you haven't added any plants yet! Press on the "+" to add a plant</h1>
        </div>

        <nav id="menubar">
            <a href="menu" class="ab"><img src="../img/homew.svg" style="margin-left: 0px;"></a>
            <a href="info" class="ab active"><img src="../img/infob.svg" style="color: #B09F85"></a>
            <a href="health" class="ab"><img src="../img/h.svg"></a>
            <a href="settings" class="ab"><img src="../img/settings.svg"></a>

        </nav>

    </div>

    <?php
    if (mysqli_num_rows($result) == 0) {
        echo "<script> 
            $('#plant-dash').hide();
            $('#no-plant').show();
            </script>";
    }
    ?>

    <script>
        $(document).ready(function() {
            var plantlatn = document.getElementById('ph-3');
            var pltn = plantlatn.textContent;

            $("#btnapi").click(function() {
                const settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "https://house-plants.p.rapidapi.com/latin/philodendron",
                    "method": "GET",
                    "headers": {
                        "X-RapidAPI-Key": "07090a677cmsh481c32c3e2370cdp103244jsn7bef1b42e713",
                        "X-RapidAPI-Host": "house-plants.p.rapidapi.com"
                    }
                };

                $.ajax(settings).done(function(response) {
                    console.log(response);
                });
            });

            var header = document.getElementById("menubar");
            var btns = header.getElementsByClassName("ab");
            for (var i = 0; i < btns.length; i++) {
                btns[i].addEventListener("click", function() {
                    var current = document.getElementsByClassName("active");
                    current[0].className = current[0].className.replace(" active", "");
                    this.className += " active";
                });
            };
        });

        const div2 = $("#diff");
        const p = $("p", div2);

        if (p.text().includes("Low")) {
            div2.css("background-color", "#248A3D1A");
        } else if (p.text().includes("Moderate")) {
            div2.css("background-color", "#248A3D1A");
        }
    </script>
    <script src="../index.js"></script>
</body>

</html>