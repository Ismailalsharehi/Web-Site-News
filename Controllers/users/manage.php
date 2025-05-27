<?php

namespace Controllers\users;


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

  $sql = "
  SELECT users.*, COUNT(articles.id) AS article_count
  FROM users
  LEFT JOIN articles ON users.id = articles.user_id
  WHERE 1=1
";

  $params = [];

  if (!empty($search)) {
    $sql .= " AND (users.full_name LIKE :search OR users.email LIKE :search)";
    $params['search'] = "%$search%";
  }

  if (!empty($role)) {
    $sql .= " AND users.role = :role";
    $params['role'] = $role;
  }

  $sql .= " GROUP BY users.id";

  $stmt = $db->prepare($sql);
  $stmt->execute($params);
  $filteredUsers = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $user_count = count($filteredUsers);
} catch (PDOException $e) {
  $errorMessage = '<div class="alert alert-danger">خطأ في الاتصال: ' .
    htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') .
    '</div>';

  Flash::set('error', $errorMessage);  // خزن الرسالة تحت مفتاح "error"
  die(Flash::get('error'));            // طبعها ثم أوقف التنفيذ
}


if (Session::isAdmin()) {
  Flash::set('success', 'مرحباً ' . htmlspecialchars(Session::get('user')['name']));
  require('View/pages/users/manage_view.php');
} else {
  Flash::set('error', 'ليس لديك صلاحيات للوصول إلى هذه الصفحة.');
  header('Location: /');
  exit;
}
