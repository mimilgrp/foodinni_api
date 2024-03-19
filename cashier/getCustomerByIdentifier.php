<?php
    try {
        require_once "../config/headersGet.php";
        require_once "../config/authCashier.php";
        require_once "../models/customer.php";

        $identifier = $_GET["identifier"];

        if (!strval($identifier)) {
            http_response_code(400);
            die(json_encode([
                "status" => "error",
                "message" => "Bad parameter 'identifier'"
            ]));
        }

        $paramscustomer = [
            "identifier" => $identifier
        ];

        $customer = new Customer($pdo, $paramscustomer);
        $customer->getByIdentifier();
        $identifier = $customer->getIdentifier();

        if (!$customer->isAuthentified()) {
            http_response_code(400);
            die(json_encode([
                "status" => "error",
                "message" => "Customer does not exist"
            ]));
        }

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