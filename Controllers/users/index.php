<?php

namespace Controllers\users;


use Core\Session;

Session::start();

use Core\Database\Connection;
use Core\Flash;
use PDO;
use PDOException;




ini_set('session.cookie_secure', '1');      
ini_set('session.cookie_httponly', '1');    
ini_set('session.use_only_cookies', '1');
ini_set('session.use_strict_mode', '1');

ini_set('session.cookie_samesite', 'Strict'); //  CSRF
ini_set('session .cookie_lifetime', 0); 
ini_set('session.gc_maxlifetime', 1440); 

// var_dump($_POST);
// Session::start();


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  Flash::set('error', 'طلب غير صالح.');


  header('Location: /404');
  exit;
}


// تحقق من CSRF
// $csrf_token = $_POST['csrf_token'] ?? '';
// if (!Session::has('csrf_token') || $csrf_token !== Session::get('csrf_token')) {
//   Flash::set('error', 'رمز CSRF غير صالح.');
//   header('Location: /users_index_view');
//   exit;
// }


$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');



if (empty($email) || empty($password)) {
  Flash::set('error', 'يرجى ملء جميع الحقول.');

  
  header('Location: /login');
  exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  Flash::set('error', 'يرجى إدخال بريد إلكتروني صالح.');
  header('Location: /login');
  exit;
}
if (strlen($password) < 6) {
  Flash::set('error', 'كلمة المرور يجب أن تكون 6 أحرف على الأقل.');
  header('Location: /login');
  exit;
}

$login_attempts = Session::get('login_attempts') ?? 0;
$last_attempt_time = Session::get('last_attempt_time') ?? 0;

if ($login_attempts >= 5 && time() - $last_attempt_time < 300) {
  Flash::set('error', 'لقد تجاوزت الحد الأقصى للمحاولات. حاول لاحقًا.');
  die(Flash::get('error') . time() - $last_attempt_time);
  exit;
}


Session::set('last_attempt_time', time()); // 
Session::set('login_attempts', $login_attempts + 1);


// create cockies 


try {
  $db = Connection::connect();
  $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
  $stmt->bindParam(':email', $email);
  $stmt->execute();

  $user = $stmt->fetch(PDO::FETCH_ASSOC); // I add featchall then it is featch just  

  if ($user && password_verify($password, $user['password'])) {
    session_regenerate_id(true);
    Session::set('user_id', $user['id']);
    Session::set('user', [
      'id' => $user['id'],
      'name' => $user['full_name'],
      'username' => $user['username'],
      'email' => $user['email'],
      'role' => $user['role'],
      'created_at' => $user['created_at'] ?? null,
      'last_login' => date('Y-m-d H:i:s'),
    ]);
    Session::set('last_login_time', time());
    Session::set('login_attempts', 0);

    if(isset($_POST['rememberme'])){
    setcookie(
      'remember_me',
      $email,
      [
        'expires' => time() + 3600,
        'path' => '/',
        'domain' => '',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Strict'
      ]
    );
  }

    Flash::set('success', 'تم تسجيل الدخول بنجاح.');
    
    header('Location: /');
    exit;
  } else {

    Flash::set('error', 'فشل تسجيل الدخول. تحقق من البريد وكلمة المرور.');
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
  }
} catch (PDOException $e) {
  Flash::set('error', 'خطأ في الاتصال بقاعدة البيانات.');
  header('Location: /404');
  exit;
}

// require('View/pages/users/index_view.php');
