<?php

namespace Controllers\users;


use Core\Session;

Session::start();

use Core\Database\Connection;
use Core\Flash;
use PDO;
use PDOException;


// var_dump($_POST);

// بدء الجلسة الآمنة
ini_set('session.cookie_secure', '1');      // فقط مع HTTPS
ini_set('session.cookie_httponly', '1');    // الحماية من JavaScript
ini_set('session.use_only_cookies', '1');
ini_set('session.use_strict_mode', '1');

ini_set('session.cookie_samesite', 'Strict'); // الحماية من CSRF
ini_set('session .cookie_lifetime', 0); // انتهاء الجلسة عند إغلاق المتصفح
ini_set('session.gc_maxlifetime', 1440); // مدة الجلسة 24 دقيق\

// var_dump($_POST);
// Session::start();

// تحقق من أن الطلب من نوع POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  Flash::set('error', 'طلب غير صالح.');
  // revresh the page 

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

// استلام البيانات
$email = trim($_POST['email'] ?? '');
$password = trim($_POST['password'] ?? '');

// إذا كانت هناك بيانات محفوظة في الجلسة (مثلاً من الخطوة السابقة)
// if (Session::has('user_data')) {
//     $user_data = Session::get('user_data');
//     $email = trim($user_data['email'] ?? '');
//     $password = trim($user_data['password'] ?? '');
// }

// التحقق من البيانات
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

// الحماية من هجمات القوة الغاشمة (Brute Force)
$login_attempts = Session::get('login_attempts') ?? 0;
$last_attempt_time = Session::get('last_attempt_time') ?? 0;

if ($login_attempts >= 5 && time() - $last_attempt_time < 300) {
  Flash::set('error', 'لقد تجاوزت الحد الأقصى للمحاولات. حاول لاحقًا.');
  die(Flash::get('error') . time() - $last_attempt_time);
  exit;
}


Session::set('last_attempt_time', time()); // 
Session::set('login_attempts', $login_attempts + 1);

// الاتصال بقاعدة البيانات
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






    // إعادة ضبط محاولات الدخول
    Session::set('login_attempts', 0);



    Flash::set('success', 'تم تسجيل الدخول بنجاح.');
    header('Location: /');


    exit;
  } else {
    // تحديث فشل الدخول
    // $fail = $db->prepare("UPDATE users SET last_login_failed = NOW() WHERE email = :email");
    // $fail->bindParam(':email', $email);
    // $fail->execute();

    Flash::set('error', 'فشل تسجيل الدخول. تحقق من البريد وكلمة المرور.');
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
  }
} catch (PDOException $e) {
  Flash::set('error', 'خطأ في الاتصال بقاعدة البيانات.');
  header('Location: /404');
  exit;
}

require('View/pages/users/index_view.php');
