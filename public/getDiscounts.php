<?php
    try {
        require_once "../config/headersGet.php";
        require_once "../config/pdoFoodinni.php";
        require_once "../models/item.php";

        $newitem = new Item($pdo);
        $discounts = $newitem->getAllDiscounts();
        $discountsarray = [];
        
        foreach ($discounts as $discount) {
            array_push($discountsarray, $discount->toArray());
        }

        http_response_code(200);
        die(json_encode($discountsarray));
    }
    catch (Exception $e) {
        http_response_code(500);
        die(json_encode([
            "status" => "error",
            "message" => "Exception '$e'"
        ]));
    }
?>