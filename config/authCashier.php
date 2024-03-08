<?php
    require_once "../config/auth.php";
    require_once "../models/cashier.php";

    $paramscashier = [
        "identifier" => $identifier,
        "password" => $password
    ];
    
    $cashier = new Cashier($pdo, $paramscashier);
    $cashier->get();
?>