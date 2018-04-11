<?php
    class Connection{
        public static function connect(){
            try {
                foreach(file(__DIR__.'/../database/connection.conf') as $line) {
                    list($key, $value) = explode(':', $line, 2) + array(NULL, NULL);
                    $conf[trim($key)] = trim($value);
                }
                $connection = new PDO("{$conf['db']}:host={$conf['host']};dbname={$conf['dbname']}", $conf['username'], $conf['password']);
                $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Não foi possivel se conectar";
            }
            return $connection;
        }
    }