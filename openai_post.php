<?php
header('Content-Type: application/json');
$message = file_get_contents('php://input'); 
$apiKey = 'YOUR_API_KEY';
$endpoint = 'https://api.openai.com/v1/chat/completions';

$file = fopen('logIA.txt','w');
fwrite($file, '  Inicio de registros:  ');
$decodedData = json_decode($message, true);
$texto = $decodedData['text'];
fwrite($file, $message);
fwrite($file, $texto);

//$texto ="hola";

$mensajes = [
    [
        'role' => 'system',
        'content' => 'Eres un asistente útil.'
    ],
    [
        'role' => 'user',
        'content' => 'Por favor, extrae la información de factura, fecha (en formato dd-mm-yyyy) y subtotal del siguiente texto:\n' . $texto . ', el subtotal puede presentarse como SUBTTL, SUBITL, Subtotal o SUBTIL, ejemplos de valores del Subtotal, 0001-102-0000001217, TFBX110050311-00408073, el numero esta precedido por No. y contiene cerca de 20 caracteres numericos, por favor devuelve la información en formato JSON con estos campos: factura - fecha -subtotal -numero'
    ]
];

$data = array(
    'model' => 'gpt-3.5-turbo',
    'messages' => $mensajes,
    'max_tokens' => 300,
    'temperature' => 0.3
);

$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer openaiapikey'
));

$response = curl_exec($ch);
curl_close($ch);

//echo $response;

$result = json_decode($response, true);

echo $result['choices'][0]['message']['content'];
fwrite($file, $result['choices'][0]['message']['content']);

?>
