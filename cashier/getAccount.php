<?php
    try {
        require_once "../config/headersGet.php";
        require_once "../config/authCashier.php";
        require_once "../models/cashier.php";

        http_response_code(200);
        die(json_encode($cashier->toArray()));
    }
    catch (Exception $e) {
        http_response_code(500);
        die(json_encode([
            "status" => "error",
            "message" => "Exception '$e'"
        ]));
    }
?>