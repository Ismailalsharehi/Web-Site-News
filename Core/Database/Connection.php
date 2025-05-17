<?php
// namespace Core;
// class Database {
//     private static $connection;

//     public static function connect() {
//         if (!self::$connection) {
//             $host = 'localhost';
//             $dbname = 'your_db_name';
//             $username = 'root';
//             $password = '';
//             $options = [
//                 PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//                 PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//                 PDO::ATTR_EMULATE_PREPARES => false,
//             ];

//             try {
//                 self::$connection = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, $options);
//             } catch (PDOException $e) {
//                 die("فشل الاتصال بقاعدة البيانات: " . $e->getMessage());
//             }
//         }

//         return self::$connection;
//     }
// }




// class Database {
//     private static $host = 'localhost';
//     private static $dbname = 'your_db';
//     private static $user = 'root';
//     private static $pass = '';
//     private static $pdo;

//     public static function connect() {
//         if (!self::$pdo) {
//             try {
//                 self::$pdo = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname, self::$user, self::$pass);
//                 self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             } catch (PDOException $e) {
//                 die("خطأ في الاتصال: " . $e->getMessage());
//             }
//         }
//         return self::$pdo;
//     }

// }


namespace Core\Database;
// require_once __DIR__ . '/../../vendor/autoload.php';

use PDO;
use PDOException;
use Core\Flash;

class Connection{
  private static $host = 'localhost';
  private static $dbname = 'alhadath_news';
  private static $user ='root';
  private static $password = '';
  private static $pdo;

  public static function connect(){
    if (!self::$pdo) {
      
      try {
        self::$pdo = new PDO( "mysql:host=" .self::$host. ";dbname=".self::$dbname, self::$user, self::$password);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Set the character set to utf8mb4
        
        Flash::set('success', 'تم الاتصال بقاعدة البيانات بنجاح');
        
        echo "<div class='alert alert-success'>" . Flash::get('success') . "</div>";

      } catch (PDOException $e) {
        Flash::set('error', 'فشل الاتصال بقاعدة البيانات: ' . $e->getMessage());
        die("<div class='alert alert-danger'>" . Flash::get('error') . "</div>");
        // Handle the error as needed

      }
      
    }
    return self::$pdo;
  }

}

