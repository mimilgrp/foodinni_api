<?php
    try {
        require_once "../config/headersGet.php";
        require_once "../config/authManager.php";
        require_once "../models/manager.php";

        $managers = $manager->getAll();
        $managersarray = [];
        
        foreach ($managers as $manager) {
            array_push($managersarray, $manager->toArray());
        }

        http_response_code(200);
        die(json_encode($managersarray));
    }
    catch (Exception $e) {
        http_response_code(500);
        die(json_encode([
            "status" => "error",
            "message" => "Exception '$e'"
        ]));
    }
?>