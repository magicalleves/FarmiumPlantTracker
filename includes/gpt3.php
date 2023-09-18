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

// Replace YOUR_API_KEY with your actual API key
$apiKey = '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';

// The prompt or text to feed GPT-3
$prompt = $plantType . '. First value about care difficulty of the plant. Second value is about how wet the soil should get after each watering make sure the user will understand it. Third value about the amount of sun exposure of the plant. choose a value between the values of Low, Partial and High. Fourth value about the toxicity of the plant in max 3 words make sure to give detail of what the plant is toxic to in one value and make sure its in 3 words maximum. Write all values seperated with commas.';

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


$sql2 = "UPDATE userPlants SET care_diff = '$array[0]', sun_exp = '$array[1]', watering = '$array[2]', dangers = '$array[3]' WHERE UsersId = '12'";
mysqli_query($conn, $sql2);
mysqli_close($conn);
?>
