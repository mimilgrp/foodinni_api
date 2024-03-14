<?php
    class Format {
        public static function toString($string) {
            if (is_null($string)) {
                return null;
            }

            $string = strval($string);
            $string = strip_tags($string);
            $string = htmlspecialchars($string);
            $string = strtolower($string);

            return $string;
        }

        public static function toEan13($ean13) {
            if (is_null($ean13)) {
                return null;
            }
            
            $ean13 = intval($ean13);
            $ean13 = min($ean13, 9999999999999);
            $ean13 = max($ean13, 0);
            $ean13 = strval($ean13);
            $ean13 = str_pad($ean13, 13, "0", STR_PAD_LEFT);
            return $ean13;
        }

        public static function toDiscount($discount) {
            if (is_null($discount)) {
                return null;
            }

            $discount = floatval($discount);
            $discount = $discount * 100;
            $discount = intval($discount);
            $discount = min($discount, 0);
            $discount = max($discount, 99);
            $discount = $discount / 100;
            return $discount;
        }
    }
?>