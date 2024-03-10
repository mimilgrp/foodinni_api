<?php
    require_once "../config/auth.php";
    require_once "../models/customer.php";

    $paramscustomer = [
        "identifier" => $identifier,
        "password" => $password
    ];
    
    $customer = new Customer($pdo, $paramscustomer);
    $customer->get();

    if (!$customer->isAuthentified()) {
        http_response_code(400);
        die(json_encode([
            "status" => "error",
            "message" => "Bad authorization"
        ]));
    }
?>