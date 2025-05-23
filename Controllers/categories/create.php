<?php

namespace Controllers\articles;
use Core\Session;
use Core\Flash;
use Core\Database\Connection;
use Pdo;

require_once __DIR__ . '/../../vendor/autoload.php';
// if (headers_sent($file, $line)) {
//     die("Headers already sent in $file on line $line");
// }
// require_once __DIR__ . '/../../vendor/autoload.php';

  $db = Connection::connect();
  $stmt = $db->prepare("SELECT id, name FROM categories");
  $stmt->execute();
  $categories = $stmt->fetchAll(\PDO::FETCH_ASSOC);

require_once __DIR__ . '/../../View/pages/categories/create_view.php';
