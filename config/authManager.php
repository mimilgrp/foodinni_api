<?php
    require_once "../config/auth.php";
    require_once "../models/manager.php";

    $paramsmanager = [
        "identifier" => $identifier,
        "password" => $password
    ];
    
    $manager = new Manager($pdo, $paramsmanager);
    $manager->get();

    if (!$manager->isAuthentified()) {
        http_response_code(400);
        die(json_encode([
            "status" => "error",
            "message" => "Bad authorization"
        ]));
    }
?>