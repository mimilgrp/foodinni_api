<?php
    require_once "../config/creds.php";

    $pdofoodinni = new PdoFoodinni();
    $pdo = $pdofoodinni->getPdoFoodinni();
    
    class PdoFoodinni {
        private static $pdo;
        private static $pdofoodinni = null;

        public function __construct() {
            $creds = Creds::getPdoFoodinni();
            $host = $creds->host;
            $dbname = $creds->dbname;
            $username = $creds->username;
            $password = $creds->password;
            try {
                PdoFoodinni::$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            }
            catch (Exception $e) {
                die($e);
            }
            PdoFoodinni::$pdo->exec("SET CHARACTER SET utf8");
        }

        public function destructPdo() {
            PdoFoodinni::$pdo = null;
        }

        public static function getPdoFoodinni() {
            if (PdoFoodinni::$pdofoodinni == null) {
                PdoFoodinni::$pdofoodinni = new PdoFoodinni();
            }
            return PdoFoodinni::$pdofoodinni;  
        }

        public function getCashier($identifier, $password) {
            $request = PdoFoodinni::$pdo->prepare("SELECT account.* FROM cashier
                LEFT JOIN account ON cashier.identifier = account.identifier
                WHERE cashier.identifier = :identifier AND password = :password;");
            $request->bindValue(":identifier", $identifier, PDO::PARAM_STR);
            $request->bindValue(":password", $password, PDO::PARAM_STR);
            $request->execute();
            return $request->fetchAll()[0];
        }

        public function getCustomer($identifier, $password) {
            $request = PdoFoodinni::$pdo->prepare("SELECT account.* FROM customer
                LEFT JOIN account ON customer.identifier = account.identifier
                WHERE customer.identifier = :identifier AND password = :password;");
            $request->bindValue(":identifier", $identifier, PDO::PARAM_STR);
            $request->bindValue(":password", $password, PDO::PARAM_STR);
            $request->execute();
            return $request->fetchAll()[0];
        }

        public function getCustomerByIdentifier($identifier) {
            $request = PdoFoodinni::$pdo->prepare("SELECT account.identifier, firstname, lastname FROM customer
                LEFT JOIN account ON customer.identifier = account.identifier
                WHERE customer.identifier = :identifier;");
            $request->bindValue(":identifier", $identifier, PDO::PARAM_STR);
            $request->execute();
            return $request->fetchAll()[0];
        }

        public function getAllItems() {
            $result = PdoFoodinni::$pdo->query("SELECT * FROM item;");
            return $result->fetchAll();
        }

        public function getAllItemsDiscounts() {
            $result = PdoFoodinni::$pdo->query("SELECT * FROM item WHERE discount IS NOT NULL;");
            return $result->fetchAll();
        }

        public function getAllCategories() {
            $result = PdoFoodinni::$pdo->query("SELECT * FROM category;");
            return $result->fetchAll();
        }

        public function getBrand($name) {
            $result = PdoFoodinni::$pdo->prepare("SELECT DISTINCT brand.*,
                category.name AS category_name, category.image AS category_image FROM brand
                LEFT JOIN item ON brand.name = item.brand
                LEFT JOIN category ON item.category = category.name
                WHERE brand.name = :name;");
            $result->bindValue(":name", $name, PDO::PARAM_STR);
            $result->execute();
            return $result->fetchAll();
        }

        public function getAllBrandsCategories() {
            $result = PdoFoodinni::$pdo->query("SELECT DISTINCT brand.*,
                category.name AS category_name, category.image AS category_image FROM brand
                LEFT JOIN item ON brand.name = item.brand
                LEFT JOIN category ON item.category = category.name");
            return $result->fetchAll();
        }

        public function getManager($identifier, $password) {
            $request = PdoFoodinni::$pdo->prepare("SELECT account.* FROM manager
                LEFT JOIN account ON manager.identifier = account.identifier
                WHERE manager.identifier = :identifier AND password = :password;");
            $request->bindValue(":identifier", $identifier, PDO::PARAM_STR);
            $request->bindValue(":password", $password, PDO::PARAM_STR);
            $request->execute();
            return $request->fetchAll()[0];
        }

        public function getAllManagers() {
            $result = PdoFoodinni::$pdo->query("SELECT account.* FROM manager
                LEFT JOIN account ON manager.identifier = account.identifier;");
            return $result-fetchAll();
        }
    }
?>