<?php

namespace Controllers\categories;

use Core\Session;
use Core\Flash;
use Core\Database\Connection;
use PDOException;
use PDO;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = htmlspecialchars($_POST['name']);
  $description = htmlspecialchars($_POST['description']);
  $slug = htmlspecialchars($_POST['slug']);
  $created_at = date('Y-m-d H:i:s');


  try {
    $conn = Connection::connect();

    $stmt = $conn->prepare("INSERT INTO categories (name, description, slug, created_at) VALUES (:name, :description, :slug, :created_at)");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':created_at', $created_at);

    if ($stmt->execute()) {
      Flash::set('success', 'تم إضافة التصنيف بنجاح');
      // Redirect to the categories index page or any other page
      header('Location: /categories_manage');
    } else {
      Flash::set('error', 'فشل في إضافة التصنيف');


      header('Location:' . $_SERVER['HTTP_REFERER']);
      exit;
    }

    header('Location:/categories_manage');
    exit;
  } catch (PDOException $e) {
    Flash::set('error', 'خطأ في الاتصال بقاعدة البيانات: ' . htmlspecialchars($e->getMessage()));
    header('Location: /404');
    exit;
  }
}
