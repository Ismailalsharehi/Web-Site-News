<?php 


namespace Controllers\users;
use Core\Session;
use Core\Flash;
use Core\Database\Connection;
use Pdo;
use PDOException;



require_once __DIR__ . '/../../vendor/autoload.php';
try {
  $db = Connection::connect();
  $stmt = $db->prepare("SELECT*  FROM users");
  $stmt->execute();
  $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  Flash::set('error', 'خطأ في الاتصال بقاعدة البيانات: ' . htmlspecialchars($e->getMessage()));
}
require_once __DIR__ . '/../../View/pages/users/create_view.php';