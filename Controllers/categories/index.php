<?php
namespace Controllers\categories;
require_once __DIR__ . '/../../vendor/autoload.php';
use Core\Session;
use Core\Flash;
use Core\Database\Connection;
use PDOException;
use PDO;



try {
    $conn = Connection::connect();
    $stmt = $conn->prepare("SELECT * FROM categories");
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    Flash::set('error', 'خطأ في الاتصال بقاعدة البيانات: ' . htmlspecialchars($e->getMessage()));
}


require_once __DIR__ . '/../../View/pages/categories/index_view.php';