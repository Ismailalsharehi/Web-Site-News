<?php

namespace Controllers\articles;

use Core\Session;


use Core\Flash;
use Core\Database\Connection;
use Pdo;


$user_id = Session::get('user')['id'] ?? null;


$db = Connection::connect();
$stmt = $db->prepare("SELECT id, name FROM categories");
$stmt->execute();
$categories = $stmt->fetchAll(\PDO::FETCH_ASSOC);

if (Session::isAdmin()) {
  // Flash::set('success', 'مرحباً ' . htmlspecialchars(Session::get('user')['name']));
  require('View/pages/articles/create_view.php');
} else {
  Flash::set('error', 'ليس لديك صلاحيات للوصول إلى هذه الصفحة.');
  header('Location: /');
  exit;
}
