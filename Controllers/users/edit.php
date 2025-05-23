<?php
namespace Controllers\users;

require_once __DIR__ . '/../../vendor/autoload.php';
use Core\Flash;
use Core\Session;

use Core\Database\Connection;
use PDO;
use PDOException;

try {
  $db = Connection::connect();

  $id = intval($_GET['id'] ?? 0);

  if ($id > 0) {
    $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
      Flash::set('error', 'المستخدم غير موجود.');
      header('Location: index.php');
      exit;
    }

    
      require_once __DIR__ . '/../../View/pages/users/edit_view.php';
  exit;


  } else {
    Flash::set('error', 'رقم المستخدم غير صالح.');
    header('Location: index.php');
    exit;
  }

} catch (PDOException $e) {
  Flash::set('error', 'خطأ في الاتصال: ' . $e->getMessage());
  header('Location: index.php');
  exit;
}


    
