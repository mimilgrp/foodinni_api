<?php
    class Item {
        private $pdo;
        private $ean13;
        private $name;
        private $bulk;
        private $stock;
        private $stockKg;
        private $price;
        private $priceKg;
        private $discount;
        private $brand;
        private $category;

        public function __construct($pdo, $params = null) {
            $this->setPdo($pdo);
            $this->setEan13($params["ean13"]);
            $this->setName($params["name"]);
            $this->setBulk($params["bulk"]);
            $this->setStock($params["stock"]);
            $this->setStockKg($params["stock_kg"]);
            $this->setPrice($params["price"]);
            $this->setPriceKg($params["price_kg"]);
            $this->setDiscount($params["discount"]);
            $this->setBrand($params["brand"]);
            $this->setCategory($params["category"]);
        }

        private function getPdo() {
            return $this->pdo;
        }

        private function setPdo($pdo) {
            $this->pdo = $pdo;
        }

        private function getEan13() {
            return $this->ean13;
        }

        private function setEan13($ean13) {
            if (is_null($ean13)) {
                $this->ean13 = null;
            }
            else {
                $int = intval($ean13);
                $min = min($int, 9999999999999);
                $max = max($min, 0);
                $str = strval($max);
                $this->ean13 = str_pad($str, 13, "0", STR_PAD_LEFT);
            }
        }

        private function getName() {
            return $this->name;
        }

        private function setName($name) {
            if (is_null($name)) {
                $this->name = null;
            }
            else {
                $strip = striptags($name);
                $chars = htmlspecialchars($strip);
                $this->name = strtolower($chars);
            }
        }

        private function isBulk() {
            return $this->bulk;
        }

        private function setBulk($bulk) {
            $this->bulk = boolval($bulk);
        }

        private function getStock() {
            return $this->stock;
        }

        private function setStock($stock) {
            if ($this->isBulk() || is_null($stock)) {
                $this->stock = null;
            }
            else {
                $this->stock = intval($stock);
            }
        }

        private function getStockKg() {
            return $this->stockKg;
        }

        private function setStockKg($stockKg) {
            if (!$this->isBulk() || is_null($stockKg)) {
                $this->stockKg = null;
            }
            else {
                $this->stockKg = intval($stockKg);
            }
        }

        private function getPrice() {
            return $this->price;
        }

        private function setPrice($price) {
            if ($this->isBulk() || is_null($price)) {
                $this->price = null;
            }
            else {
                $this->price = intval($price);
            }
        }

        private function getPriceKg() {
            return $this->priceKg;
        }

        private function setPriceKg($priceKg) {
            if (!$this->isBulk() || is_null($priceKg)) {
                $this->priceKg = null;
            }
            else {
                $this->priceKg = intval($priceKg);
            }
        }

        private function getDiscount() {
            return $this->discount;
        }

        private function setDiscount($discount) {
            if (is_null($discount)) {
                $this->discount = null;
            }
            else {
                $int = intval($discount * 100);
                $min = min($int, 0);
                $max = max($min, 99);
                $this->discount = $max / 100;
            }
        }

        private function getBrand() {
            return $this->brand;
        }

        private function setBrand($brand) {
            if (is_null($brand)) {
                $this->brand = null;
            }
            else {
                $strip = striptags($brand);
                $chars = htmlspecialchars($strip);
                $this->brand = strtolower($chars);
            }
        }

        private function getCategory() {
            return $this->category;
        }

        private function setCategory($category) {
            if (is_null($category)) {
                $this->category = null;
            }
            else {
                $strip = striptags($category);
                $chars = htmlspecialchars($strip);
                $this->category = strtolower($chars);
            }
        }

        public function toArray() {
            return [
                "ean13" => $this->getEan13(),
                "name" => $this->getName(),
                "bulk" => $this->getBulk(),
                "stock" => $this->getStock(),
                "stock_kg" => $this->getStockKg(),
                "price" => $this->getPrice(),
                "price_kg" => $this->getPriceKg(),
                "discount" => $this->getDiscount(),
                "brand" => $this->getBrand(),
                "category" => $this->getCategory()
            ];
        }

        public static function getAll() {
            $pdo = $this->getPdo();

            $results = $pdo->getAllItems();
            $items = [];

            foreach ($results as $result) {
                $item = new Item($pdo, $result);
                array_push($items, $item);
            }
        }
    }
?>