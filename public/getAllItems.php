<?php
    try {
        require_once "../config/headersGet.php";
        require_once "../config/pdoFoodinni.php";
        require_once "../models/item.php";

        $newitem = new Item($pdo);
        $items = $newitem->getAll();
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