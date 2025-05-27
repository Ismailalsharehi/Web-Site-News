<?php
namespace Controllers\articles;


use Core\Session;
Session::start();

use Core\Database\Connection;
use Core\Flash;
use PDOException;

try {
  $db = Connection::connect(); 

  $id = $_POST['article_id'] ?? 0; 

  $stmt = $db->prepare("DELETE FROM articles WHERE id = :id");
  $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    Flash::set('success', "تم حذف المقال بنجاح");
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
    
  } else {
    Flash::set('error', "لم يتم حذف المقال");
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
  }


} catch (PDOException $e) {
  Flash::set('error', "حدث خطأ أثناء حذف المستخدم: " . $e->getMessage());
  header("Location: " . $_SERVER["HTTP_REFERER"]);
  exit;
}
