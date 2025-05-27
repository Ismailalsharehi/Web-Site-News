<?php

namespace Controllers\categories;


use Core\Session;

Session::start();

use Core\Database\Connection;
use PDOException;
use PDO;

use Core\Flash;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



$categories = [];
$category_count = 0;

try {
  $conn = Connection::connect();

  $search = htmlspecialchars($_GET['search'] ?? '');

  $sql = "SELECT * FROM categories WHERE 1=1";
  $params = [];

  if (!empty($search)) {
    $sql .= " AND (name LIKE :search OR slug LIKE :search OR created_at LIKE :search)";
    $params['search'] = "%$search%";
  }

  $stmt = $conn->prepare($sql);
  $stmt->execute($params);
  $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $category_count = count($categories);
} catch (PDOException $e) {
  Flash::set('error', 'خطأ في الاتصال بقاعدة البيانات: ' . htmlspecialchars($e->getMessage()));
}

if (Session::isAdmin()) {
  Flash::set('success', 'مرحباً ' . htmlspecialchars(Session::get('user')['name']));
  require('View/pages/categories/manage_view.php');
} else {
  Flash::set('error', 'ليس لديك صلاحيات للوصول إلى هذه الصفحة.');
  header('Location: /');
  exit;
}
