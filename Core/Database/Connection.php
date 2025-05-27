<?php
namespace Core\Database;

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
        
      } catch (PDOException $e) {
        Flash::set('error', 'فشل الاتصال بقاعدة البيانات: ' . $e->getMessage());
        die("<div class='alert alert-danger'>" . Flash::get('error') . "</div>");
        // Handle the error as needed

      }
      
    }
    return self::$pdo;
  }

}

