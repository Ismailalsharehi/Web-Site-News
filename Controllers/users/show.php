<?php

namespace Controllers\categories;


require_once __DIR__ . '/../../vendor/autoload.php';

use Core\Session;
Session::start();
use Core\Database\Connection;
use PDOException;
use PDO;  

use Core\Flash;
try{
$conn = Connection::connect();

$stmt = $conn->prepare("SELECT * FROM users WHERE id =:id");
$user_id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$stmt->bindParam(':id', $user_id, PDO::PARAM_INT);

$stmt->execute();
$users = $stmt->fetch(PDO::FETCH_ASSOC);


}catch (PDOException $e){
  Flash::set('error', 'خطأ في الاتصال بقاعدة البيانات: ' . htmlspecialchars($e->getMessage()));
}


require_once __DIR__ . '/../../View/pages/users/show_view.php';