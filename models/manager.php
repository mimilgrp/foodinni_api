<?php
    require_once "../config/format.php";
    require_once "../models/account.php";

    class Manager extends Account {
        private $password;
        
        public function __construct($pdo, $params = null) {
            parent::__construct($pdo, $params);
            $this->setPassword($params["password"]);
        }

        private function getPassword() {
            return $this->password;
        }

        private function setPassword($password) {
            $password = Format::toString($password);
            $this->password = $password;
            $this->setAuthentified(false);
        }

        public function get() {
            $pdo = $this->getPdo();
            $identifier = $this->getIdentifier();
            $password = $this->getPassword();

            $result = $pdo->getManager($identifier, $password);

            $this->setIdentifier($result["identifier"]);
            $this->setMail($result["mail"]);
            $this->setFirstname($result["firstname"]);
            $this->setLastname($result["lastname"]);
            $this->setAuthentified(!is_null($result));
        }

        public function getAll() {
            $pdo = $this->getPdo();
            $results = $pdo->getAllManagers();
            $managers = [];

            foreach ($results as $result) {
                $manager = new Manager($pdo, $result);
                array_push($managers, $manager);
            }

            return $managers;
        }
    }
?>