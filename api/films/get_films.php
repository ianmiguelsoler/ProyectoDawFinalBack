<?php
require_once "../../utils/utils.php";
require_once "../db/db.php";
if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    exit(0);
}

try {
	if ( $_SERVER["REQUEST_METHOD"] == "GET" ) {

		$resp = getFilmsDB();

		if(is_null($resp))
			echo getResponse(500,"KO","Error interno de base de datos");
		else
			echo getResponse(200,"OK", "Películas obtenidas correctamente", $resp);

	} else {
	 	echo getResponse(400,"KO_REQUEST","Tipo de petición incorrecta");
	}

} catch(Exception $e) {
	echo getResponse(500,"KO","Error interno");
}