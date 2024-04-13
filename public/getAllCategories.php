<?php
    try {
        require_once "../config/headersGet.php";
        require_once "../config/pdoFoodinni.php";
        require_once "../models/category.php";

        $newcategory = new Category($pdo);
        $categories = $newcategory->getAll();
        $categoriesarray = [];
        
        foreach ($categories as $category) {
            array_push($categoriesarray, $category->toArray());
        }

        http_response_code(200);
        die(json_encode($categoriesarray));
    }
    catch (Exception $e) {
        http_response_code(500);
        die(json_encode([
            "status" => "error",
            "message" => "Exception '$e'"
        ]));
    }
?>