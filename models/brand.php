<?php
    require_once "../config/format.php";

    class Brand {
        private $pdo;
        private $name;
        private $mail;

        public function __construct($pdo, $params = null) {
            $this->setPdo($pdo);
            $this->setName($params["name"]);
            $this->setMail($params["mail"]);
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

        public function toArray() {
            return [
                "name" => $this->getName(),
                "mail" => $this->getMail()
            ];
        }

        public function getAll() {
            $pdo = $this->getPdo();
            $results = $pdo->getAllBrands();
            $brands = [];

            foreach ($results as $result) {
                $brand = new Brand($pdo, $result);
                array_push($brands, $brand);
            }

            return $brands;
        }
    }
?>