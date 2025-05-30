<?php

namespace Controllers\categories;



use Core\Session;

Session::start();

use Core\Database\Connection;
use PDOException;
use PDO;

use Core\Flash;

try {
  $conn = Connection::connect();

  $stmt = $conn->prepare("SELECT * FROM categories WHERE id =:id");
  $categoryId = isset($_GET['id']) ? (int)$_GET['id'] : null;
  $stmt->bindParam(':id', $categoryId, PDO::PARAM_INT);

  $stmt->execute();
  $categories = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  Flash::set('error', 'خطأ في الاتصال بقاعدة البيانات: ' . htmlspecialchars($e->getMessage()));
  header('Location: /404');
  exit;
}

try {

  $conn = Connection::connect();

  $stmt = $conn->prepare("SELECT * FROM articles WHERE category_id = :category_id");
  $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
  $stmt->execute();
  $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $article_count = count($articles);
} catch (PDOException $e) {
  Flash::set('error', 'خطأ في الاتصال بقاعدة البيانات: ' . htmlspecialchars($e->getMessage()));
}
if (Session::isAdmin()) {
  // Flash::set('success', 'مرحباً ' . htmlspecialchars(Session::get('user')['name']));
  require('View/pages/categories/show_view.php');
} else {
  Flash::set('error', 'ليس لديك صلاحيات للوصول إلى هذه الصفحة.');
  header('Location: /');
  exit;
}
