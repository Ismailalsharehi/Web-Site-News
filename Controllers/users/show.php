<?php

namespace Controllers\categories;



use Core\Database\Connection;
use Core\Session;
use PDO;
use PDOException;

use Core\Flash;

try {
  $conn = Connection::connect();

  $stmt = $conn->prepare("SELECT * FROM users WHERE id =:id");
  $user_id = isset($_GET['id']) ? (int)$_GET['id'] : null;
  $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);

  $stmt->execute();
  $users = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  Flash::set('error', 'خطأ في الاتصال بقاعدة البيانات: ' . htmlspecialchars($e->getMessage()));
}


if (Session::isAdmin()) {
  Flash::set('success', 'مرحباً ' . htmlspecialchars(Session::get('user')['name']));
  require('View/pages/users/show_view.php');
} else {
  // Flash::set('error', 'ليس لديك صلاحيات للوصول إلى هذه الصفحة.');
  header('Location: /');
  exit;
}
