<?php
namespace Controllers\articles;

require_once __DIR__ . '/../../vendor/autoload.php';

use Core\Session;
use Core\Flash;
use Core\Database\Connection;
use PDOException;
use PDO;

$pdo = Connection::connect();
try {

$searchTerm = trim($_GET['q'] ?? '');
$categoryId = $_GET['category_id'] ?? '';
$authorId = $_GET['author_id'] ?? '';



  $sql = "SELECT 
            a.id, a.title, a.slug, a.summary, a.image_path, a.published_at,
            u.full_name AS author,
            c.name AS category
        FROM articles a
        INNER JOIN users u ON a.user_id = u.id
        INNER JOIN categories c ON a.category_id = c.id
        WHERE a.status = :status";

$params = ['status' => 'published'];







if (!empty($searchTerm)) {
    $sql .= " AND (a.title LIKE :q OR a.summary LIKE :q)";
    $params['q'] = '%' . $searchTerm . '%';
}
if (!empty($categoryId)) {
    $sql .= " AND c.id = :category_id";
    $params['category_id'] = $categoryId;
}
if (!empty($authorId)) {
    $sql .= " AND u.id = :author_id";
    $params['author_id'] = $authorId;
}
// إضافة شرط الفلترة حسب التصنيف
// إضافة شرط الفلترة حسب الكاتب
// إضافة شرط الفلترة حسب حالة المقالة
// إضافة شرط الفلترة حسب تاريخ النشر
  if (!empty($_GET['published_at'])) {
    $sql .= " AND a.published_at = :published_at";
    $params['published_at'] = $_GET['published_at'];
  }
// إضافة شرط الفلترة حسب عدد المشاهدات
  if (!empty($_GET['views_count'])) {
    $sql .= " AND a.views_count = :views_count";
    $params['views_count'] = $_GET['views_count'];
  }

  // إضافة شرط الفلترة حسب حالة المقالة
  if (!empty($_GET['status'])) {
    $sql .= " AND a.status = :status";
    $params['status'] = $_GET['status'];
  }
  

$sql .= " ORDER BY a.published_at DESC LIMIT 10";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);










    

// featch the Authors 
  $sql = "SELECT DISTINCT u.id, u.full_name FROM users u
JOIN articles a ON a.user_id = u.id
WHERE a.status = 'published'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$authors = $stmt->fetchAll(PDO::FETCH_ASSOC);


} catch (\PDOException $e) {
    Flash::set('error', "حصل خطأ أثناء الاتصال بقاعدة البيانات: " . $e->getMessage());
    $articles = []; // لتفادي أي أخطاء لاحقة
}

try {
    // جلب التصنيفات
    $query = "SELECT * FROM categories";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $sql= "
SELECT a.title, a.slug
FROM articles a
JOIN categories c ON a.category_id = c.id
WHERE c.slug = 'urgent' AND a.status = 'published'
ORDER BY a.published_at DESC
LIMIT 5
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$newsNow = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql = "SELECT title, slug, views_count FROM articles WHERE status = 'published' ORDER BY views_count DESC LIMIT 5";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$Viewed = $stmt->fetchAll(PDO::FETCH_ASSOC);


}catch(PDOexception $e){
  Flash::set('error', "حصل خطأ أثناء الاتصال بقاعدة البيانات: " . $e->getMessage());
  $newsNow = []; // لتفادي أي أخطاء لاحقة
}



// عرض صفحة العرض
require_once __DIR__ . '/../../View/pages/articles/index_view.php';
