<?php
class Database {
    private static $connection;

    public static function connect() {
        if (!self::$connection) {
            $host = 'localhost';
            $dbname = 'your_db_name';
            $username = 'root';
            $password = '';
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];

            try {
                self::$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, $options);
            } catch (PDOException $e) {
                die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
            }
        }

        return self::$connection;
    }
}



<?php
class Database {
    private static $host = 'localhost';
    private static $dbname = 'your_db';
    private static $user = 'root';
    private static $pass = '';
    private static $pdo;

    public static function connect() {
        if (!self::$pdo) {
            try {
                self::$pdo = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname, self::$user, self::$pass);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("خطأ في الاتصال: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
