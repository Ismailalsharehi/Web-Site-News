<?php
namespace Controllers\categories;
require_once __DIR__ . '/../../vendor/autoload.php';
use Core\Session;
use Core\Flash;
use Core\Database\Connection;
use PDOException;
use PDO;


try{
  $conn = Connection::connect();
  $id = intval($_POST['id'] ?? 0);

  if($_SERVER['REQUEST_METHOD'] === 'POST' && isset ($_POST['delete'])){
    if ($id <= 0) {
      Flash::set('error', 'رقم التصنيف غير صالح.');
      header('Location: ../../View/pages/categories/delete_view.php');
      exit;
    }
    // جلب التصنيف
    $stmt = $conn->prepare("SELECT * FROM categories WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $category = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$category) {
      Flash::set('error', 'التصنيف غير موجود.');
      header('Location: ../../View/pages/categories/index_view.php');
      exit;
    }

    // حذف التصنيف
    $stmt = $conn->prepare("DELETE FROM categories WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    if($stmt->execute()){
      Flash::set('success', 'تم حذف التصنيف بنجاح');
      header('Location: ../../View/pages/categories/index_view.php');
      exit;
    }else{
      Flash::set('error', 'فشل في حذف التصنيف');
      header('Location: ../../View/pages/categories/index_view.php');
      exit;
    }
  }


} catch(PDOException $e){
  Flash::set('error', 'خطأ في الاتصال بقاعدة البيانات: ' . htmlspecialchars($e->getMessage()));
}













