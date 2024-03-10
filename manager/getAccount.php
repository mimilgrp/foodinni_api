<?php
    try {
        require_once "../config/headersGet.php";
        require_once "../config/authManager.php";
        require_once "../models/manager.php";

        http_response_code(200);
        die(json_encode($manager->toArray()));
    }
    catch (Exception $e) {
        http_response_code(500);
        die(json_encode([
            "status" => "error",
            "message" => "Exception '$e'"
        ]));
    }
?>