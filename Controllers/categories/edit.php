<?php

namespace Controllers\categories;



use Core\Session;

Session::start();

use Core\Database\Connection;
use PDOException;
use PDO;

use Core\Flash;

// var_dump($_GET);

try {

  $conn  = Connection::connect();
  $id = intval($_GET['id'] ?? 0);
  if ($id <= 0) {
    Flash::set('error', 'رقم التصنيف غير صالح.');
    header('Location: /404');
    exit;
  }
  // جلب التصنيف
  $stmt = $conn->prepare("SELECT * FROM categories WHERE id = :id");
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $category = $stmt->fetch(PDO::FETCH_ASSOC);
  if (!$category) {
    Flash::set('error', 'التصنيف غير موجود.');
    header('Location: categories_index_view');
    exit;
  }
} catch (PDOException $e) {
  Flash::set('error', 'خطأ في الاتصال بقاعدة البيانات: ' . htmlspecialchars($e->getMessage()));
}

if (Session::isAdmin()) {
  // Flash::set('success', 'مرحباً ' . htmlspecialchars(Session::get('user')['name']));
  require('View/pages/categories/edit_view.php');
} else {
  Flash::set('error', 'ليس لديك صلاحيات للوصول إلى هذه الصفحة.');
  header('Location: /');
  exit;
}













require_once __DIR__ . '/../../View/pages/categories/edit_view.php';
