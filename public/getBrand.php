<?php
    try {
        require_once "../config/headersGet.php";
        require_once "../config/pdoFoodinni.php";
        require_once "../models/brand.php";

        $name = $_GET["name"];

        if (!strval($name)) {
            http_response_code(400);
            die(json_encode([
                "status" => "error",
                "message" => "Bad parameter 'name'"
            ]));
        }

        $paramsbrand = [
            "name" => $name
        ];

        $brand = new Brand($pdo, $paramsbrand);
        $brand->get();

        if (is_null($brand->getName())) {
            http_response_code(400);
            die(json_encode([
                "status" => "error",
                "message" => "Brand does not exist"
            ]));
        }

        http_response_code(200);
        die(json_encode($brand->toArray()));
    }
    catch (Exception $e) {
        http_response_code(500);
        die(json_encode([
            "status" => "error",
            "message" => "Exception '$e'"
        ]));
    }
?>