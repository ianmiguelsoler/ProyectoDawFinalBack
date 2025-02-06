<?php
// Permitir CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

//Quiero que todas las respuestas tengan el mismo formato, para ello me creo una función que me devuelve la respuesta
function getResponse($code=200, $status="",$message="",$data="") {
    $response = array(
        "status"=>$status,
        "message"=>$message,
        "data"=>$data
    );

    header("Content-Type:application/json");
    http_response_code($code);
    return json_encode($response,JSON_UNESCAPED_UNICODE);
}
 