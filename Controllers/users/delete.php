<?php
namespace Controllers\users;



use Core\Session;
Session::start();
use Core\Database\Connection;
use Core\Flash;
use PDOException;

try {
  $db = Connection::connect(); 

  $id = $_POST['user_id'] ?? 0; 

  $stmt = $db->prepare("DELETE FROM users WHERE id = :id");
  $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
  $stmt->execute();

  if ($stmt->rowCount() > 0) {
    Flash::set('success', "تم حذف المستخدم بنجاح");
  } else {
    Flash::set('error', "لم يتم حذف المستخدم");
  }

  header("Location: " . $_SERVER["HTTP_REFERER"]);
  exit;

} catch (PDOException $e) {
  Flash::set('error', "حدث خطأ أثناء حذف المستخدم: " . $e->getMessage());
  header("Location: " . $_SERVER["HTTP_REFERER"]);
  exit;
}
