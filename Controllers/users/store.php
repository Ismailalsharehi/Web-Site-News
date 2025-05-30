<?php

namespace Controllers\users;


use Core\Session;

Session::start();

use Core\Database\Connection;
use PDOException;

use Core\Flash;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create'])) {


  
  $full_name = htmlspecialchars(trim($_POST['full_name'] ?? ''));
  $username = htmlspecialchars(trim($_POST['username'] ?? ''));
  $username = preg_replace('/[^a-zA-Z0-9_]/', '', $username); 
  $email = htmlspecialchars(trim($_POST['email'] ?? ''));
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);  
  $password = htmlspecialchars(trim($_POST['password'] ?? ''));
  $password = filter_var($password, FILTER_SANITIZE_STRING);
  $confirm_password = htmlspecialchars(trim($_POST['confirm_password'] ?? ''));
  $confirm_password = filter_var($confirm_password, FILTER_SANITIZE_STRING);
  $role = htmlspecialchars(trim($_POST['role'] ?? 'author'));
  $role = preg_replace('/[^a-zA-Z0-9_]/', '', $role);



  if (empty($full_name) || empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
    Flash::set('error', 'يرجى ملء جميع الحقول المطلوبة.');

    header('Location: /users_create');
    exit;
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    Flash::set('error', 'يرجى إدخال بريد إلكتروني صالح.');
    header('Location: /users_create');
    exit;
  }


  if (strlen($password) < 6 || strlen($confirm_password) < 6) {
    Flash::set('error', 'كلمة المرور يجب أن تكون 6 أحرف على الأقل.');
    header('Location: /users_create');
    exit;
  }
  
  if ($password !== $confirm_password) {
    Flash::set('error', 'كلمات المرور غير متطابقة.');
    header('Location: /users_create');
    exit;
  }

  

  Session::set('user_data', $_POST);

  $db = Connection::connect();


  $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE username = :username OR email = :email");
  $stmt->execute([':username' => $username, ':email' => $email]);
  $exists = $stmt->fetchColumn();

  if ($exists) {
    Flash::set('error', 'اسم المستخدم أو البريد الإلكتروني موجود بالفعل.');
    header('Location: /users_create');
    exit;
  }


  try {

    $stmt = $db->prepare("INSERT INTO users (full_name, username, email, password, role) VALUES (:full_name, :username, :email, :password, :role)");

    $result = $stmt->execute([
      ':full_name' => $full_name,
      ':username' => $username,
      ':email' => $email,
      ':password' => password_hash($password, PASSWORD_BCRYPT),
      ':role' => 'author'
    ]);

    if ($result) {
      Flash::set('success', 'تم إنشاء الحساب بنجاح.');
      header('Location: /');
      exit;
      $user_data =  Session::set('user_data', $result);
    } else {
      Flash::set('error', 'حدث خطأ أثناء إنشاء الحساب.');
      header('Location: /users_create');
      exit;
    }
  } catch (PDOException $e) {
    Flash::set('error', 'حدث خطأ أثناء الاتصال بقاعدة البيانات: ' . $e->getMessage());
    header('Location: /users_create');
    exit;
  }
}

