<?php
    require_once "../config/format.php";
    require_once "../models/category.php";

    class Brand {
        private $pdo;
        private $name;
        private $mail;
        private $categories;

        public function __construct($pdo, $params = null) {
            $this->setPdo($pdo);
            $this->setName($params["name"]);
            $this->setMail($params["mail"]);
            $this->setCategories($params["categories"]);
        }

        private function getPdo() {
            return $this->pdo;
        }

        private function setPdo($pdo) {
            $this->pdo = $pdo;
        }

        private function getName() {
            return $this->name;
        }

        private function setName($name) {
            $name = Format::toString($name);
            $this->name = $name;
        }

        private function getMail() {
            return $this->mail;
        }

        private function setMail($mail) {
            $mail = Format::toString($mail);
            $this->mail = $mail;
        }

        private function getCategories() {
            return $this->categories;
        }

        private function setCategories($categories) {
            $categories = Format::toCategories($categories);
            $this->categories = $categories;
        }

        public function toArray() {
            $categories = $this->getCategories();
            $categoriesarray = [];

            foreach ($categories as $category) {
                array_push($categoriesarray, $category->toArray());
            }

            return [
                "name" => $this->getName(),
                "mail" => $this->getMail(),
                "categories" => $categoriesarray
            ];
        }

        public function getAllCategories() {
            $pdo = $this->getPdo();
            $results = $pdo->getAllBrandsCategories();
            $brandsarray = [];

            foreach ($results as $result) {
                $brandname = $result["name"];
                $brandcategory = $result["category"];

                if (is_null($brandsarray[$brandname])) {
                    $brandsarray[$brandname] = [];
                }

                if (!is_null($brandcategory)) {
                    $categoryparams = [
                        "name" => $brandcategory
                    ];
                    $category = new Category($pdo, $categoryparams);
                    array_push($brandsarray[$brandname], $category);
                }
            }

            $brands = [];

            foreach ($brandsarray as $brand => $categories) {
                $brandparams = [
                    "name" => $brand,
                    "categories" => $categories
                ];
                $brand = new Brand($pdo, $brandparams);
                array_push($brands, $brand);
            }

            return $brands;
        }
    }
?>