<?php
namespace Controllers\articles;

require_once __DIR__ . '/../../vendor/autoload.php';

use Core\Session;
Session::start();
use Core\Database\Connection;
use Core\Flash;
use PDO;
use PDOException;

// بدء الجلسة

// الاتصال بقاعدة البيانات
try {
    $db = Connection::connect();

    // تنقية مدخلات GET
    $search = trim($_GET['search'] ?? '');
    $role = trim($_GET['role'] ?? '');
    $status = trim($_GET['status'] ?? '');
    $categoryId = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;

    // معالجة المستخدمين
    $userParams = [];
    $userSQL = "SELECT * FROM users WHERE 1=1";

    if (!empty($search)) {
        $userSQL .= " AND (full_name LIKE :search OR email LIKE :search)";
        $userParams['search'] = '%' . $search . '%';
    }

    if (!empty($role)) {
        $userSQL .= " AND role = :role";
        $userParams['role'] = $role;
    }

    

    $userStmt = $db->prepare($userSQL);
    $userStmt->execute($userParams);
    $filteredUsers = $userStmt->fetchAll(PDO::FETCH_ASSOC);
    $user_count = count($filteredUsers);

    // var_dump($user_count);
    // معالجة المقالات
    $articleParams = [];
    $articleSQL = "
    SELECT a.*, 
           c.name AS category_name, 
           u.full_name AS author_name 
    FROM articles a
    INNER JOIN categories c ON a.category_id = c.id
    INNER JOIN users u ON a.user_id = u.id
    WHERE 1=1
";


    if (!empty($search)) {
        $articleSQL .= " AND (a.title LIKE :search OR u.full_name LIKE :search)";

        $articleParams['search'] = '%' . $search . '%';
    }
       
    

    if (!empty($categoryId)) {
        $articleSQL .= " AND a.category_id = :category_id";
        $articleParams['category_id'] = $categoryId;
    }

    if (!empty($role)) {
        $articleSQL .= " AND u.role = :role";
        $articleParams['role'] = $role;
    }


    if (!empty($status)) {
        $articleSQL .= " AND a.status = :status";
        $articleParams['status'] = $status;
    }



    $articleSQL .= " ORDER BY a.created_at DESC";

    $articleStmt = $db->prepare($articleSQL);
    $articleStmt->execute($articleParams);
    $articles = $articleStmt->fetchAll();

    $articles_count = count($articles);


}   catch (PDOException $e) {
    $error = htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    Flash::set('error', '<div class="alert alert-danger">خطأ في الاتصال: ' . $error . '</div>');
    exit();
}

try {
    $categoryStmt = $db->query("SELECT id, name FROM categories");
    $categories = $categoryStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8');
    Flash::set('error', '<div class="alert alert-danger">خطأ في جلب التصنيفات: ' . $error . '</div>');
    $categories = [];
}

require_once __DIR__ . '/../../View/pages/articles/manage_view.php';
