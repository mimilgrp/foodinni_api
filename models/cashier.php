<?php
    require_once "../models/account.php";

    class Cashier extends Account {      
        private $password;
        private $authentified;
        
        public function __construct($pdo, $params = null) {
            parent::__construct($pdo, "cashier", $params);
        }

        private function getPassword() {
            return $this->password;
        }

        private function setPassword($password) {
            $this->password = htmlspecialchars(strip_tags($password));
            $this->setAuthentified(false);
        }

        public function isAuthentified() {
            return boolval($this->authentified);
        }

        public function setAuthentified($authentified) {
            $this->authentified = boolval($authentified);
        }

        public function toArray() {
            
        }

        public function get() {
            $pdo = $this->getPdo();
            $identifier = $this->getIdentifier();
            $password = $this->getPassword();

            $result = $pdo->getCashier($identifier, $password);

            $this->setIdentifier($result["identifier"]);
            $this->setMail($result["mail"]);
            $this->setFirstname($result["firstname"]);
            $this->setLastname($result["lastname"]);
            $this->setAuthentified(!is_null($result));
        }
    }
?>