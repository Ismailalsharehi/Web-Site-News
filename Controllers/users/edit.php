<?php

namespace Controllers\users;


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

if (Session::isAdmin()) {

  // Flash::set('success', 'مرحباً ' . htmlspecialchars(Session::get('user')['name']));
  require('View/pages/users/edit_view.php');
} else {
  Flash::set('error', 'ليس لديك صلاحيات للوصول إلى هذه الصفحة.');
  header('Location: /');
  exit;
}
