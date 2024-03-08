<?php
    class Creds {
        private static $path = "../bin/creds.json";

        private static function get() {
            $size = filesize(Creds::$path);
            $file = fopen($path, "r");
            $creds = fread($file, $size);
            $creds = json_decode($creds);
            fclose($file);
        }
        
        public static function getPdoFoodinni() {
            return Creds::get()->pdoFoodinni;
        }
    }    
?>