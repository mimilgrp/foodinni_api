<?php
    require_once "../config/format.php";

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
            $ean13 = Format::toEan13($ean13);
            $this->ean13 = $ean13;
        }

        private function getName() {
            return $this->name;
        }

        private function setName($name) {
            $name = Format::toString($name);
            $this->name = $name;
        }

        private function isBulk() {
            return $this->bulk;
        }

        private function setBulk($bulk) {
            $bulk = boolval($bulk);
            if ($bulk) {
                $this->setStock(null);
                $this->setPrice(null);
            }
            else {
                $this->setStockKg(null);
                $this->setPriceKg(null);
            }
            $this->bulk = $bulk;
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
            $discount = Format::toDiscount($discount);
            $this->discount = $discount;
        }

        private function getBrand() {
            return $this->brand;
        }

        private function setBrand($brand) {
            $brand = Format::toString($brand);
            $this->brand = $brand;
        }

        private function getCategory() {
            return $this->category;
        }

        private function setCategory($category) {
            $category = Format::toString($category);
            $this->category = $category;
        }

        public function toArray() {
            return [
                "ean13" => $this->getEan13(),
                "name" => $this->getName(),
                "bulk" => $this->isBulk(),
                "stock" => $this->getStock(),
                "stock_kg" => $this->getStockKg(),
                "price" => $this->getPrice(),
                "price_kg" => $this->getPriceKg(),
                "discount" => $this->getDiscount(),
                "brand" => $this->getBrand(),
                "category" => $this->getCategory()
            ];
        }

        public function getAll() {
            $pdo = $this->getPdo();
            $results = $pdo->getAllItems();
            $items = [];

            foreach ($results as $result) {
                $item = new Item($pdo, $result);
                array_push($items, $item);
            }

            return $items;
        }

        public function getAllDiscounts() {
            $pdo = $this->getPdo();
            $results = $pdo->getAllDiscounts();
            $discounts = [];

            foreach ($results as $result) {
                $discount = new Item($pdo, $result);
                array_push($discounts, $discount);
            }

            return $discounts;
        }
    }
?>