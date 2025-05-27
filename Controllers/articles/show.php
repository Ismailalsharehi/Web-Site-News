<?php

namespace Controllers\articles;

// require_once __DIR__ . '/../../vendor/autoload.php';

use Core\Database\Connection;
use Core\Session;

Session::start();

use Core\Flash;
use PDO;
use PDOException;




ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$db = Connection::connect();
$slug = $_GET['slug'] ?? null;
// var_dump($slug);
// $id = $_GET['id'] ?? null;

if (!$slug) {
  Flash::set('error', 'رابط المقال غير صالح.');
  header('Location: /');
  exit;
}

// استعلام مشترك (JOIN) يجلب المقال + الكاتب + القسم
$query = "
  SELECT 
    articles.*, 
    users.full_name AS author_name, 
    categories.name AS category_name
  FROM articles
  JOIN users ON articles.user_id = users.id
  JOIN categories ON articles.category_id = categories.id
  WHERE articles.slug = :slug
  LIMIT 1
";

$stmt = $db->prepare($query);
$stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
$stmt->execute();

$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
  Flash::set('error', 'المقال غير موجود.');
  // var_dump($article);
  header('Location: /404');
  exit;
}

// تحديث عدد المشاهدا
if (!Session::has('viewed_articles')) { // إذا لم تكن الجلسة تحتوي على قائمة المقالات التي تمت مشاهدتها
  // إنشاء قائمة جديدة
  Session::set('viewed_articles', []);
}
$viewed = Session::get('viewed_articles'); // استرجاع قائمة المقالات التي تمت مشاهدتها

// var_dump($viewed);

if (!is_array($viewed)) {
  $viewed = [];
}

if (!in_array($article['id'], $viewed)) { // إذا لم يكن المقال في قائمة المشاهدة
  // زيادة عدد المشاهدات في قاعددة البيانات
  $updateQuery = "UPDATE articles SET views_count = views_count + 1 WHERE id = :id";
  $updateStmt = $db->prepare($updateQuery);
  $updateStmt->bindParam(':id', $article['id'], PDO::PARAM_INT);
  $updateStmt->execute();



  $viewed[] = $article['id'];
  // إضافة المقال إلى قائمة المقالات التي تمت مشاهدتها
  Session::set('viewed_articles', $viewed);

  // عرض المقال
}
Flash::set('success', 'تم جلب المقال بنجاح.');
require('View/pages/articles/show_view.php');
