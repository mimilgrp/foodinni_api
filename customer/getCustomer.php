<?php
    try {
        require_once "../config/headersGet.php";
        require_once "../config/authCustomer.php";
        require_once "../models/customer.php";

        http_response_code(200);
        die(json_encode($customer->toArray()));
    }
    catch (Exception $e) {
        http_response_code(500);
        die(json_encode([
            "status" => "error",
            "message" => "Exception '$e'"
        ]));
    }
?>