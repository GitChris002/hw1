<?php
header('Content-Type: application/json');


function inviaRichiestaOpenAI($conversazione) {
    $api_key = '';
    $url = 'https://api.openai.com/v1/chat/completions';
    

    if (count($conversazione) > 10) {
        $conversazione = array_slice($conversazione, -10);
    }

    $data = array(
        'model' => 'gpt-3.5-turbo',
        'messages' => $conversazione,
        'max_tokens' => 300, 
        'temperature' => 0.7
    );

    $headers = array(
        'Content-Type: application/json',
        'Authorization: Bearer ' . $api_key
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30); 

    $response = curl_exec($ch);
    curl_close($ch);

    file_put_contents('log.txt', print_r($response, true), FILE_APPEND);

    return json_decode($response, true);
}

$conversazione = json_decode($_POST['conversazione'], true) ?? [];

$risposta = inviaRichiestaOpenAI($conversazione);

if (!isset($risposta['choices'])) {
    echo json_encode([
        'errore' => 'Risposta non valida dall\'API di OpenAI',
        'dettagli' => $risposta
    ]);
} else {

    echo json_encode(['risposta' => $risposta['choices'][0]['message']['content']]);
}
?>
