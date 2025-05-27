<?php

namespace Controllers\articles;

use Core\Database\Connection;
use Core\Flash;
use Core\Session;

use PDO;
use PDOException;



$db = Connection::connect();

if (isset($_GET['slug']) && !empty($_GET['slug'])) {

  $slug = $_GET['slug'];

  $stmt = $db->prepare("SELECT * From categories  where slug = :slug");
  $stmt->execute(['slug' => $slug]);
  $category = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($category) {
    $stmt = $db->prepare("Select* from articles where category_id = :category_id and status = 'published' order by published_at desc");
    $stmt->execute(['category_id' => $category['id']]);
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
  } else {
    Flash::set('error', 'المقال غير موجود');
    header('Location: /');
    exit;
  }
} else {
  Flash::set('error', 'القسم غير موجود');
  header('Location: /');
  exit;
}

$stmt = $db->prepare("SELECT title, slug, views_count FROM articles WHERE status = 'published' and category_id = :category_id ORDER BY views_count DESC LIMIT 5");
$stmt->execute(['category_id' => $category['id']]);
$Viewed = $stmt->fetchAll(PDO::FETCH_ASSOC);



require('View/pages/articles/list_view.php');
