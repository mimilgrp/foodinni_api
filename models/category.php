<?php
    require_once "../config/format.php";

    class Category {
        private $pdo;
        private $name;
        private $image;

        public function __construct($pdo, $params = null) {
            $this->setPdo($pdo);
            $this->setName($params["name"]);
            $this->setImage($params["image"]);
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

        private function getImage() {
            return $this->image;
        }

        private function setImage($image) {
            $image = Format::toString($image);
            $this->image = $image;
        }

        public function toArray() {
            return [
                "name" => $this->getName(),
                "image" => $this->getImage()
            ];
        }
    }
?>