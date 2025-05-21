<?php
namespace Controllers\users;

// if (headers_sent($file, $line)) {
//     die("Headers already sent in $file on line $line");
// }
require_once __DIR__ . '/../../vendor/autoload.php';

use Core\Session;
Session::start();
use Core\Database\Connection;
use PDOException;

use Core\Flash;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // جلب البيانات بأمان مع ترميز
    $full_name = htmlspecialchars(trim($_POST['full_name'] ?? ''));
    $username = htmlspecialchars(trim($_POST['username'] ?? ''));
    $username = preg_replace('/[^a-zA-Z0-9_]/', '', $username); // إزالة أي أحرف غير صالحة
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $email = filter_var($email, FILTER_SANITIZE_EMAIL); // ترميز البريد الإلكتروني
    $password = htmlspecialchars(trim($_POST['password'] ?? ''));
    $password = filter_var($password, FILTER_SANITIZE_STRING); // ترميز كلمة المرور
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password']?? ''));
    $confirm_password = filter_var($confirm_password, FILTER_SANITIZE_STRING); // ترميز تأكيد كلمة المرور
    $role = htmlspecialchars(trim($_POST['role'] ?? 'author')); // تعيين القيمة الافتراضية للدور
    $role = preg_replace('/[^a-zA-Z0-9_]/', '', $role); // إزالة أي أحرف غير صالحة

    // تحقق من الحقول المطلوبة
    if (empty($full_name) || empty($username) || empty($email) || empty($password)|| empty($confirm_password)) {
         Flash::set('error', 'يرجى ملء جميع الحقول المطلوبة.');
        
        header('Location: ../../View/pages/users/create_view.php');
        exit;
    }

    // تحقق من صحة البريد الإلكتروني
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        Flash::set('error', 'يرجى إدخال بريد إلكتروني صالح.');
          header('Location: ../../View/pages/users/create_view.php');
        exit;
    }

    // تحقق من طول كلمة المرور
    if (strlen($password) < 6 || strlen($confirm_password) < 6) {
        Flash::set('error', 'كلمة المرور يجب أن تكون 6 أحرف على الأقل.');
          header('Location: ../../View/pages/users/create_view.php');
        exit;
    }
    // تحقق من تطابق كلمتي المرور 
    if ($password !== $confirm_password) {
        Flash::set('error', 'كلمات المرور غير متطابقة.');
          header('Location: ../../View/pages/users/create_view.php');
        exit;
    }

    $_SESSION['user_data']= $_POST;

    Session::set('user_data', $_POST);

    $db = Connection::connect();

    // تحقق من وجود اسم المستخدم مسبقاً
    $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE username = :username OR email = :email");
    $stmt->execute([':username' => $username, ':email' => $email]);
    $exists = $stmt->fetchColumn();

    if ($exists) {
        Flash::set('error', 'اسم المستخدم أو البريد الإلكتروني موجود بالفعل.');
          header('Location: ../../View/pages/users/create_view.php');
        exit;
    }

    // إعداد وإدخال المستخدم الجديد
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
        header('Location: ../../View/pages/users/show_view.php');
        exit;
    } else {
        Flash::set('error', 'حدث خطأ أثناء إنشاء الحساب.');
          header('Location: ../../View/pages/users/create_view.php');
        exit;
    }
    } catch (PDOException $e) {
        Flash::set('error', 'حدث خطأ أثناء الاتصال بقاعدة البيانات: ' . $e->getMessage());
          header('Location: ../../View/pages/users/create_view.php');
        exit;
    }
}
