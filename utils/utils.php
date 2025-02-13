<?php

function getResponse($code = 200, $status = "", $message = "", $data = null) {
    header("Content-Type: application/json");
    http_response_code($code);
    return json_encode([
        "status" => $status,
        "message" => $message,
        "data" => $data
    ], JSON_UNESCAPED_UNICODE);
}
