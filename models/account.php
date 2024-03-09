<?php
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
            if (!is_null($identifier)) {
                $strip = strip_tags($identifier);
                $chars = htmlspecialchars($strip);
                $this->identifier = strtolower($chars);
                $this->setAuthentified(false);
            }
        }

        private function getMail() {
            return strtolower($this->mail);
        }

        public function setMail($mail) {
            if (is_null($mail)) {
                $this->mail = null;
            }
            else {
                $strip = strip_tags($mail);
                $chars = htmlspecialchars($strip);
                $this->mail = strtolower($chars);
            }
        }

        private function getFirstname() {
            return strtolower($this->firstname);
        }

        public function setFirstname($firstname) {
            if (is_null($firstname)) {
                $this->firstname = null;
            }
            else {
                $strip = strip_tags($firstname);
                $chars = htmlspecialchars($strip);
                $this->firstname = strtolower($chars);
            }
        }

        private function getLastname() {
            return strtolower($this->lastname);
        }

        public function setLastname($lastname) {
            if (is_null($lastname)) {
                $this->lastname = null;
            }
            else {
                $strip = strip_tags($lastname);
                $chars = htmlspecialchars($strip);
                $this->lastname = strtolower($chars);
            }
        }

        public function isAuthentified() {
            return boolval($this->authentified);
        }

        public function setAuthentified($authentified) {
            $this->authentified = boolval($authentified);
        }

        public function toArray() {
            return [
                "identifier" => $this->getIdentifier(),
                "mail" => $this->getMail(),
                "firstname" => $this->getFirstname(),
                "lastname" => $this->getLastname(),
                "authentified" => $this->isAuthentified()
            ];
        }
    }
?>