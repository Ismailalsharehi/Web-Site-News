<?php
namespace Controllers\users;

require_once __DIR__ . '/../../vendor/autoload.php';

use Core\Session;

Session::start();

use Core\Database\Connection;
use PDOException;
use Core\Flash;
use PDO;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  // استقبال البيانات
  $id = intval($_POST['id'] ?? 0); // تأكد أن لديك الـ ID
  $full_name = htmlspecialchars(trim($_POST['full_name'] ?? ''));
  $username = preg_replace('/[^a-zA-Z0-9_]/', '', trim($_POST['username'] ?? ''));
  $email = htmlspecialchars(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
  $password = trim($_POST['password'] ?? '');
  $confirm_password = trim($_POST['confirm_password'] ?? '');
  $role = preg_replace('/[^a-zA-Z0-9_]/', '', trim($_POST['role'] ?? null));



  // تحقق من الحقول الأساسية
  if (empty($id) || empty($full_name) || empty($username) || empty($email)) {
    Flash::set('error', 'يرجى ملء جميع الحقول المطلوبة.');
    header('Location: ../../View/pages/users/edit_view.php?id='.$id);
    exit;
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    Flash::set('error', 'يرجى إدخال بريد إلكتروني صالح.');
    header('Location: ../../View/pages/users/edit_view.php?id='.$id);
    exit;
  }

  // إعداد قاعدة البيانات
  try {
    $db = Connection::connect();

    // إذا تم إدخال كلمة مرور، تأكد من الشروط
    $updatePassword = false;
    $passwordHash = '';

    if (!empty($password) || !empty($confirm_password)) {
      if (strlen($password) < 6 || strlen($confirm_password) < 6) {
        Flash::set('error', 'كلمة المرور يجب أن تكون 6 أحرف على الأقل.');
        header('Location: ../../View/pages/users/edit_view.php?id='.$id);
        exit;
      }

      if ($password !== $confirm_password) {
        Flash::set('error', 'كلمات المرور غير متطابقة.');
        header('Location: ../../View/pages/users/edit_view.php?id='.$id);
        exit;
      }

      $updatePassword = true;
      $passwordHash = password_hash($password, PASSWORD_BCRYPT);
    }

    // إعداد الاستعلام بناءً على ما إذا كنا سنحدث كلمة المرور
    if ($updatePassword) {
      $stmt = $db->prepare("
                UPDATE users 
                SET full_name = :full_name,
                    username = :username,
                    email = :email,
                    password = :password,
                    role = :role
                WHERE id = :id
            ");
      $params = [
        ':full_name' => $full_name,
        ':username' => $username,
        ':email' => $email,
        ':password' => $passwordHash,
        ':role' => $role,
        ':id' => $id
      ];
    } else {
      $stmt = $db->prepare("
                UPDATE users 
                SET full_name = :full_name,
                    username = :username,
                    email = :email,
                    role = :role
                WHERE id = :id
            ");
      $params = [
        ':full_name' => $full_name,
        ':username' => $username,
        ':email' => $email,
        ':role' => $role,
        ':id' => $id
      ];
    }

    // تنفيذ الاستعلام
    $result = $stmt->execute($params);

    if ($result) {
      Flash::set('success', 'تم تحديث بيانات المستخدم بنجاح.');
      header('Location: ../../View/pages/users/show_view.php');
      exit;
    } else {
      Flash::set('error', 'حدث خطأ أثناء التحديث.');
      header('Location: ../../View/pages/users/edit_view.php?id=' . $id);
      exit;
    }
  } catch (PDOException $e) {
    Flash::set('error', 'خطأ في الاتصال بقاعدة البيانات: ' . $e->getMessage());
    header('Location: ../../View/pages/users/edit_view.php?id=' . $id);
    exit;
  }
}
