<?php
    try {
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Max-Age: 3600");
        header("Content-Type: application/json; charset=UTF-8");

        if ($_SERVER["REQUEST_METHOD"] != "GET") {
            http_response_code(405);
            die(json_encode([
                "status" => "error",
                "message" => $_SERVER["REQUEST_METHOD"]." method not allowed"
            ]));
        }

        require_once "../config/authCashier.php";
        require_once "../models/item.php";

        $item = new Item($this->getPdo());
        $items = $item->getAll();
        $itemsarray = [];
        
        foreach ($items as $item) {
            array_push($itemsarray, $item->toArray());
        }

        http_response_code(200);
        die(json_encode($itemsarray));
    }
    catch (Exception $e) {
        http_response_code(500);
        die(json_encode([
            "status" => "error",
            "message" => "Exception '$e'"
        ]));
    }
?>