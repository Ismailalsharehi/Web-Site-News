<?php
namespace Controllers\users;

// if (headers_sent($file, $line)) {
//     die("Headers already sent in $file on line $line");
// }
require_once __DIR__ . '/../../vendor/autoload.php';

use Core\Session;
Session::start();

use Core\Flash;

use Core\Database\Connection;
use PDO;
use PDOException;




try {

$db = Connection::connect();

$search = htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES, 'UTF-8');
$role = htmlspecialchars($_GET['role'] ?? '', ENT_QUOTES, 'UTF-8');

$sql = "SELECT * FROM users WHERE 1=1";
$params = [];

// شرط البحث بالاسم أو البريد
if (!empty($search)) {
    $sql .= " AND (full_name LIKE :search OR email LIKE :search)";
    $params['search'] = "%$search%";
}

// شرط الفلترة بالدور
if (!empty($role)) {
    $sql .= " AND role = :role";
    $params['role'] = $role;
}

$stmt = $db->prepare($sql);
$stmt->execute($params);
$filteredUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// احصائية عدد المستخدمين
$user_count = count($filteredUsers);


} catch (PDOException $e) {
    $errorMessage = '<div class="alert alert-danger">خطأ في الاتصال: ' .
        htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') .
        '</div>';

    Flash::set('error', $errorMessage);  // خزن الرسالة تحت مفتاح "error"
    die(Flash::get('error'));            // طبعها ثم أوقف التنفيذ
}




// // to select the blocked users
// $sql = "SELECT * FROM users WHERE status = 'blocked'";
// $stmt = $db->prepare($sql);
// $stmt->execute();
// $blocked_users = $stmt->fetchAll(PDO::FETCH_ASSOC);


// // to select the active users
// $sql = "SELECT * FROM users WHERE status = 'active'";
// $stmt = $db->prepare($sql);
// $stmt->execute();
// $active_users = $stmt->fetchAll(PDO::FETCH_ASSOC);


// // to select the inactive users
// $sql = "SELECT * FROM users WHERE status = 'inactive'";
// $stmt = $db->prepare($sql);
// $stmt->execute();
// $inactive_users = $stmt->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__ . '/../../View/pages/users/manage_view.php';
 