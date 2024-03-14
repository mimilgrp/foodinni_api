<?php
    require_once "../config/format.php";

    class Account {
        private $pdo;
        private $identifier;
        private $mail;
        private $firstname;
        private $lastname;
        private $authentified;
        
        public function __construct($pdo, $params = null) {
            $this->setPdo($pdo);
            $this->setIdentifier($params["identifier"]);
            $this->setMail($params["mail"]);
            $this->setFirstname($params["firstname"]);
            $this->setLastname($params["lastname"]);
            $this->setAuthentified(false);
        }

        public function getPdo() {
            return $this->pdo;
        }

        private function setPdo($pdo) {
            $this->pdo = $pdo;
            $this->setAuthentified(false);
        }

        public function getIdentifier() {
            return $this->identifier;
        }

        public function setIdentifier($identifier) {
            $identifier = Format::toString($identifier);
            if (!is_null($identifier)) {
                $this->identifier = $identifier;
                $this->setAuthentified(false);
            }
        }

        private function getMail() {
            return $this->mail;
        }

        public function setMail($mail) {
            $mail = Format::toString($mail);
            $this->mail = $mail;
        }

        private function getFirstname() {
            return $this->firstname;
        }

        public function setFirstname($firstname) {
            $firstname = Format::toString($firstname);
            $this->firstname = $firstname;
        }

        private function getLastname() {
            return $this->lastname;
        }

        public function setLastname($lastname) {
            $lastname = Format::toString($lastname);
            $this->lastname = $lastname;
        }

        public function isAuthentified() {
            return $this->authentified;
        }

        public function setAuthentified($authentified) {
            $this->authentified = boolval($authentified);
        }

        public function toArray() {
            return [
                "identifier" => $this->getIdentifier(),
                "mail" => $this->getMail(),
                "firstname" => $this->getFirstname(),
                "lastname" => $this->getLastname()
            ];
        }
    }
?>