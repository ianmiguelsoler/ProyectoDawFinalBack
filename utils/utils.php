<?php
// Permitir CORS
// utils.php
header("Access-Control-Allow-Origin: *");  // ✅ Mantén solo este si decides manejar CORS en PHP
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

function getResponse($code = 200, $status = "", $message = "", $data = "") {
    $response = array(
        "status" => $status,
        "message" => $message,
        "data" => $data
    );

    header("Content-Type: application/json");
    http_response_code($code);
    return json_encode($response, JSON_UNESCAPED_UNICODE);
}
