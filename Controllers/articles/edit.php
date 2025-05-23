<?php
namespace Controllers\articles;

require_once __DIR__ . '/../../vendor/autoload.php';

use Core\Database\Connection;
use PDO;
use PDOException;
use Core\Flash;


use Core\Session;

$db = Connection::connect();
// var_dump($_GET);
try {

  $id = intval($_GET['id'] ?? 0);
  
  if ($id <= 0) {
    Flash::set('error', 'رقم المقال غير صالح.');
    header('Location: index.php');
    exit;
  }

  // جلب المقال
  $stmt = $db->prepare("SELECT * FROM articles WHERE id = :id");
  $stmt->bindParam(':id', $id, PDO::PARAM_INT);
  $stmt->execute();
  $article = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$article) {
    Flash::set('error', 'المقال غير موجود.');
    header('Location: index.php');
    exit;
  }

  // جلب التصنيفات
  $stmt = $db->prepare("SELECT id, name FROM categories");
  $stmt->execute();
  $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // عرض صفحة التعديل
  require_once __DIR__ . '/../../View/pages/articles/edit_view.php';
  exit;

} catch (PDOException $e) {
  Flash::set('error', 'خطأ في الاتصال: ' . $e->getMessage());
  
  header('Location: ../../View/pages/articles/index.php');
  exit;
}
