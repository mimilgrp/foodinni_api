<?php
    try {
        require_once "../config/headersGet.php";
        require_once "../config/pdoFoodinni.php";
        require_once "../models/brand.php";

        $newbrand = new Brand($pdo);
        $brands = $newbrand->getAll();
        $brandsarray = [];
        
        foreach ($brands as $brand) {
            array_push($brandsarray, $brand->toArray());
        }

        http_response_code(200);
        die(json_encode($brandsarray));
    }
    catch (Exception $e) {
        http_response_code(500);
        die(json_encode([
            "status" => "error",
            "message" => "Exception '$e'"
        ]));
    }
?>