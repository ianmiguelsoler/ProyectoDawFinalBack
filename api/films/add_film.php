<?php
require_once "../../utils/utils.php";
require_once "../db/db.php";

// ✅ Manejo de OPTIONS sin encabezados CORS en PHP
if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    http_response_code(200);
    exit();
}

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $jsonBody = file_get_contents('php://input');
        $jsonBody = json_decode($jsonBody, true);

        if (empty($jsonBody["name"]) || empty($jsonBody["director"]) || empty($jsonBody["classification"])
        || empty($jsonBody["img"]) || empty($jsonBody["plot"])) {
            echo getResponse(400, "KO_MISSING", "Falta algún atributo");
            exit;
        }

        $data = [
            "name" => $jsonBody["name"],
            "director" => $jsonBody["director"],
            "classification" => $jsonBody["classification"],
            "img" => $jsonBody["img"],
            "plot" => $jsonBody["plot"],
        ];

        $resp = addFilmDB($data);

        if (is_null($resp)) {
            echo getResponse(500, "KO", "Error interno de base de datos");
        } else {
            echo $resp > 0 ? getResponse(200, "OK", "Película añadida correctamente!") : getResponse(500, "KO_ADD", "Error al añadir película");
        }

    } else {
        echo getResponse(400, "KO_REQUEST", "Tipo de petición incorrecta");
    }
} catch (Exception $e) {
    echo getResponse(500, "KO", "Error interno");
}
