<?php
    require_once "../config/format.php";

    class Category {
        private $pdo;
        private $name;

        public function __construct($pdo, $params = null) {
            $this->setPdo($pdo);
            $this->setName($params["name"]);
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

        public function toArray() {
            return [
                "name" => $this->getName()
            ];
        }
    }
?>