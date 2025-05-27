<?php
namespace Controllers\articles;
;

use Core\Session;
Session::start();
use Core\Flash;
use Core\Database\Connection;
use PDO;
use PDOException;



$db = Connection::connect();
// var_dump($_GET);
try {

  $id = intval($_GET['id'] ?? 0);

  
  if ($id <= 0) {
    Flash::set('error', 'رقم المقال غير صالح.');
    header('Location: /');
    exit;
  }

  // جلب المقال
  $stmt = $db->prepare("SELECT * FROM articles WHERE id = :id");
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $article = $stmt->fetch(PDO::FETCH_ASSOC);
  // var_dump($article);
  if (!$article) {
    Flash::set('error', 'المقال غير موجود.');
    header('Location: /');
    exit;
  }

  // جلب التصنيفات
  $stmt = $db->prepare("SELECT id, name FROM categories");
  $stmt->execute();
  $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);



} catch (PDOException $e) {
  Flash::set('error', 'خطأ في الاتصال: ' . $e->getMessage());
  
  header('Location: /404');
  exit;
}

if(Session::isAdmin()) {
    // Flash::set('success', 'مرحباً ' . htmlspecialchars(Session::get('user')['name']));
    require('View/pages/articles/edit_view.php');
} else {
    Flash::set('error', 'ليس لديك صلاحيات للوصول إلى هذه الصفحة.');
    header('Location: /');
    exit;
}
