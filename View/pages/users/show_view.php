<?php

// show all data of user
use Core\Session;
use Core\Flash;


if (!Session::has('user_data')) {
  Flash::set('error', 'لا توجد بيانات مستخدم.');
  header('Location: ../../View/pages/users/index_view.php');
  exit;
}
$user_data = Session::get('user_data') ?? 0;
$last_login_time = Session::get('last_login_time') ?? 0;
// var_dump($user_data);  
?>

<?php require_once __DIR__ . '../../../parts/header.php'; ?>
<?php require_once __DIR__ . '../../../parts/navegation.php'; ?>
<?php require_once __DIR__ . '../../../parts/adminBar.php'; ?>


<div class="container">
  <h1>تفاصيل المستخدم</h1>
  <div class="user-details">
    <p><strong>الاسم الكامل:</strong> <?= htmlspecialchars($users['full_name']) ?></p>
    <p><strong>البريد الإلكتروني:</strong> <?= htmlspecialchars($users['email']) ?></p>
    <p><strong>تاريخ التسجيل:</strong> <?= htmlspecialchars($users['created_at']) ?></p>
    <p><strong>آخر تسجيل دخول:</strong> 
  <?= $last_login_time ? date('Y-m-d H:i:s', $last_login_time) : 'لم يتم تسجيل دخول بعد' ?>
</p>

  </div>
  <!-- $login_attempts = Session::get('login_attempts') ?? 0;
$last_attempt_time = Session::get('last_attempt_time') ?? 0; -->

  <!-- <a href="../../View/pages/users/index_view.php" class="btn btn-primary">العودة إلى قائمة المستخدمين</a> -->
</div>
<?php require_once __DIR__ . '../../../parts/adminBar.php'; ?>