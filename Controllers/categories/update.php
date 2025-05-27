<?php

namespace Controllers\categories;


use Core\Session;
use Core\Flash;
use Core\Database\Connection;
use PDOException;
use PDO;

Session::start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_categories'])) {
  $id = htmlspecialchars($_POST['id']);
  $name = htmlspecialchars($_POST['name']);
  $description = htmlspecialchars($_POST['description']);
  $slug = htmlspecialchars($_POST['slug']);

  try {
    $conn = Connection::connect();

    $stmt = $conn->prepare("UPDATE categories SET name = :name, description = :description, slug = :slug WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':slug', $slug);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
      Flash::set('success', 'تم تحديث التصنيف بنجاح');
      header('Location: /categories_manage');
    } else {
      Flash::set('error', 'فشل في تحديث التصنيف');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit;
    }
  } catch (PDOException $e) {
    Flash::set('error', 'خطأ في الاتصال بقاعدة البيانات: ' . htmlspecialchars($e->getMessage()));
    header('Location: /404');
    exit;
  }
}
