<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Max-Age: 3600");
    header("Content-Type: application/json; charset=UTF-8");

    if ($_SERVER["REQUEST_METHOD"] != "POST") {
        http_response_code(405);
        die(json_encode([
            "status" => "error",
            "message" => $_SERVER["REQUEST_METHOD"]." method not allowed"
        ]));
    }
?>