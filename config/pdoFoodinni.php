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
            PdoFoodinni::$pdo->query("SET CHARACTER SET utf8");
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

        private static function queryFetch($request) {
            $result = PdoFoodinni::$pdo->query($request);
            return $result->fetchAll();
        }

        public function getCashier($identifier, $password) {
            $request = "SELECT account.* FROM cashier LEFT JOIN account ON cashier.identifier = account.identifier WHERE cashier.identifier = '$identifier' AND password = '$password';";
            return PdoFoodinni::queryFetch($request)[0];
        }

        public function getCustomer($identifier, $password) {
            $request = "SELECT account.* FROM customer LEFT JOIN account ON customer.identifier = account.identifier WHERE customer.identifier = '$identifier' AND password = '$password';";
            return PdoFoodinni::queryFetch($request)[0];
        }

        public function getAllItems() {
            $request = "SELECT * FROM item;";
            return PdoFoodinni::queryFetch($request);
        }
    }
?>