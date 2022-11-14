<?php
    class Database{
        public static function connect(){
            $db = new mysqli('localhost', 'root', '12345678', 'ecommerce');
            $db->query("SET NAMES 'utf8'");

            return $db;
        }
    }
?>