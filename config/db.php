<?php

class Database {

    private static $host = "localhost";
    private static $db_name = "soto_ayape_asier_DWES04";
    private static $username = "root";
    private static $password = "";
    private static $conn = null;

    public static function getConnection() {

        if (self::$conn === null) {

            try {
                self::$conn = new PDO(
                    "mysql:host=" . self::$host . ";dbname=" . self::$db_name . ";charset=utf8",
                    self::$username,
                    self::$password
                );

                // Activar modo excepción
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            } catch (PDOException $e) {
                die("Error de conexión a la base de datos: " . $e->getMessage());
            }
        }

        return self::$conn;
    }
}
