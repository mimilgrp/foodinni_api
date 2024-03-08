<?php
    require_once "../config/pdoFoodinni.php";

    $headers = getallheaders();
    $authorization = $headers["Authorization"];

    if (is_null($authorization)) {
        http_response_code(400);
        die(json_encode([
            "status" => "error",
            "message" => "Authorization required"
        ]));
    }
    
    if (!str_starts_with($authorization, "Basic ")) {
        http_response_code(400);
        die(json_encode([
            "status" => "error",
            "message" => "Bad authorization"
        ]));
    }

    $auth = substr($authorization, 6);
    $auth = base64_decode($auth);
    $auth = explode(':', $auth);
    $identifier = $auth[0];
    $password = $auth[1];
?>