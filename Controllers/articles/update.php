<?php

namespace Controllers\articles;


use Controllers\Functions\Functions;
use Core\Session;

Session::start();

use Core\Database\Connection;
use PDOException;
use Core\Flash;
use PDO;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_article'])) {
  $id           = $_POST['id'];
  $title        = trim($_POST['title']);
  $summary      = trim($_POST['summary']);
  $content      = trim($_POST['content']);
  $category_id  = $_POST['category_id'];
  $video_url    = trim($_POST['video_url']);
  $status       = $_POST['status'];
  $is_featured  = isset($_POST['is_featured']) ? 1 : 0;
  $user_id      = $_POST['user_id'];


  $slug = Functions::generateSlug($title);

  // تحميل الصورة إن وُجدت
  $image_path = null;
  if (!empty($_FILES['photo']['name'])) {
    $image_name = time() . '_' . basename($_FILES['photo']['name']);
    $target_dir = '../../Views/midea/images/';
    $target_file = $target_dir . $image_name;

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
      $image_path = $image_name;
    }
  }
  $pdo = Connection::connect();

  // تحديث البيانات في قاعدة البيانات
  $sql = "UPDATE articles 
            SET title = :title, summary = :summary, content = :content,
                category_id = :category_id, slug = :slug,
                video_url = :video_url, status = :status, is_featured = :is_featured,
                user_id = :user_id";

  // إذا فيه صورة جديدة نحدث المسار
  if ($image_path) {
    $sql .= ", image_path = :image_path";
  }

  $sql .= " WHERE id = :id";

  $stmt = $pdo->prepare($sql);

  // ربط القيم
  $stmt->bindParam(':title', $title);
  $stmt->bindParam(':summary', $summary);
  $stmt->bindParam(':content', $content);
  $stmt->bindParam(':category_id', $category_id);
  $stmt->bindParam(':slug', $slug);
  $stmt->bindParam(':video_url', $video_url);
  $stmt->bindParam(':status', $status);
  $stmt->bindParam(':is_featured', $is_featured);
  $stmt->bindParam(':user_id', $user_id);
  $stmt->bindParam(':id', $id);
  if ($image_path) {
    $stmt->bindParam(':image_path', $image_path);
  }

  if ($stmt->execute()) {
    Flash::set('success', 'تم تحديث المقال بنجاح.');
    header("Location:/article_manage");
    exit;
  } else {
    Flash::set('error', 'حدث خطأ أثناء تحديث المقال.');
    header("Location:/article_manage_view");
    exit;
  }
} else {
  Flash::set('error', 'طلب غير صالح.');
  header("Location: /404");
  exit;
}
