<?php

namespace Controllers\categories;

// if (headers_sent($file, $line)) {
//     die("Headers already sent in $file on line $line");
// }
require_once __DIR__ . '/../../vendor/autoload.php';

use Core\Session;
Session::start();
use Core\Database\Connection;
use PDOException;
use PDO;  

use Core\Flash;

try {
  $conn = Connection::connect();
  
  $search = htmlspecialchars ($_GET['search']?? '');

  $sql = "SELECT * FROM categories where 1 = 1";
  $params = [];
  
  if(!empty($search)){
    $sql .= "AND name LIKE :search OR slug LIKE :search OR created_at LIKE :search";
    $params['search'] = "%$search%";

  }
  $stmt = $conn->prepare($sql);
  $stmt->execute($params);
  $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $category_count = count($categories);


  
    
    



} catch (PDOException $e){
  Flash::set('error', 'خطأ في الاتصال بقاعدة البيانات: ' . htmlspecialchars($e->getMessage()));
}



