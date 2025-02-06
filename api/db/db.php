<?php

// Función para obtener la configuración de la base de datos desde el archivo YML
function getDBConfig() {
    $dbFileConfig = "/var/www/html/dbconfiguration.yml"; // Ruta fija para evitar errores de ubicación

    if (!file_exists($dbFileConfig)) {
        die("Error: El archivo de configuración de la base de datos no existe.");
    }
    
    $configYML = yaml_parse_file($dbFileConfig);
    if (!$configYML) {
        die("Error: No se pudo leer el archivo de configuración de la base de datos.");
    }

    return [
        "cad" => sprintf("mysql:dbname=%s;host=%s;charset=UTF8", $configYML["dbname"], $configYML["ip"]),
        "user" => $configYML["user"],
        "pass" => $configYML["pass"]
    ];
}

// Función para establecer la conexión con la base de datos
function getDBConnection() {
    try {
        $res = getDBConfig();
        $bd = new PDO($res["cad"], $res["user"], $res["pass"]);
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $bd;
    } catch (PDOException $e) {
        die("Error de conexión a la base de datos: " . $e->getMessage());
    }
}

/* ------------ PELÍCULAS --------------- */
function getFilmsDB() {
    try {
        $bd = getDBConnection();
        $sqlPrepared = $bd->prepare("SELECT id, name, director, classification FROM film");
        $sqlPrepared->execute();
        return $sqlPrepared->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error al obtener películas: " . $e->getMessage());
    }
}

function getFilmDB($id) {
    try {
        $bd = getDBConnection();
        $sqlPrepared = $bd->prepare("SELECT * FROM film WHERE id = :id");
        $sqlPrepared->execute([":id" => $id]);
        return $sqlPrepared->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error al obtener película: " . $e->getMessage());
    }
}

function addFilmDB($data) {
    try {
        $bd = getDBConnection();
        $sqlPrepared = $bd->prepare(
            "INSERT INTO film (name, director, classification, img, plot) VALUES (:name, :director, :classification, :img, :plot)"
        );
        return $sqlPrepared->execute($data);
    } catch (PDOException $e) {
        die("Error al añadir película: " . $e->getMessage());
    }
}

function updateFilmDB($data) {
    try {
        $bd = getDBConnection();
        $sqlPrepared = $bd->prepare(
            "UPDATE film SET name=:name, director=:director, classification=:classification, img=:img, plot=:plot WHERE id=:id"
        );
        return $sqlPrepared->execute($data);
    } catch (PDOException $e) {
        die("Error al actualizar película: " . $e->getMessage());
    }
}

function deleteFilmDB($id) {
    try {
        $bd = getDBConnection();
        $sqlPrepared = $bd->prepare("DELETE FROM film WHERE id=:id");
        return $sqlPrepared->execute([":id" => $id]);
    } catch (PDOException $e) {
        die("Error al eliminar película: " . $e->getMessage());
    }
}
