<?php
session_start();

//connection to db
$conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");
$userid = $_SESSION['userid'];

//expired session user
if (!isset($_SESSION["userid"])) {
    echo "<script> alert('Please log in first!')
    window.location.replace('../index'); </script>";
} 

//delete function of plant
if (isset($_POST['deletePlant'])) {
    $deletePlant = $_POST['deletePlant'];

    switch($deletePlant) {
        case 'deletePlant';
        deletePlant();
        break;
    default:
        break;
    }
    echo "<script> $('#add-plant-btn').show();</script>";

}
function deletePlant() {
    $conn = mysqli_connect("localhost", "u682141182_farmium", "Farmium123", "u682141182_webapp");
    $userid = $_SESSION['userid'];
    $sql = "DELETE FROM userPlants WHERE usersId = $userid";

    mysqli_query($conn, $sql);  

    echo "<script> $('#add-plant-btn').show();</script>";

}


//selects existing plants from db
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
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Farmium</title>
        <style>
            html, body {
                overflow-y: visible;
            }
            .plant {
                position: relative;
            }
        
            .dele {
                color: red;
                cursor: pointer;
                text-decoration: none;
                font-size: 16px;
                font-weight: 100;
                position: absolute;
                right: 32%;
                top: 85px;
                background-color: #9F28281A;
                height: 37px;
                width: 120px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #9F2828;
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
        <!--background border-->
        <div id="start-plants" style="background-color: #E9EAE1;">
        
        
            <!--hidden input btn-->
            <input type="file" name="photo" id="file" onchange="return fileValidation(), sendIdentification()" style="position: absolute;" required>

            <h1 style="margin-top: 5vh; color: #B09F85; font-size: 27px;">Plant manager</h1>
            <p style="color: #3D4D43; font-size: 17px; font-weight: 600; margin-top: 10vh">Lets add your plants to Farmium</p>  

            <button id="add-plant-btn">Scan Plant <img src="../img/plus-white.svg" style="float:right;"></button>
            <br>

            <h1 id="invt">Your plant</h1>
            <div id="added-plant-container">
                
                <?php
                if (mysqli_num_rows($result) > 0) {

                    echo '<div class="plant">';
                
                    // Loop through the results and display the plant name and date of last watered
                    while($row = mysqli_fetch_assoc($result)) {
                      $plantType = $row['plant_type'];
                      $lastW = $row['lastWatered'];
                      $plantName = $row['plant_named'];
                    }

                    echo "<script> $('#add-plant-btn').hide();</script>";
                
                    
                echo '<img src="../img/cac1.svg" style="float: right; margin-right: 0; margin-bottom: 15px;">
                        <h1 class="adp-1"><?php echo $plantName; ?>'.$plantName.'</h1>
                        <h1 class="plant-common-name">'.$plantType.'</h1>
                        <h1 class="dele">Delete</h1>
                    </div>';
                  } else if (mysqli_num_rows($result) < 0) {
                    echo "<script> $('#add-plant-btn').show();</script>";
                  }
                ?>
            </div>

            <button id="confirm-plants">Done</button>

        </div>

        <script src="../index.js"></script>

        <!--Image searching API-->
        <script type="text/javascript">

        var counter = 0;

            //Plant indectifiation thing ---------------------------------------------------------------------------
            function sendIdentification() {
                const files = [...document.querySelector('input[type=file]').files];
                const promises = files.map((file) => {
                return new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        const res = event.target.result;
                        console.log(res);
                        resolve(res);
                    }
                    reader.readAsDataURL(file)
                })
                })
                
                Promise.all(promises).then((base64files) => {
                console.log(base64files)
                        
                const data = {
                    
                    api_key: "kDuvxVTXrfFfjyMrxJEziZEYRJD5zeIps1m5NQNI7oeBPlPRqD",
                    images: base64files,
                    // modifiers docs: https://github.com/flowerchecker/Plant-id-API/wiki/Modifiers
                    modifiers: ["crops_fast", "similar_images"],
                    plant_language: "en",
                    // plant details docs: https://github.com/flowerchecker/Plant-id-API/wiki/Plant-details
                    plant_details: ["common_names",
                                    "url",
                                    "name_authority",
                                    "wiki_description",
                                    "taxonomy",
                                    "synonyms"],
                };
                
                fetch('https://api.plant.id/v2/identify', {
                    method: 'POST',
                    headers: {
                    'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                })
                .then(response => response.json())
                .then(data => {
                    

                    console.log('Success Plant.id API:', data);

                    $("#onb1").hide();
                    $("#invt").show();
                    $("#added-plant-container").show();
                    $("#confirm-plants").show();



                    const options = {
                        method: 'GET',
                        headers: {
                            'X-RapidAPI-Key': '07090a677cmsh481c32c3e2370cdp103244jsn7bef1b42e713',
                            'X-RapidAPI-Host': 'house-plants.p.rapidapi.com'
                        }
                    };

                    fetch('https://house-plants.p.rapidapi.com/latin/' + pCN, options)
                        .then(response => response.json())
                        .then(response => console.log(response))
                        .catch(err => console.error(err));




                    counter++;

                    var pCN = data.suggestions[0].plant_details.common_names[0];


                    var addedPlant = document.createElement("div");
                    addedPlant.setAttribute('class', 'plant');
                    addedPlant.style.marginBottom = '15px';

                    var addedPI = document.createElement('img');
                    addedPI.setAttribute('id', 'deletePlant');
                    addedPI.src = '../img/cac1.svg';
                    addedPI.style.float = 'right';

                    var del = document.createElement('img');
                    del.setAttribute('id', 'deletePlant');
                    del.src = '../img/minus.svg';
                    del.style.float = 'right';

                    var addedPI1 = document.createElement('div');
                    addedPI1.textContent = '-';
                    addedPI1.style.fontSize = '20px';

                    var addedPT1 = document.createElement('h1');
                    addedPT1.setAttribute('class', 'adp-1');
                    var named = prompt("Please enter a name for your plant", "Bob");
                    addedPT1.innerHTML = named;
                    //addedPT1.innerHTML = 'Bob';

                    var r = document.createElement('div');
                    r.setAttribute('id', 'r' + counter);
       
                    var addedPT2 = document.createElement('h1');
                    addedPT2.setAttribute('class', 'plant-common-name');

                    addedPT2.style.fontSize = '16px';
                    addedPT2.style.fontWeight = '600';
                    addedPT2.style.marginLeft = '20px';
                    addedPT2.style.marginTop = '-8px';

                    var dele = document.createElement("h1");
                    dele.setAttribute('class', 'dele');
                    dele.textContent = "Delete";    

                    addedPT2.textContent = pCN;

                    addedPlant.appendChild(addedPI);
                    addedPlant.appendChild(addedPT1);
                    addedPlant.appendChild(addedPT2);
                    addedPlant.appendChild(dele);



                    document.getElementById("added-plant-container").appendChild(addedPlant);

                    var btn = document.getElementById('add-plant-btn');

                    $(".dele").click(function() {
                        $(this).closest("div").remove();
                        $.ajax ({
                        type: "POST",
                        url: "scan-plant.php",
                        data: {deletePlant: 'deletePlant'}
                    });
                    });


        })
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
                }
            ;
    
            
           

            $("#confirm-plants").click(function() {

                

                const plantContainer = document.getElementById('added-plant-container');

                const plants = plantContainer.querySelectorAll('.plant');

                const plantData = [];

                for (const plant of plants) {
                    const uid = <?php echo $_SESSION["userid"];?>;
                    const named = plant.querySelector('.adp-1').textContent;
                    const sN = plant.querySelector('.plant-common-name').textContent;
                    const scientificName = sN;

                    plantData.push({ uid, named, scientificName});
                }

                console.log(`Number of plants: ${plantData.length}`);
                console.log('Plant data:', plantData);

                

                if (plantData.length > 1 ) {
                    alert("Sorry! During our beta release, the max number of plants is one. Please continue by removing the rest plants.");
                } else if (!plantData.length) {
                    alert("You haven't added any plants! Please add one to continue");
                } else {

                    var plantArray = [{
                        userid: <?php echo $_SESSION["userid"];?>,
                        plant_named: plantData[0].named,
                        plant_type: plantData[0].scientificName
                    }];

                    $.ajax({
                        url: '../includes/save.php',
                        type: 'POST',
                        data: {plantArray: plantArray},
                        success: function(response) {
                            console.log(response);
                        }   
                    });
                    window.open("../includes/gpt3-data.php","_self");
                };

                

                

        });

        $(".dele").click(function() {
            $("#add-plant-btn").show();
            $(this).closest("div").remove();
            $.ajax ({
                type: "POST",
                url: "scan-plant.php",
                data: {deletePlant: 'deletePlant'}
            });
        });

        $("#deletePlant").click(function() {
            $.ajax ({
                type: "POST",
                url: "scan-plant.php",
                data: {deletePlant: 'deletePlant'}
            });
            
            var parent = $(this).parent();
            parent.remove();
        });

        $('#add-plant-btn').click(function() {
            $('#file').click();
        });
        </script>
    </body>
</html>