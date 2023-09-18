<?php

// Replace YOUR_API_KEY with your actual API key
$apiKey = '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';

// The prompt or text to feed GPT-3
$prompt = '. Write down the number of days that the plant has to be watered. give one value no range and no explanation at all.';
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
            'top_p' => 0,
            'temperature' => 0,
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

echo $generatedText;
?>