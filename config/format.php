<?php
    class Format {
        public static function toString($string, $lower = false) {
            if (is_null($string)) {
                return null;
            }

            $string = strval($string);
            $string = strip_tags($string);
            $string = htmlspecialchars($string);
            $string = trim($string);

            if ($lower) {
                $string = strtolower($string);
            }

            return $string;
        }

        public static function toNumber($decimal, $length, $digits) {
            if (is_null($decimal)) {
                return null;
            }

            $bound = $length * 10 - 1;
            $pad = $digits * 10;

            $decimal = floatval($decimal);
            $decimal = $decimal * $pad;
            $decimal = intval($decimal);
            $decimal = min($decimal, $bound);
            $decimal = max($decimal, 0);
            $decimal = $decimal / $pad;

            return $decimal;
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

        public static function toStockKg($stockkg) {
            if (is_null($stockkg)) {
                return null;
            }

            $stockkg = floatval($stockkg);
            $stockkg = $stockkg * 1000;
            $stockkg = intval($stockkg);
            $stockkg = min($stockkg, 9999999999);
            $stockkg = max($stockkg, 0);
            $stockkg = $stockkg / 1000;
            return $stockkg;
        }

        public static function toPrice($price) {
            if (is_null($price)) {
                return null;
            }

            $price = floatval($price);
            $price = $price * 100;
            $price = intval($price);
            $price = min($price, 99999);
            $price = max($price, 0);
            $price = $price / 100;
            return $price;
        }

        public static function toDiscount($discount) {
            if (is_null($discount)) {
                return null;
            }

            $discount = floatval($discount);
            $discount = $discount * 100;
            $discount = intval($discount);
            $discount = min($discount, 99);
            $discount = max($discount, 0);
            $discount = $discount / 100;
            return $discount;
        }

        public static function toCategories($categories) {
            if (gettype($categories) != "array") {
                return null;
            }

            foreach ($categories as $category) {
                if (!is_a($category, 'Category')) {
                    return null;
                }
            }

            return $categories;
        }
    }
?>