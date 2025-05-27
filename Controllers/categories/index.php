<?php

namespace Controllers\categories;

use Core\Session;
use Core\Flash;
use Core\Database\Connection;
use PDOException;
use PDO;



try {
  $conn = Connection::connect();
  $stmt = $conn->prepare("SELECT * FROM categories");
  $stmt->execute();
  $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  Flash::set('error', 'خطأ في الاتصال بقاعدة البيانات: ' . htmlspecialchars($e->getMessage()));
}

if (Session::isAdmin()) {
  // Flash::set('success', 'مرحباً ' . htmlspecialchars(Session::get('user')['name']));
  require('View/pages/categories/index_view.php');
} else {
  Flash::set('error', 'ليس لديك صلاحيات للوصول إلى هذه الصفحة.');
  header('Location: /');
  exit;
}
